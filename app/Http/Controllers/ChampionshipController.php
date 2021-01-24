<?php

namespace App\Http\Controllers;

use App\Models\Championship;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChampionshipController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Championship::all()->where('archived', '=', false);
        return view("championship.index", compact('collection'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_archived()
    {
        $collection = Championship::all()->where('archived', '=', true);
        return view("championship.index_archived", compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('championship.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            Championship::get_validation_create()
        );
        $new_championship = Championship::create($data);

        $participant_data = [
            'user_id' => auth()->id(),
            'championship_id' => $new_championship->id,
            'is_admin' => true,
        ];
        Participant::create($participant_data);

        return redirect('championship');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Championship $championship
     * @return \Illuminate\Http\Response
     */
    public function show(Championship $championship)
    {
        return view('championship.show', compact('championship'));
    }

        /**
         * Display the specified resource.
         *
         * @param  \App\Models\Championship $championship
         * @param  \App\Models\Rally        $rally
         * @return \Illuminate\Http\Response
         */
    public function result(Championship $championship)
    {
        $chart = [];
        foreach ($championship->rallies as $rally){
            $rets = DB::table('rallies')
                ->join('stages', 'rallies.id', '=', 'stages.rally_id')
                ->join('results as r', 'stages.id', '=', 'r.stage_id')
                ->select('r.participant_id')
                ->distinct()
                ->where('rallies.id', $rally->id)
                ->whereNull('time')
                ->get()
                ->all();

            //Get array with structure [participant_id] with all the retired participants
            $rets = array_map(
                function ($object) {
                    return $object->participant_id;
                }, $rets
            );

            $result = [];
            if (env('DB_CONNECTION') == 'mysql') { 
                $results = DB::table('rallies')
                    ->join('stages', 'rallies.id', '=', 'stages.rally_id')
                    ->join('results as r', 'stages.id', '=', 'r.stage_id')
                    ->select(
                        DB::raw(
                            'r.participant_id, SEC_TO_TIME(SUM(TIME_TO_SEC( r.time ))  
                            + SUM(microsecond(r.time))/1000000 
                            + SUM(TIME_TO_SEC( r.penality ))
                            + SUM(microsecond(r.penality))/1000000)
                            as tot_time'
                        )
                    )
                    ->where('rallies.id', $rally->id)
                    ->whereNotIn('r.participant_id', $rets)
                    ->groupBy('r.participant_id')
                    ->orderBy('tot_time', 'asc')
                    ->get()
                    ->all();
            } else if(env('DB_CONNECTION') == 'pgsql') { 
                $results = DB::table('rallies')
                    ->join('stages', 'rallies.id', '=', 'stages.rally_id')
                    ->join('results as r', 'stages.id', '=', 'r.stage_id')
                    ->select(
                        DB::raw(
                            'r.participant_id, SUM( r.time )  
                            + SUM( r.penality )
                            as tot_time'
                        )
                    )
                    ->where('rallies.id', $rally->id)
                    ->whereNotIn('r.participant_id', $rets)
                    ->groupBy('r.participant_id')
                    ->orderBy('tot_time', 'asc')
                    ->get()
                    ->all();
            }
            //Get array with structure ['participant_id' => participant_id, 'tot_time' => total_time] without all the retired participant


            //Get array with structure ['participant' => Participant::class, 'tot_time' => total_time] without all the retired participant
            $results = array_map(
                function ($e, $i) {
                    $array = [];
                    $array['rally_id'] = -1;
                    $array['participant_id'] = $e->participant_id;
                    $array['pos'] = $i;
                    return $array;
                }, $results, array_keys($results)
            );
            
            foreach ($results as $result) {
                if (!isset($chart[$result['participant_id']])) {
                    $chart[$result['participant_id']] = Championship::$points[$result['pos']];
                }else{
                    $chart[$result['participant_id']] += Championship::$points[$result['pos']];
                }
            }
            
            //Get array with structure ['participant' => Participant::class] with all the retired participants
            
        }
        arsort($chart);
        $chart = array_map(
            function ($k, $e) {
                return ['participant' => Participant::find($k), 'points'=>$e];
            }, array_keys($chart), $chart
        );

        return view('championship.result', compact('championship', 'chart'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Championship $championship
     * @return \Illuminate\Http\Response
     */
    public function edit(Championship $championship)
    {
        $this->authorize('update', $championship);
        return view('championship.edit', compact('championship'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Championship $championship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Championship $championship)
    {
        $this->authorize('update', $championship);

        $data = $request->validate(
            $championship->get_validation_update()
        );

        if($request->has('archived')) {
            $data['archived'] = true;
        }
        else{
            $data['archived'] = false;
        }

        $championship->update($data);
        return redirect('championship/'.$championship->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Championship $championship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Championship $championship)
    {
        $this->authorize('delete', $championship);

        $championship->delete();
        return redirect('championship');
    }
}
