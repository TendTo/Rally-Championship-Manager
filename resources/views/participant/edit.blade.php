@extends('layouts.app')

@section('title', "Crea un campionato")

<!-- Forms -->
<form id="deleteForm" action="/championship/{{$championship->id}}/participant/{{$participant->id}}"
    method="POST">
    @method('DELETE')
    @csrf
</form>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Edit your pilot for this championship!') }}</h4>
                </div>
                <div class="card-body pl-5">
                    <form method="POST" action="/championship/{{$championship->id}}/participant/{{$participant->id}}">
                        @method('PATCH')
                        @csrf

                        <!-- Car drowpdown -->
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="name">{{ __('Car model') }}</label>
                            <div class="col-md-6">
                                <select id="car_id" name="car_id"
                                    class="form-control @error('car_id') is-invalid @enderror">
                                    <option value="">{{__('Select a car model')}}</option>
                                    @foreach ($cars as $car)
                                    <option value="{{ $car->id }}"
                                        {{ ($participant->car && $participant->car->id == $car->id) || old('car_id') == $car->id ? "selected":"" }}>
                                        {{ $car->model }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('car_id')
                                <div class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <hr>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <!-- Back button -->
                                <a href="/championship/{{$championship->id}}/participant/{{$participant->id}}"
                                    class="btn btn-primary btn-lg mr-3"><i class="fa fa-arrow-left"></i></a>
                                <!-- Submit button -->
                                <input class="btn btn-primary btn-lg" type="submit" value="{{__('Edit')}}">
                                @can('delete', $participant)
                                <!-- Delete button -->
                                <button class="btn btn-danger btn-lg offset-md-3" type="submit" form="deleteForm"
                                onclick="return confirm('Tutti i tuoi dati verranno rimossi.\nProcedere comunque?')"><i
                                class="fa fa-trash"></i></button>
                                @endcan
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection