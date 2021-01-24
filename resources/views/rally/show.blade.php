@extends('layouts.app')

@section('title')
{{$rally->name}}
@endsection


@section('content')

<!-- Forms -->
<form id="deleteForm" action="/championship/{{$championship->id}}/rally/{{$rally->id}}" method="POST">
    @csrf
    @method('DELETE')
</form>

<div class="container">
    <div class="row justify-content-center">
        <div class="card col-md-12">
            <div class="card-body">
                <div class="row ml-0 mb-2 d-flex align-items-center">
                    <h4 class="card-title mb-0">{{$rally->name}}</h4>
                    <!-- Settings -->
                    @can('update', $championship)
                    <div class="ml-3">
                        <!-- Edit button -->
                        <div class="btn">
                            <a href="/championship/{{$championship->id}}/rally/{{$rally->id}}/edit" class="card-link"><i
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
                <h6 class="card-subtitle mb-2 text-muted">{{$rally->location->country_name}}
                    <span
                        class="flag-icon flag-icon-{{strtolower($rally->location->country_code)}} flag-icon-squared"></span>
                </h6>
                <hr>
                <p class="card-text">{{$rally->desc}}</p>
                <div>
                    <a href="/championship/{{$championship->id}}/rally/{{$rally->id}}/result" class="card-link">{{__('Chart')}} <i class="fa fa-flag-checkered"></i></a>
                </div>
                <hr>
                @if($rally->stages->count() > 0)
                <h5>Stages</h5>
                <ul class="list-group">
                    <!-- List of items -->
                    @foreach ($rally->stages as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="/championship/{{$championship->id}}/rally/{{$rally->id}}/stage/{{$item->id}}"
                            class="list-group-item-action pl-3">
                            <h5>{{$item->name}}</h5>
                            <div class="text-muted">{{$item->desc}}</div>
                        </a>
                    </li>
                    @endforeach
                </ul>
                @endif
                <div class="modal-footer">
                    <!-- Back button -->
                    <a href="/championship/{{$championship->id}}"><i class="btn btn-primary fa fa-arrow-left"></i></a>
                    @can('update', $championship)
                    <!-- Add button -->
                    <a href="/championship/{{$championship->id}}/rally/{{$rally->id}}/stage/create"><i
                            class="btn btn-primary fa fa-plus"></i></a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>

@endsection