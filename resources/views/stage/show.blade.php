@extends('layouts.app')

@section('title')
{{$rally->name}}
@endsection

<!-- Forms -->
<form id="deleteForm" action="/championship/{{$championship->id}}/rally/{{$rally->id}}/stage/{{$stage->id}}" method="POST">
    @csrf
    @method('DELETE')
</form>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card col-md-12">
            <div class="card-body">
                <div class="row ml-0">
                    <h4 class="card-title">{{$stage->name}}</h4>
                    <!-- Settings -->
                    @can('update', $championship)
                    <div class="ml-3">
                        <!-- Edit button -->
                        <div class="btn">
                            <a href="/championship/{{$championship->id}}/rally/{{$rally->id}}/stage/{{$stage->id}}/edit" class="card-link"><i
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
                <h6 class="card-subtitle mb-2 text-muted">{{$rally->location->country_code}}
                    <span
                        class="flag-icon flag-icon-{{strtolower($rally->location->country_code)}} flag-icon-squared"></span>
                </h6>
                <hr>
                <p class="card-text">{{$stage->desc}}</p>
                <div>
                    <a href="#" class="card-link">{{__('Chart')}} <i class="fa fa-flag-checkered"></i></a>
                </div>
                <hr>
                <div class="modal-footer">
                    <!-- Back button -->
                    <a href="/championship/{{$championship->id}}/rally/{{$rally->id}}"><i class="btn btn-primary fa fa-arrow-left"></i></a>
                    @can('update', $championship)
                    <!-- Add button -->
                    <a href="/championship/{{$championship->id}}/rally/{{$rally->id}}/stage/{{$stage->id}}/result/create"><i
                            class="btn btn-primary fa fa-plus"></i></a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>

@endsection