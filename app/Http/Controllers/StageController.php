<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\Rally;
use App\Models\Championship;
use Illuminate\Http\Request;

class StageController extends Controller
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
     * @param  \App\Models\Rally        $rally
     * @return \Illuminate\Http\Response
     */
    public function index(Championship $championship, Rally $rally)
    {
        $collection = $rally->stages;
        return view('stage.index', compact('championship', 'rally', 'collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Championship $championship
     * @param  \App\Models\Rally        $rally
     * @return \Illuminate\Http\Response
     */
    public function create(Championship $championship, Rally $rally)
    {
        $this->authorize('update', $championship);
        return view('stage.create', compact('championship', 'rally'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Championship $championship
     * @param  \App\Models\Rally        $rally
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Championship $championship, Rally $rally)
    {
        $this->authorize('update', $championship);
        $data = $request->validate(
            Stage::get_validation_create()
        );
        
        $data['rally_id'] = $rally->id;

        Stage::create($data);

        return redirect('championship/'.$championship->id.'/rally/'.$rally->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Championship $championship
     * @param  \App\Models\Rally        $rally
     * @param  \App\Models\Stage        $stage
     * @return \Illuminate\Http\Response
     */
    public function show(Championship $championship, Rally $rally, Stage $stage)
    {
        $results = $stage->results()->whereNotNull('time')->orderBy('time')->get();
        $rets = $stage->results()->whereNull('time')->get();
        return view('stage.show', compact('championship', 'rally', 'stage', 'results', 'rets'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Championship $championship
     * @param  \App\Models\Rally        $rally
     * @param  \App\Models\Stage        $stage
     * @return \Illuminate\Http\Response
     */
    public function edit(Championship $championship, Rally $rally, Stage $stage)
    {
        $this->authorize('update', $championship);
        return view('stage.edit', compact('championship', 'rally', 'stage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Championship $championship
     * @param  \App\Models\Rally        $rally
     * @param  \App\Models\Stage        $stage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Championship $championship, Rally $rally, Stage $stage)
    {
        $this->authorize('update', $championship);
        $data = $request->validate(
            $stage->get_validation_update()
        );
        
        $data['rally_id'] = $rally->id;

        $stage->update($data);

        return redirect('championship/'.$championship->id.'/rally/'.$rally->id.'/stage/'.$stage->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Championship $championship
     * @param  \App\Models\Rally        $rally
     * @param  \App\Models\Stage        $stage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Championship $championship, Rally $rally, Stage $stage)
    {
        $this->authorize('update', $championship);
        $stage->delete();
        return redirect('championship/'.$championship->id.'/rally/'.$rally->id);
    }
}
