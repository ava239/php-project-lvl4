@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('task_statuses.create_title') }}</h1>
        {{ BsForm::open(route('task_statuses.store'), ['class' => 'w-50']) }}
        @include('taskStatuses.form')
        <div>
            {{ BsForm::submit(__('layout.buttons.create'))->primary() }}
        </div>
        {{ Form::close() }}
    </div>
@endsection
