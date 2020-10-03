@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('tasks.create_title') }}</h1>
        {!! Form::open()->route('tasks.store')->fill($task)->attrs(['class' => 'w-50']) !!}
        @include('tasks.form')
        <div>
            {!! Form::submit(__('tasks.create')) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
