@extends('layouts.app')

@section('title', "About")

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="jumbotron col-md-12">
            <h1 class="display-5">{{__('About')}}</h1>
            <hr class="my-4">
            <p>Let this web application manage the boring stuff of your rally championship, keeping track of results and points for each rally and stage, so you can be focused on achieving the best TEMPO!!</p>
            <p>GitHub repository <a href="https://github.com/TendTo/rally-championship-manager"><i class="btn btn-primary fa fa-github"></i></a></p>
            <div class="modal-footer">
                <a href="/championship"><i class="btn btn-primary fa fa-arrow-left"></i></a>
            </div>
        </div>
    </div>
</div>

@endsection