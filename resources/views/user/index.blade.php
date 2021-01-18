@extends('layouts.app')

@section('title', "Lista di piloti")

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="jumbotron col-md-12">
            <h1 class="display-5">{{__('Pilot list')}}</h1>
            <hr class="my-4">
            <ul class="list-group">
                <!-- List of items -->
                @foreach ($collection as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="/user/{{$item->id}}" class="list-group-item-action pl-3 row">
                        <h5>{{$item->name}} {{$item->surname}}</h5>
                        <span class="ml-2 mb-2 flag-icon flag-icon-{{strtolower($item->location->country_code)}} flag-icon-squared">
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

@endsection