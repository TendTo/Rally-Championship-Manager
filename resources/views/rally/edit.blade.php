@extends('layouts.app')

@section('title', "Modifica il rally")

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Edit the rally!') }}</h4>
                </div>
                <div class="card-body pl-5">
                    <form method="POST" action="/championship/{{$championship->id}}/rally/{{$rally->id}}">
                        @csrf
                        @method('PATCH')

                        <!-- Rally name text field -->
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"
                                for="name">{{ __('Rally name') }}</label>
                            <div class="col-md-6">
                                <input id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                                    type="text" placeholder="{{ __('Rally name') }}"
                                    value="{{ old('name') ??  $rally->name}}" required>
                                @error('name')
                                <div class="invalid-feedback">
                                    <strong>{{$errors->first('name')}}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Rally desc text field -->
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"
                                for="desc">{{ __('Rally description') }}</label>
                            <div class="col-md-6">
                                <textarea id="desc" name="desc" class="form-control @error('desc') is-invalid @enderror"
                                    rows="4">{{ old('desc') ?? $rally->desc}}</textarea>
                                @error('desc')
                                <div class="invalid-feedback">
                                    <strong>{{$errors->first('desc')}}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Rally location dropdown -->
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"
                                for="name">{{ __('Rally location') }}</label>
                            <div class="col-md-6">
                                <select id="location" name="location"
                                    class="form-control @error('location') is-invalid @enderror">
                                    <option value="">{{__('Select a location')}}</option>
                                    @foreach ($locations as $location)
                                    <option value="{{ $location->country_code }}"
                                        {{( $location->country_code == $rally->location->country_code || old('location') == $location->country_code ? "selected":"") }}>
                                        {{ $location->country_code }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('location')
                                <div class="invalid-feedback">
                                    <strong>{{$errors->first('location')}}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <!-- Back button -->
                                <a href="/championship/{{$championship->id}}/rally/{{$rally->id}}" class="btn btn-primary mr-3"><i
                                        class="fa fa-arrow-left"></i></a>
                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Edit') }}
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