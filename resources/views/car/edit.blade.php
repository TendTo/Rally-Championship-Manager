@extends('layouts.app')

@section('title', "Crea un campionato")

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Create a new car!') }}</h4>
                </div>
                <div class="card-body pl-5">
                    <form method="POST" action="/car/{{$car->id}}">
                        @method('PATCH')
                        @csrf
                        <!-- Car model text field -->
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="model"
                                required>{{__('Car model')}}</label>
                            <div class="col-md-6">
                                <input id="model" name="model" class="form-control @error('model') is-invalid @enderror"
                                    type="text" placeholder="{{__('Car model')}}"
                                    value="{{ old('model') ?? $car->model }}" required>
                                @error('model')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Car constructor text field -->
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="constructor"
                                required>{{__('Car constructor')}}</label>
                            <div class="col-md-6">
                                <input id="constructor" name="constructor"
                                    class="form-control @error('constructor') is-invalid @enderror" type="text"
                                    placeholder="{{__('Car constructor')}}"
                                    value="{{ old('constructor') ?? $car->constructor }}" required>
                                @error('constructor')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Car category text field -->
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="category"
                                required>{{__('Car category')}}</label>
                            <div class="col-md-6">
                                <input id="category" name="category"
                                    class="form-control @error('category') is-invalid @enderror" type="text"
                                    placeholder="{{__('Car category')}}" value="{{ old('category') ?? $car->category }}"
                                    required>
                                @error('category')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <hr>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <!-- Back button -->
                                <a href="/car/{{$car->id}}" class="btn btn-primary btn-lg mr-3"><i
                                        class="fa fa-arrow-left"></i></a>
                                <!-- Submit button -->
                                <input class="btn btn-primary btn-lg" type="submit" value="{{__('Create')}}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection