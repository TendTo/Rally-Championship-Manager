@extends('layouts.app')

@section('title')
{{$user->name}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card col-md-12">
            <div class="card-body">
                <div class="row">
                    <h4 class="card-title">{{$user->name}} {{$user->surname}}</h4>
                    <span
                        class="ml-2 mb-2 flag-icon flag-icon-{{strtolower($user->location->country_code)}} flag-icon-squared"></span>
                </div>
                <h6 class="card-subtitle mb-2 text-muted">
                    {{Carbon\Carbon::parse($user->birthday)->format('d/m/Y')}}
                </h6>
                <hr>
                <p class="card-text">{{$user->desc}}</p>
                <div>
                    <a href="/championship/" class="card-link">{{__('Stages')}} <i class="fa fa-car"></i></a>
                    <a href="#" class="card-link">{{__('Chart')}} <i class="fa fa-flag-checkered"></i></a>
                </div>
                <hr>
                <div>
                    <form class="form-group" action="/user/{{$user->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <!-- Back button -->
                        <div class="btn">
                            <a href="/user" class="card-link"><i class="fa fa-arrow-left"></i></a>
                        </div>
                        @can('update', $user)
                        <!-- Edit button -->
                        <div class="btn">
                            <a href="/user/{{$user->id}}/edit" class="card-link"><i class="fa fa-pencil"></i></a>
                        </div>
                        <!-- Delete button -->
                        <button class="btn" type="submit" value=""
                            onclick="return confirm('Tutti i dati associati a questo utente verranno rimossi.\nProcedere comunque?')">
                            <a class="card-link"><i class="fa fa-trash"></i></a>
                        </button>
                        @endcan
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection