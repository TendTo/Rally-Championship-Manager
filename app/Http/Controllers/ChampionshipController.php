<?php

namespace App\Http\Controllers;

use App\Models\Championship;
use App\Models\Participant;
use Illuminate\Http\Request;

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
