@extends('layouts.app')

@section('title', "Modifica il campionato")

@section('content')
<div class="jumbotron m-5">
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
                <textarea class="form-control @error('desc') is-invalid @enderror" id="exampleTextarea" rows="3"
                    name="desc" placeholder="Descrizione campionato"
                    style="margin-top: 0px; margin-bottom: 0px; height: 82px;">{{ old('desc') ?? $championship->desc}}</textarea>
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
                <div class="form-control-label">
                    Archivia il campionato:
                    <input id="archived" name="archived" class="ml-1" type="checkbox"
                        @if($championship->archived) checked @endif>
                    <label class="form-check-label" for="archived">
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