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
                            onclick="return confirm('Tutti i dati associati a questo rally verranno rimossi.\nProcedere comunque?')">
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
                <hr>
                @if(count($results) > 0)
                <h5>Results</h5>
                <ul class="list-group">
                    <!-- List of results -->
                    @foreach ($results as $i=>$item)
                    <li class="list-group-item">
                        <div class="row ml-1">
                            <div class="col-1">{{$i + 1}}</div>
                            <div class="col-4">
                                <h5>{{$item['participant']->user->name}} {{$item['participant']->user->surname}} </h5>
                                <span
                                    class="flag-icon flag-icon-{{strtolower($item['participant']->user->location->country_code)}} flag-icon-squared"></span>
                            </div>
                            <div class="col-5">
                                <h5>{{$item['tot_time']}}</h5>
                                @if ($i != 0)
                                <div class="text-danger">
                                    +{{\App\Utility\Utility::sum_time($item['tot_time'], $results[0]['tot_time'], '-')}}
                                </div>
                                @endif
                            </div>
                        </div>
                    </li>
                    @endforeach
                    @endif
                    @if (count($rets) > 0)
                    <!-- List of retired pilots -->
                    @foreach ($rets as $item)
                    <li class="list-group-item">
                        <div class="row ml-1">
                            <div class="col-1">-</div>
                            <div class="col-4">
                                <h5>{{$item->user->name}} {{$item->user->surname}} </h5>
                                <span
                                    class="flag-icon flag-icon-{{strtolower($item->user->location->country_code)}} flag-icon-squared"></span>
                            </div>
                            <div class="col-5">
                                <h5>{{__('RET')}}</h5>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @endif
                <div class="modal-footer">
                    <!-- Back button -->
                    <a href="/championship/{{$championship->id}}/rally/{{$rally->id}}"><i
                            class="btn btn-primary fa fa-arrow-left"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection