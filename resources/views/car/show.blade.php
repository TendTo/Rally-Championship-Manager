@extends('layouts.app')

@section('title')
{{$car->name}}
@endsection


@section('content')

<!-- Forms -->
<form id="deleteForm" class="form-group" action="/car/{{$car->id}}" method="POST">
    @csrf
    @method('DELETE')
</form>

<div class="container">
    <div class="row justify-content-center">
        <div class="card col-md-12">
            <div class="card-body">
                <div class="row ml-0">
                    <h4 class="card-title">{{$car->model}}</h4>
                    <!-- Edit button -->
                    <div class="ml-3">
                        <div class="btn">
                            <a href="/car/{{$car->id}}/edit" class="card-link"><i class="fa fa-pencil"></i></a>
                        </div>
                        <!-- Delete button -->
                        <button class="btn" type="submit" form="deleteForm"
                            onclick="return confirm('Tutti i dati associati a questa macchina verranno rimossi.\nProcedere comunque?')">
                            <a class="card-link"><i class="fa fa-trash "></i></a>
                        </button>
                    </div>
                </div>
                <h6 class="card-subtitle mb-2 text-muted">{{$car->category}}</h6>
                <hr>
                <p class="card-text">{{$car->constructor}}</p>
                {{-- <div>
                    <a href="#" class="card-link">{{__('Pilots')}} <i class="fa fa-users"></i></a>
                </div> --}}
                <hr>
                <div class="modal-footer">
                    <!-- Back button -->
                    <a href="/car"><i class="btn btn-primary fa fa-arrow-left"></i></a>
                </div>
                <div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection