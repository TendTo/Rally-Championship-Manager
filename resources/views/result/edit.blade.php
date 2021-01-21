@extends('layouts.app')

@section('title', "Crea il risultato")

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Edit the result!') }}</h4>
                </div>

                <div class="card-body pl-5">
                    <form method="POST"
                        action="/championship/{{$championship->id}}/rally/{{$rally->id}}/stage/{{$stage->id}}/result/{{$result->id}}">
                        @csrf
                        @method('PATCH')

                        <!-- Result time time-pick -->
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="time">{{ __('Time') }}</label>
                            <div class="col-md-6">
                                <input id="time" name="time" class="form-control @error('time') is-invalid @enderror"
                                    type="time" step="0.001" value="{{ old('time') ?? $result->time }}">
                                @error('time')
                                <div class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Result penality time-pick -->
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"
                                for="penality">{{ __('Penality') }}</label>
                            <div class="col-md-6">
                                <input id="penality" name="penality"
                                    class="form-control @error('penality') is-invalid @enderror" type="time"
                                    step="0.001" value="{{ old('penality') ?? $result->penality }}">
                                @error('penality')
                                <div class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Result RET checkbox -->
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Retired:</label>
                            <div class="col-md-6">
                                <input id="ret" name="ret" class="mt-2" type="checkbox">
                                @error('ret')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <!-- Back button -->
                                <a href="/championship/{{$championship->id}}/rally/{{$rally->id}}/stage/{{$stage->id}}"
                                    class="btn btn-primary mr-3"><i class="fa fa-arrow-left"></i></a>
                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save changes') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection