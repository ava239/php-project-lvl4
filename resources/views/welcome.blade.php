@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">{{ config('app.name') }}</h1>
            <p class="lead">{{ __('app_name') }}</p>
        </div>
    </div>
@endsection
