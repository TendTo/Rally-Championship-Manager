@extends('layouts.app')

@section('title')
{{$championship->name}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card col-md-12">
            <div class="card-body">
                <h4 class="card-title">{{$championship->name}}</h4>
                <h6 class="card-subtitle mb-2 text-muted">{{Carbon\Carbon::parse($championship->date)->format('d/m/Y')}}
                </h6>
                <hr>
                <p class="card-text">{{$championship->desc}}</p>
                <div>
                    <a href="/championship/{{$championship->id}}/rally" class="card-link">{{__('Rallies')}} <i
                            class="fa fa-car"></i></a>
                    <a href="/championship/{{$championship->id}}/participant" class="card-link">{{__('Pilots')}} <i
                            class="fa fa-users"></i></a>
                    <a href="#" class="card-link">{{__('Chart')}} <i class="fa fa-flag-checkered"></i></a>
                </div>
                <hr>
                <div>
                    <form class="form-group" action="/championship/{{$championship->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <!-- Back button -->
                        <div class="btn">
                            <a href="/championship" class="card-link"><i class="fa fa-arrow-left"></i></a>
                        </div>
                        @can('update', $championship)
                        <!-- Edit button -->
                        <div class="btn">
                            <a href="/championship/{{$championship->id}}/edit" class="card-link"><i
                                    class="fa fa-pencil"></i></a>
                        </div>
                        @endcan
                        @can('delete', $championship)
                        <!-- Delete button -->
                        <button class="btn" type="submit" value=""
                            onclick="return confirm('Tutti i dati associati a questo campionati verranno rimossi.\nProcedere comunque?')">
                            <a class="card-link"><i class="fa fa-trash "></i></a>
                        </button>
                        @endcan
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection