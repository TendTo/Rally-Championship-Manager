@extends('layouts.app')

@section('title', "Lista di campionati")

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="jumbotron col-md-12">
            <h1 class="display-5">{{__('Personal championship list')}}</h1>
            <hr class="my-4">
            <ul class="list-group">
                <!-- List of items -->
                @foreach ($collection as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="/championship/{{$item->id}}" class="list-group-item-action pl-3">
                        <h5>{{$item->name}}</h5>
                        <div class="text-muted">{{$item->desc}}</div>
                    </a>
                </li>
                @endforeach
            </ul>
            <div class="modal-footer">
                <!-- Back button -->
                <a href="/championship"><i class="btn btn-primary fa fa-arrow-left"></i></a>
            </div>
        </div>
    </div>
</div>

@endsection