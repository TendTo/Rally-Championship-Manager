@extends('layouts.app')

@section('title', "Lista dei partecipanti")

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="jumbotron col-md-12">
            <h1 class="display-5">{{__('Participant list')}}</h1>
            <hr class="my-4">
            <ul class="list-group">
                <!-- List of items -->
                @foreach ($collection as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="/championship/{{$championship->id}}/participant/{{$item->id}}"
                        class="list-group-item-action pl-3 row">
                        <h5>{{$item->user->name}} {{$item->user->surname}}</h5>
                        <span
                            class="ml-2 mb-2 flag-icon flag-icon-{{strtolower($item->user->location->country_code)}} flag-icon-squared">
                    </a>
                </li>
                @endforeach
            </ul>
            <div class="modal-footer">
                <!-- Back button -->
                <a href="/championship/{{$championship->id}}"><i class="btn btn-primary fa fa-arrow-left"></i></a>
                @can('participate', $championship)
                <!-- Add button -->
                <a href="/championship/{{$championship->id}}/participant/create"><i
                        class="btn btn-primary fa fa-plus"></i></a>
                @endcan
            </div>
        </div>
    </div>
</div>

@endsection