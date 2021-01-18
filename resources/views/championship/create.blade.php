@extends('layouts.app')

@section('title', "Crea un campionato")

@section('content')
<div class="jumbotron m-5">
    <h1 class="display-5">Crea un nuovo campionato!</h1>
    <p class="lead">Crea un nuovo campionato specificandone il nome e la data un cui si terrà.</p>
    <hr class="my-4">
    <div class="form-group col-3">
        <form action="/championship" method="post">
            @csrf
            <!-- Championship name -->
            <div class="form-group">
                <label class="form-control-label" for="name">Nome campionato:</label>
                <input id="name" name="name" class="form-control @error('name') is-invalid @enderror" type="text"
                    placeholder="Nome campionato" value="{{ old('name')}}">
                @error('name')
                <div class="invalid-feedback">{{$errors->first('name')}}</div>
                @enderror
            </div>
            <!-- Championship desc -->
            <div class="form-group">
                <label class="form-control-label" for="desc">Descrizione campionato:</label>
                <input id="desc" name="desc" class="form-control @error('desc') is-invalid @enderror" type="text"
                    placeholder="Nome campionato" value="{{ old('desc')}}">
                @error('desc')
                <div class="invalid-feedback">{{$errors->first('desc')}}</div>
                @enderror
            </div>
            <!-- Championship date -->
            <div class="form-group">
                <label class="form-control-label" for="date">Nome campionato:</label>
                <input id="date" name="date" class="form-control @error('date') is-invalid @enderror" type="date"
                    value="{{ old('date')}}">
                @error('date')
                <div class="invalid-feedback">{{$errors->first('date')}}</div>
                @enderror
            </div>
            <hr>
            <!-- Back button -->
            <a href="/championship" class="btn btn-primary btn-lg mr-3"><i class="fa fa-arrow-left"></i></a>
            <!-- Submit button -->
            <input class="btn btn-primary btn-lg" type="submit" value="Crea">
        </form>
    </div>
</div>

@endsection