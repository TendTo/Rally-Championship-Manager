@extends('layouts.app')

@section('title')
{{$championship->name}}
@endsection


@section('content')

<!-- Forms -->
<form id="deleteForm" action="/championship/{{$championship->id}}" method="POST">
    @csrf
    @method('DELETE')
</form>

<div class="container">
    <div class="row justify-content-center">
        <div class="card col-md-12">
            <div class="card-body">
                <div class="row ml-0 mb-2 d-flex align-items-center">
                    <h4 class="card-title mb-0">{{$championship->name}}</h4>
                    <!-- Settings -->
                    @can('update', $championship)
                    <div class="ml-3">
                        <!-- Edit button -->
                        <div class="btn">
                            <a href="/championship/{{$championship->id}}/edit" class="card-link"><i
                                    class="fa fa-pencil"></i></a>
                        </div>
                        <!-- Delete button -->
                        <button class="btn" type="submit" form="deleteForm"
                            onclick="return confirm('Tutti i dati associati a questo campionati verranno rimossi.\nProcedere comunque?')">
                            <a class="card-link"><i class="fa fa-trash"></i></a>
                        </button>
                    </div>
                    @endcan
                </div>
                <hr>
                <p class="card-text">{{$championship->desc}}</p>
                <hr>
                @if(count($chart) > 0)
                <h5>Results</h5>
                <ul class="list-group">
                    <!-- List of results -->
                    @foreach ($chart as $i=>$item)
                    <li class="list-group-item">
                        <div class="row ml-1">
                            <div class="col-1">{{$i + 1}}</div>
                            <div class="col-4">
                                <h5>{{$item['participant']->user->name}} {{$item['participant']->user->surname}} </h5>
                                <span
                                    class="flag-icon flag-icon-{{strtolower($item['participant']->user->location->country_code)}} flag-icon-squared"></span>
                            </div>
                            <div class="col-3">
                                <h5 class="ml-3">{{$item['points']}}</h5>
                            </div>
                        </div>
                    </li>
                    @endforeach
                    @endif
                    <div class="modal-footer">
                        <!-- Back button -->
                        <a href="/championship/{{$championship->id}}"><i
                                class="btn btn-primary fa fa-arrow-left"></i></a>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection