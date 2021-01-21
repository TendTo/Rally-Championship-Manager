@extends('layouts.app')

@section('title', "Lista di risultati")

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="jumbotron col-md-12">
            <h1 class="display-5"><strong>{{$stage->name}} |</strong> {{__('Result list')}}</h1>
            <hr class="my-4">
            <ul class="list-group">
                <!-- List of items -->
                @foreach ($collection as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="/championship/{{$championship->id}}/rally/{{$rally->id}}/stage/{{$stage->id}}/result/{{$item->id}}"
                        class="list-group-item-action pl-3">
                        <h5>{{$item->time}}</h5>
                        <div class="text-muted">{{$item->penality}}</div>
                    </a>
                </li>
                @endforeach
            </ul>
            <div class="modal-footer">
                <!-- Back button -->
                <a href="/championship/{{$championship->id}}/rally/{{$rally->id}}"><i class="btn btn-primary fa fa-arrow-left"></i></a>
                @can('update', $championship)
                <!-- Add button -->
                <a href="/championship/{{$championship->id}}/rally/{{$rally->id}}/stage/create"><i
                        class="btn btn-primary fa fa-plus"></i></a>
                @endcan
            </div>
        </div>
    </div>
</div>

@endsection