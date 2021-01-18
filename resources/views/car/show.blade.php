@extends('layouts.app')

@section('title')
{{$car->name}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card col-md-12">
            <div class="card-body">
                <h4 class="card-title">{{$car->model}}</h4>
                <h6 class="card-subtitle mb-2 text-muted">{{$car->category}}</h6>
                <hr>
                <p class="card-text">{{$car->constructor}}</p>
                <div>
                    <a href="#" class="card-link">{{__('Pilots')}} <i class="fa fa-users"></i></a>
                </div>
                <hr>
                <div>
                    <form class="form-group" action="/car/{{$car->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <!-- Back button -->
                        <div class="btn">
                            <a href="/car" class="card-link"><i class="fa fa-arrow-left"></i></a>
                        </div>
                        <!-- Edit button -->
                        <div class="btn">
                            <a href="/car/{{$car->id}}/edit" class="card-link"><i
                                    class="fa fa-pencil"></i></a>
                        </div>
                        <!-- Delete button -->
                        <button class="btn" type="submit" value=""
                            onclick="return confirm('Tutti i dati associati a questa macchina verranno rimossi.\nProcedere comunque?')">
                            <a class="card-link"><i class="fa fa-trash "></i></a>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection