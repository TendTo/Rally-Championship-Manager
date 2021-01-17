@extends('layouts.base')

@section('title', "Lista di campionati archiviati")

@section('content')
<div class="jumbotron mt-3">
    <h1 class="display-5">Lista dei campionati archiviati</h1>
    <p class="lead">Questi sono tutti i campionati precedentemente archiviati. Puoi ancora modificarli e vedere i loro dati.</p>
    <hr class="my-4">
    <ul class="list-group">
        <!-- List of items -->
        @foreach ($collection as $item)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="/championship/{{$item->id}}" class="list-group-item-action pl-3">
                <h5>{{$item->name}}</h5>
                <div class="text-muted">{{$item->desc}}</div>
            </a>
            {{-- <a href="/championship/{{$item->id}}/edit"><i class="fa fa-pencil"></i></a> --}}
        </li>
        @endforeach
    </ul>
    <!-- Back button -->
    <div class="modal-footer">
        <a href="/championship"><i class="btn btn-primary fa fa-arrow-left"></i></a>
    </div>
</div>

@endsection