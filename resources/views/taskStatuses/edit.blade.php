@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('task_statuses.edit_title') }}</h1>
        {!! Form::open()->fill($taskStatus)->route('task_statuses.update', [$taskStatus])->method('PATCH') !!}
        @include('taskStatuses.form')
        <div>
            {!! Form::submit(__('task_statuses.update')) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
