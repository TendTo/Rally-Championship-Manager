@extends('layouts.app')

@section('title', "Modifica il campionato")

<!-- Forms -->
<form id="deleteForm" action="/championship/{{$championship->id}}" method="POST">
    @csrf
    @method('DELETE')
</form>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Edit the championship!') }}</h4>
                </div>
                <div class="card-body pl-5">
                    <form method="POST" action="/championship/{{$championship->id}}">
                        @csrf
                        @method('PATCH')

                        <!-- Championship name text field -->
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="name"
                                required>{{__('Championship name')}}</label>
                            <div class="col-md-6">
                                <input id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                                    type="text" placeholder="{{__('Championship name')}}"
                                    value="{{ old('name') ??  $championship->name}}">
                                @error('name')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Championship desc text field -->
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"
                                for="desc">{{__('Championship description')}}</label>
                            <div class="col-md-6">
                                <textarea class="form-control @error('desc') is-invalid @enderror" id="desc" rows="4"
                                    name="desc"
                                    placeholder="{{__('Championship description')}}">{{ old('desc') ?? $championship->desc}}</textarea>
                                @error('desc')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Championship date date field -->
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"
                                for="date">{{__('Championship starts on')}}</label>
                            <div class="col-md-6">
                                <input id="date" name="date" class="form-control @error('date') is-invalid @enderror"
                                    type="date" value="{{ old('date') ??  $championship->date}}">
                                @error('date')
                                <div class="invalid-feedback">{{$errors->first('date')}}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Championship archive checkbox -->
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Archivia il campionato:</label>
                            <div class="col-md-6">
                                <input id="archived" name="archived" class="mt-2" type="checkbox"
                                    @if($championship->archived) checked @endif>
                                @error('date')
                                <div class="invalid-feedback">{{$errors->first('date')}}</div>
                                @enderror
                            </div>
                        </div>

                        <hr>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <!-- Back button -->
                                <a href="/championship/{{$championship->id}}" class="btn btn-primary btn-lg mr-3"><i
                                        class="fa fa-arrow-left"></i></a>
                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save changes') }}
                                </button>
                                @can('delete', $championship)
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