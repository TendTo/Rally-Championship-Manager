<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Stage;
use App\Models\Rally;
use App\Models\Championship;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Championship $championship, Rally $rally, Stage $stage)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Championship $championship, Rally $rally, Stage $stage)
    {
        //TODO: maybe can be done better with Eloquent
        $this->authorize('update', $championship);
        $all_participants = $championship->participants;
        $participants = [];
        foreach ($all_participants as $participant) {
            if($participant->results()->where('stage_id', '=', $stage->id)->count() == 0) {
                array_push($participants, $participant);
            }
        }
        return view('result.create', compact('championship', 'rally', 'stage', 'participants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Championship $championship, Rally $rally, Stage $stage)
    {
        $this->authorize('update', $championship);

        if($request->ret) {
            $data = $request->validate(
                Result::get_validation_ret()
            );
        } else{
            $data = $request->validate(
                Result::get_validation_create()
            );
        }
        $data['stage_id'] = $stage->id;
        Result::create($data);

        return redirect('championship/'.$championship->id.'/rally/'.$rally->id.'/stage/'.$stage->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Result $result
     * @return \Illuminate\Http\Response
     */
    public function show(Championship $championship, Rally $rally, Stage $stage, Result $result)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Result $result
     * @return \Illuminate\Http\Response
     */
    public function edit(Championship $championship, Rally $rally, Stage $stage, Result $result)
    {
        return view('result.edit', compact('championship', 'rally', 'stage', 'result'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Result       $result
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Championship $championship, Rally $rally, Stage $stage, Result $result)
    {
        $this->authorize('update', $championship);
        if($request->ret) {
            $data = [
                'time' => null,
                'penality' => null,
            ];
        } else{
            $data =  $request->validate(
                $result->get_validation_update()
            );
        }
        $data['stage_id'] = $stage->id;

        $result->update($data);

        return redirect('championship/'.$championship->id.'/rally/'.$rally->id.'/stage/'.$stage->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Result $result
     * @return \Illuminate\Http\Response
     */
    public function destroy(Championship $championship, Rally $rally, Stage $stage, Result $result)
    {
        $result->delete();
        return redirect('championship/'.$championship->id.'/rally/'.$rally->id.'/stage/'.$stage->id);
    }
}
