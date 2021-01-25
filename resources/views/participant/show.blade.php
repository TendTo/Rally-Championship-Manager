@extends('layouts.app')

@section('title')
{{$participant->user->name}}
@endsection

<!-- Forms -->
@section('content')
<form id="upgradeForm" action="/championship/{{$championship->id}}/participant/{{$participant->id}}/upgrade"
    method="POST">
    @method('PATCH')
    @csrf
</form>
<form id="downgradeForm" action="/championship/{{$championship->id}}/participant/{{$participant->id}}/downgrade"
    method="POST">
    @method('PATCH')
    @csrf
</form>
<form id="deleteForm" action="/championship/{{$championship->id}}/participant/{{$participant->id}}" method="POST">
    @csrf
    @method('DELETE')
</form>

<div class="container">
    <div class="row justify-content-center">
        <div class="card col-md-12">
            <div class="card-body">
                <div class="row ml-0">
                    <h4 class="card-title">{{$participant->user->name}} {{$participant->user->surname}}</h4>
                    <span
                        class="ml-2 mb-2 flag-icon flag-icon-{{strtolower($participant->user->location->country_code)}} flag-icon-squared"></span>
                    <!-- Settings -->
                    <div class="ml-3">
                        @can('update', $participant)
                        <!-- Edit button -->
                        <div class="btn">
                            <a href="/championship/{{$championship->id}}/participant/{{$participant->id}}/edit"
                                class="card-link"><i class="fa fa-pencil"></i></a>
                        </div>
                        @endcan
                        @can('upgrade', $participant)
                        <!-- Upgrade button -->
                        <button class="btn" type="submit" form="upgradeForm"
                            onclick="return confirm('Il partecipante otterrà lo stato di admin')"><a
                                class="card-link"><i class="fa fa-arrow-up"></i></a></button>
                        @endcan
                        @can('downgrade', $participant)
                        <!-- Downgrade button -->
                        <button class="btn" type="submit" form="downgradeForm"
                            onclick="return confirm('Il partecipante perderà il suo stato di admin')"><a
                                class="card-link"><i class="fa fa-arrow-down"></i></a></button>
                        @endcan
                        @can('delete', $participant)
                        <!-- Delete button -->
                        <button class="btn" type="submit" form="deleteForm"
                            onclick="return confirm('Tutti i dati associati a questo utente verranno rimossi.\nProcedere comunque?')">
                            <a class="card-link"><i class="fa fa-trash"></i></a>
                        </button>
                        @endcan
                    </div>
                </div>
                <h6 class="card-subtitle mb-2 text-muted">
                    {{Carbon\Carbon::parse($participant->user->birthday)->format('d/m/Y')}}
                </h6>
                <hr>
                @if ($participant->car_id)
                <a href="'/car/'{{$participant->car->id}}" class="text-decoration-none">
                    {{$participant->car->model}}
                </a>
                @else
                <p class="card-text">
                    {{__('No car selected')}}
                </p>
                @endif
                {{-- <div>
                    <a href="#" class="card-link">{{__('Chart')}} <i class="fa fa-flag-checkered"></i></a>
            </div> --}}
            <hr>
            <div class="modal-footer">
                <!-- Back button -->
                <a href="/championship/{{$championship->id}}/participant"><i
                        class="btn btn-primary fa fa-arrow-left"></i></a>
            </div>
        </div>
    </div>
</div>
</div>

@endsection