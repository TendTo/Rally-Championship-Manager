@extends('layouts.app')

@section('title', "Lista di campionati")

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="jumbotron col-md-12">
            <h1 class="display-5">{{__('Car list')}}</h1>
            <hr class="my-4">
            <ul class="list-group">
                <!-- List of items -->
                @foreach ($collection as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="/car/{{$item->id}}" class="list-group-item-action pl-3">
                        <h5>{{$item->model}}</h5>
                        <div class="text-muted">{{$item->constructor}}</div>
                    </a>
                </li>
                @endforeach
            </ul>
            <div class="modal-footer">
                <!-- Add button -->
                <a href="/car/create"><i class="btn btn-primary fa fa-plus"></i></a>
            </div>
        </div>
    </div>
</div>

@endsection