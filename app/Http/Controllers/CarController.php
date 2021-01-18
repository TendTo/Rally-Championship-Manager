<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Car::all();
        return view('car.index', compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('car.create');
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
            Car::get_validation_create()
        );
        
        Car::create($data);
        return redirect('car');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        return view('car.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        return view('car.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Car          $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        $data = $request->validate(
            $car->get_validation_update()
        );

        $car->update($data);
        return redirect('car/'.$car->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect('car');
    }
}
