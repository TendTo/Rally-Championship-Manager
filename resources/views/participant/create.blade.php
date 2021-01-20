@extends('layouts.app')

@section('title', "Partecipa ad un campionato")

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Do you want to participate to this championship?') }}</h4>
                </div>
                <div class="card-body pl-5">
                    <form method="POST" action="/championship/{{$championship->id}}/participant">
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
                                        {{ old('car_id') == $car->id ? "selected":"" }}>
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
                                <a href="/championship/{{$championship->id}}/participant"
                                    class="btn btn-primary btn-lg mr-3"><i class="fa fa-arrow-left"></i></a>
                                <!-- Submit button -->
                                <input class="btn btn-primary btn-lg" type="submit" value="{{__('Participate')}}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection