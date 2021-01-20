<?php

namespace App\Http\Controllers;

use App\Models\Rally;
use App\Models\Championship;
use App\Models\Location;
use Illuminate\Http\Request;

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
            Rally::get_validation_create($championship)
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
            $rally->get_validation_update($championship)
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
