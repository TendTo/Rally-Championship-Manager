@extends('layouts.base')

@section('title', "Modifica il campionato")

@section('content')
<div class="jumbotron mt-3">
    <h1 class="display-5">Modifica il campionato!</h1>
    <p class="lead">Modifica il campionato selezionato a piacimento.</p>
    <hr class="my-4">
    <div class="form-group col-3">
        <form action="/championship/{{$championship->id}}" method="post">
            @method('PATCH')
            @csrf
            <!-- Championship name text field -->
            <div class="form-group">
                <label class="form-control-label" for="name">*Nome campionato:</label>
                <input id="name" name="name" class="form-control @error('name') is-invalid @enderror" type="text"
                    placeholder="Nome campionato" value="{{ old('name') ??  $championship->name}}">
                @error('name')
                <div class="invalid-feedback">{{$errors->first('name')}}</div>
                @enderror
            </div>
            <!-- Championship desc text field -->
            <div class="form-group">
                <label class="form-control-label" for="desc">Descrizione campionato:</label>
                <input id="desc" name="desc" class="form-control @error('desc') is-invalid @enderror" type="text"
                    placeholder="Nome campionato" value="{{ old('desc') ?? $championship->desc}}">
                @error('desc')
                <div class="invalid-feedback">{{$errors->first('desc')}}</div>
                @enderror
            </div>
            <!-- Championship date date field -->
            <div class="form-group">
                <label class="form-control-label" for="date">*Data di inizio del campionato:</label>
                <input id="date" name="date" class="form-control @error('date') is-invalid @enderror" type="date"
                    value="{{ old('date') ??  $championship->date}}">
                @error('date')
                <div class="invalid-feedback">{{$errors->first('date')}}</div>
                @enderror
            </div>
            <!-- Championship archive checkbox -->
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="" checked>
                        Option one is this and that—be sure to include why it's great
                    </label>
                </div>
                @error('date')
                <div class="invalid-feedback">{{$errors->first('date')}}</div>
                @enderror
            </div>
            <hr>
            <!-- Back button -->
            <a href="/championship/{{$championship->id}}" class="btn btn-primary btn-lg mr-3"><i
                    class="fa fa-arrow-left"></i></a>
            <!-- Submit button -->
            <input class="btn btn-primary btn-lg" type="submit" value="Salva modifiche">
        </form>
    </div>
</div>

@endsection