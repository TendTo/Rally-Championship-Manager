<?php

namespace App\Http\Controllers;

use App\Models\Championship;
use Illuminate\Http\Request;

class ChampionshipController extends Controller
{
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
        Championship::create($data);

        $collection = Championship::all();
        return view('championship.index', compact('collection'));
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

        return view('championship.show', compact('championship'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Championship $championship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Championship $championship)
    {
        $championship->delete();

        $collection = Championship::all();
        return view("championship.index", compact('collection'));
    }
}
