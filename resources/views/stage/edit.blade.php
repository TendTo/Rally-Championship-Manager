@extends('layouts.app')

@section('title', "Modifica il rally")

<!-- Forms -->
<form id="deleteForm" action="/championship/{{$championship->id}}/rally/{{$rally->id}}/stage/{{$stage->id}}"
    method="POST">
    @csrf
    @method('DELETE')
</form>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Edit the stage!') }}</h4>
                </div>
                <div class="card-body pl-5">
                    <form method="POST"
                        action="/championship/{{$championship->id}}/rally/{{$rally->id}}/stage/{{$stage->id}}">
                        @csrf
                        @method('PATCH')

                        <!-- Stage name text field -->
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"
                                for="name">{{ __('Stage name') }}</label>
                            <div class="col-md-6">
                                <input id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                                    type="text" placeholder="{{ __('Stage name') }}"
                                    value="{{ old('name') ??  $stage->name}}" required>
                                @error('name')
                                <div class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Stage desc text field -->
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"
                                for="desc">{{ __('Stage description') }}</label>
                            <div class="col-md-6">
                                <textarea id="desc" name="desc" class="form-control @error('desc') is-invalid @enderror"
                                    rows="4">{{ old('desc') ?? $stage->desc}}</textarea>
                                @error('desc')
                                <div class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <!-- Back button -->
                                <a href="/championship/{{$championship->id}}/rally/{{$rally->id}}/stage/{{$stage->id}}"
                                    class="btn btn-primary mr-3"><i class="fa fa-arrow-left"></i></a>
                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save changes') }}
                                </button>
                                <!-- Delete button -->
                                @can('delete', $championship)
                                <button class="btn btn-danger btn-lg offset-md-3" type="submit" form="deleteForm"
                                    onclick="return confirm('Tutti i dati di questo stage verranno rimossi.\nProcedere comunque?')"><i
                                        class="fa fa-trash"></i></button>
                                @endcan
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection