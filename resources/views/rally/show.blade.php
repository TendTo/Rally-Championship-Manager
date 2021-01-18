@extends('layouts.app')

@section('title')
{{$rally->name}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card col-md-12">
            <div class="card-body">
                <h4 class="card-title">{{$rally->name}}</h4>
                <h6 class="card-subtitle mb-2 text-muted">{{$rally->location->country_code}}</h6>
                <hr>
                <p class="card-text">{{$rally->desc}}</p>
                <div>
                    <a href="/championship/{{$championship->id}}/rally" class="card-link">{{__('Stages')}} <i
                            class="fa fa-car"></i></a>
                    <a href="#" class="card-link">{{__('Chart')}} <i class="fa fa-flag-checkered"></i></a>
                </div>
                <hr>
                <div>
                    <form class="form-group" action="/championship/{{$championship->id}}/rally/{{$rally->id}}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <!-- Back button -->
                        <div class="btn">
                            <a href="/championship/{{$championship->id}}/rally" class="card-link"><i
                                    class="fa fa-arrow-left"></i></a>
                        </div>
                        <!-- Edit button -->
                        <div class="btn">
                            <a href="/championship/{{$championship->id}}/rally/{{$rally->id}}/edit" class="card-link"><i
                                    class="fa fa-pencil"></i></a>
                        </div>
                        <!-- Delete button -->
                        <button class="btn" type="submit" value=""
                            onclick="return confirm('Tutti i dati associati a questo campionati verranno rimossi.\nProcedere comunque?')">
                            <a class="card-link"><i class="fa fa-trash"></i></a>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection