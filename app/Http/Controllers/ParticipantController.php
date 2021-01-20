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
        $this->authorize('participate', $championship);

        $cars = Car::all();
        return view('participant.create', compact('championship', 'cars'));
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
        $this->authorize('participate', $championship);
        $car_id = $request->validate(
            Participant::get_validation_create()
        );
        $data = [
            'user_id' => auth()->id(),
            'championship_id' => $championship->id,
        ];
        $data = array_merge($data, $car_id);

        Participant::create($data);
        return \redirect('championship/'.$championship->id.'/participant');
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
     * Set the participant as a new admin.
     *
     * @param  \App\Models\Championship $championship
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function upgrade(Championship $championship, Participant $participant)
    {
        $this->authorize('upgrade', $participant);

        $participant->update(['is_admin'=>true]);
        return redirect('championship/'.$championship->id.'/participant/'.$participant->id);
    }

    /**
     * Remove the admin status from the participant.
     *
     * @param  \App\Models\Championship $championship
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function downgrade(Championship $championship, Participant $participant)
    {
        $this->authorize('downgrade', $participant);

        $participant->update(['is_admin'=>false]);
        return redirect('championship/'.$championship->id.'/participant/'.$participant->id);
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
