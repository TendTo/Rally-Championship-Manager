@extends('layouts.base')

@section('title', "Modifica il rally")

@section('content')
<div class="jumbotron mt-3">
    <h1 class="display-5">Crea un nuovo rally!</h1>
    <p class="lead">Crea un nuovo rally scegliendo le impostazioni preferite.</p>
    <hr class="my-4">
    <div class="form-group col-3">
        <form action="/championship/{{$championship->id}}/rally" method="post">
            @csrf
            <!-- Rally name text field -->
            <div class="form-group">
                <label class="form-control-label" for="name">*Nome rally:</label>
                <input id="name" name="name" class="form-control @error('name') is-invalid @enderror" type="text"
                    placeholder="Nome campionato" value="{{ old('name')}}">
                @error('name')
                <div class="invalid-feedback">{{$errors->first('name')}}</div>
                @enderror
            </div>
            <!-- Rally desc text field -->
            <div class="form-group">
                <label class="form-control-label" for="desc">Descrizione rally:</label>
                <textarea class="form-control @error('desc') is-invalid @enderror" id="exampleTextarea" rows="3"
                    name="desc" placeholder="Descrizione campionato"
                    style="margin-top: 0px; margin-bottom: 0px; height: 82px;">{{ old('desc') }}</textarea>
                @error('desc')
                <div class="invalid-feedback">{{$errors->first('desc')}}</div>
                @enderror
            </div>
            <!-- Rally location dropdown -->
            <div class="form-group">
                <label class="form-control-label" for="location">*Location del rally:</label>
                <select id="location" name="location" class="form-control @error('location') is-invalid @enderror">
                    <option value="">Seleziona una location</option>
                    @foreach ($locations as $location)
                    <option value="{{ $location->country_code }}" {{( old('location') == $location->country_code ? "selected":"") }}>{{ $location->country_code }}</option>
                    @endforeach
                </select>
                @error('location')
                <div class="invalid-feedback">{{$errors->first('location')}}</div>
                @enderror
            </div>
            <!-- Back button -->
            <a href="/championship/{{$championship->id}}/rally" class="btn btn-primary btn-lg mr-3"><i
                    class="fa fa-arrow-left"></i></a>
            <!-- Submit button -->
            <input class="btn btn-primary btn-lg" type="submit" value="Crea rally">
        </form>
    </div>
</div>

@endsection