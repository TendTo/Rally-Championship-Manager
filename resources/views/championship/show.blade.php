@extends('layouts.app')

@section('title')
{{$championship->name}}
@endsection


@section('content')

<!-- Forms -->
<form id="deleteForm" class="form-group" action="/championship/{{$championship->id}}" method="POST">
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
                        @endcan
                        @can('delete', $championship)
                        <!-- Delete button -->
                        <button class="btn" type="submit" form="deleteForm"
                            onclick="return confirm('Tutti i dati associati a questo campionati verranno rimossi.\nProcedere comunque?')">
                            <a class="card-link"><i class="fa fa-trash "></i></a>
                        </button>
                    </div>
                    @endcan
                </div>
                <h6 class="card-subtitle mb-2 text-muted">{{Carbon\Carbon::parse($championship->date)->format('d/m/Y')}}
                </h6>

                <hr>
                <p class="card-text">{{$championship->desc}}</p>
                <div>
                    {{-- <a href="/championship/{{$championship->id}}/rally" class="card-link">{{__('Rallies')}} <i
                        class="fa fa-car"></i></a> --}}
                    <a href="/championship/{{$championship->id}}/participant" class="card-link">{{__('Pilots')}} <i
                            class="fa fa-users"></i></a>
                    <a href="/championship/{{$championship->id}}/result" class="card-link">{{__('Chart')}} <i class="fa fa-flag-checkered"></i></a>
                </div>
                <hr>
                @if($championship->rallies->count() > 0)
                <h5>Rallies</h5>
                <ul class="list-group">
                    <!-- List of items -->
                    @foreach ($championship->rallies as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="/championship/{{$championship->id}}/rally/{{$item->id}}"
                            class="list-group-item-action pl-3">
                            <h5>{{$item->name}}</h5>
                            <div class="text-muted">{{$item->desc}}</div>
                        </a>
                        {{-- <a href="/championship/{{$item->id}}/edit"><i class="fa fa-pencil"></i></a> --}}
                    </li>
                    @endforeach
                </ul>
                @endif
                <div class="modal-footer">
                    <!-- Back button -->
                    <a href="/championship"><i class="btn btn-primary fa fa-arrow-left"></i></a>
                    @can('update', $championship)
                    <!-- Add button -->
                    <a href="/championship/{{$championship->id}}/rally/create"><i
                            class="btn btn-primary fa fa-plus"></i></a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>

@endsection