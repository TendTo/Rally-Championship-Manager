@extends('layouts.base')

@section('title', "Lista di campionati")

@section('content')
<div class="jumbotron mt-3">
    <h1 class="display-5">Lista dei rally del campionato <strong>{{$championship->name}}</strong></h1>
    <p class="lead">Crea un nuovo rally specificandone il nome e la località in cui si terrà.</p>
    <hr class="my-4">
    <ul class="list-group">
        <!-- List of items -->
        @foreach ($collection as $item)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="/championship/{{$championship->id}}/rally/{{$item->id}}" class="list-group-item-action pl-3">
                <h5>{{$item->name}}</h5>
                <div class="text-muted">{{$item->desc}}</div>
            </a>
            {{-- <a href="/championship/{{$item->id}}/edit"><i class="fa fa-pencil"></i></a> --}}
        </li>
        @endforeach
    </ul>
    <div class="modal-footer">
        <!-- Back button -->
        <a href="/championship/{{$championship->id}}"><i class="btn btn-primary fa fa-arrow-left"></i></a>
        <!-- Add button -->
        <a href="/championship/{{$championship->id}}/rally/create"><i class="btn btn-primary fa fa-plus"></i></a>
    </div>
</div>

@endsection