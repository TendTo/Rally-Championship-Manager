@extends('layouts.app')

@section('title', "Crea un campionato")

<!-- Forms -->
<form id="deleteForm" action="/user/{{$user->id}}" method="POST">
    @method('DELETE')
    @csrf
</form>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Edit your profile!') }}</h4>
                </div>
                <div class="card-body pl-5">
                    <form method="POST" action="/user/{{$user->id}}">
                        @method('PATCH')
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') ?? $user->name }}" required
                                    autocomplete="given-name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="surname"
                                class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text"
                                    class="form-control @error('surname') is-invalid @enderror" name="surname"
                                    value="{{ old('surname') ?? $user->surname }}" required autocomplete="family-name"
                                    autofocus>

                                @error('surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') ?? $user->email }}" required
                                    autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="birthday"
                                class="col-md-4 col-form-label text-md-right">{{__('Birthday')}}</label>
                            <div class="col-md-6">
                                <input id="birthday" name="birthday"
                                    class="form-control @error('birthday') is-invalid @enderror" type="date"
                                    value="{{ old('birthday')  ?? $user->birthday }}" required>
                                @error('birthday')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="name">{{ __('Country') }}</label>
                            <div class="col-md-6">
                                <select id="location_id" name="location_id"
                                    class="form-control @error('location_id') is-invalid @enderror">
                                    <option value="">{{__('Select a country')}}</option>
                                    @foreach ($locations as $location)
                                    <option value="{{ $location->id }}"
                                        {{( $user->location->id == $location->id || old('location_id') == $location->id ? "selected":"") }}>
                                        {{ $location->country_code }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('location_id')
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
                                <a href="/user/{{$user->id}}" class="btn btn-primary btn-lg mr-3"><i
                                        class="fa fa-arrow-left"></i></a>
                                <!-- Submit button -->
                                <input class="btn btn-primary btn-lg" type="submit" value="{{__('Edit')}}">
                                <!-- Delete button -->
                                @can('delete', $user)
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

{{-- <div class="form-group row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

<div class="col-md-6">
    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
        required autocomplete="new-password">

    @error('password')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
</div>

<div class="form-group row">
    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

    <div class="col-md-6">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
            autocomplete="new-password">
    </div>
</div> --}}