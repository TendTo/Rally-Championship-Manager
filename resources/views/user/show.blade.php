@extends('layouts.app')

@section('title')
{{$user->name}}
@endsection


@section('content')

<!-- Forms -->
<form id="deleteForm" class="form-group" action="/user/{{$user->id}}" method="POST">
    @csrf
    @method('DELETE')
</form>

<div class="container">
    <div class="row justify-content-center">
        <div class="card col-md-12">
            <div class="card-body">
                <div class="row">
                    <h4 class="card-title">{{$user->name}} {{$user->surname}}</h4>
                    <span
                        class="ml-2 mb-2 flag-icon flag-icon-{{strtolower($user->location->country_code)}} flag-icon-squared"></span>
                    <div class="ml-3">
                        @can('update', $user)
                        <!-- Edit button -->
                        <div class="btn">
                            <a href="/user/{{$user->id}}/edit" class="card-link"><i class="fa fa-pencil"></i></a>
                        </div>
                        @endcan
                        @can('delete', $user)
                        <!-- Delete button -->
                        <button class="btn" type="submit" value="" form="deleteForm"
                            onclick="return confirm('Tutti i dati associati a questo utente verranno rimossi.\nProcedere comunque?')">
                            <a class="card-link"><i class="fa fa-trash"></i></a>
                        </button>
                        @endcan
                    </div>
                </div>
                <h6 class="card-subtitle mb-2 text-muted">
                    {{Carbon\Carbon::parse($user->birthday)->format('d/m/Y')}}
                </h6>
                <hr>
                <p class="card-text">{{$user->desc}}</p>
                <hr>
                <div class="modal-footer">
                    <!-- Back button -->
                    <a href="/user"><i class="btn btn-primary fa fa-arrow-left"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection