<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Championship;
use App\Models\Car;
use Illuminate\Http\Request;

class ParticipantController extends Controller
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
        $collection = $championship->participants;
        return view('participant.index', compact('championship', 'collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Championship $championship
     * @return \Illuminate\Http\Response
     */
    public function create(Championship $championship)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\Championship $championship
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Championship $championship, Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Championship $championship
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function show(Championship $championship, Participant $participant)
    {
        return view('participant.show', compact('championship', 'participant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Championship $championship
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function edit(Championship $championship, Participant $participant)
    {
        $this->authorize('update', $participant);

        $cars = Car::all();
        return view('participant.edit', compact('championship', 'participant', 'cars'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Championship $championship
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Championship $championship, Participant $participant)
    {
        $this->authorize('update', $participant);
        $data = $request->validate(
            $participant->get_validation_update()
        );

        $participant->update($data);
        return redirect('championship/'.$championship->id.'/participant/'.$participant->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Championship $championship
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Championship $championship, Participant $participant)
    {
        $this->authorize('delete', $participant);

        $participant->delete();
        return redirect('championship/'.$championship->id);
    }
}
