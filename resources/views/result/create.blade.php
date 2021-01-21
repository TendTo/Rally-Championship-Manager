@extends('layouts.app')

@section('title', "Crea il risultato")

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Add a new result!') }}</h4>
                </div>

                <div class="card-body pl-5">
                    <form method="POST"
                        action="/championship/{{$championship->id}}/rally/{{$rally->id}}/stage/{{$stage->id}}/result">
                        @csrf

                        <!-- Result participant dropdown -->
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="name">{{ __('Pilot') }}</label>
                            <div class="col-md-6">
                                <select id="participant_id" name="participant_id"
                                    class="form-control @error('participant_id') is-invalid @enderror">
                                    <option value="">{{__('Select a pilot')}}</option>
                                    @foreach ($participants as $participant)
                                    <option value="{{ $participant->id }}"
                                        {{( old('participant_id') == $participant->id ? "selected":"") }}>
                                        {{ $participant->user->name }} {{ $participant->user->surname }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('participant_id')
                                <div class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Result time time-pick -->
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="time">{{ __('Time') }}</label>
                            <div class="col-md-6">
                                <input id="time" name="time" class="form-control @error('time') is-invalid @enderror"
                                    type="time" step="0.001" value="{{ old('time') ?? '00:00'}}">
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
                                    step="0.001" value="{{ old('penality') ?? '00:00'}}">
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
                                    {{ __('Create') }}
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