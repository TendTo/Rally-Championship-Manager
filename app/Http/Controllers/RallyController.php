<?php

namespace App\Http\Controllers;

use App\Models\Rally;
use App\Models\Championship;
use App\Models\Location;
use App\Models\Result;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RallyController extends Controller
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
     * @param  \App\Models\Championship $championship
     * @return \Illuminate\Http\Response
     */
    public function index(Championship $championship)
    {
        $collection = $championship->rallies;
        return view('rally.index', compact('championship', 'collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Championship $championship
     * @return \Illuminate\Http\Response
     */
    public function create(Championship $championship)
    {
        $this->authorize('update', $championship);
        $locations = Location::all();
        return view('rally.create', compact('championship', 'locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Championship $championship
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Championship $championship)
    {
        $this->authorize('update', $championship);
        $data = $request->validate(
            Rally::get_validation_create()
        );
        
        $data['championship_id'] = $championship->id;

        Rally::create($data);

        return redirect('championship/'.$championship->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Championship $championship
     * @param  \App\Models\Rally        $rally
     * @return \Illuminate\Http\Response
     */
    public function show(Championship $championship, Rally $rally)
    {
        return view('rally.show', compact('championship', 'rally'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Championship $championship
     * @param  \App\Models\Rally        $rally
     * @return \Illuminate\Http\Response
     */
    public function result(Championship $championship, Rally $rally)
    {
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

        // SUM(r.time) + SUM(r.penality)

        //Get array with structure ['participant_id' => participant_id, 'tot_time' => total_time] without all the retired participant
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
                ->limit(10)
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

        //Get array with structure ['participant' => Participant::class, 'tot_time' => total_time] without all the retired participant
        $results = array_map(
            function ($e) {
                $array = [];
                $array['participant'] = Participant::find($e->participant_id);
                $array['tot_time'] = substr($e->tot_time, 0, -1);
                return $array;
            }, $results
        );
        
        //Get array with structure ['participant' => Participant::class] with all the retired participants
        $rets = Participant::find($rets);


        return view('rally.result', compact('championship', 'rally', 'results', 'rets'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Championship $championship
     * @param  \App\Models\Rally        $rally
     * @return \Illuminate\Http\Response
     */
    public function edit(Championship $championship, Rally $rally)
    {
        $this->authorize('update', $championship);
        $locations = Location::all();
        return view('rally.edit', compact('championship', 'rally', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Championship $championship
     * @param  \App\Models\Rally        $rally
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Championship $championship, Rally $rally)
    {
        $this->authorize('update', $championship);
        $data = $request->validate(
            $rally->get_validation_update()
        );
        
        $data['championship_id'] = $championship->id;

        $rally->update($data);

        return redirect('championship/'.$championship->id.'/rally/'.$rally->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Championship $championship
     * @param  \App\Models\Rally        $rally
     * @return \Illuminate\Http\Response
     */
    public function destroy(Championship $championship, Rally $rally)
    {
        $this->authorize('update', $championship);
        $rally->delete();
        return redirect('championship/'.$championship->id);
    }
}
