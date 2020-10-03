@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('task_statuses.create_title') }}</h1>
        {!! Form::open()->route('task_statuses.store')->fill($taskStatus)->attrs(['class' => 'w-50']) !!}
        @include('taskStatuses.form')
        <div>
            {!! Form::submit(__('task_statuses.create')) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
