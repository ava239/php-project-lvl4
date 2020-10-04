@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('labels.create_title') }}</h1>
        {!! Form::open()->route('labels.store')->fill($label)->attrs(['class' => 'w-50']) !!}
        @include('labels.form')
        <div>
            {!! Form::submit(__('create')) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
