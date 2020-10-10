@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('task_statuses.edit_title') }}</h1>
        {{ BsForm::patch(route('task_statuses.update', $taskStatus), ['class' => 'w-50']) }}
        @include('taskStatuses.form')
        <div>
            {{ BsForm::submit(__('layout.buttons.update'))->primary() }}
        </div>
        {{ BsForm::close() }}
    </div>
@endsection
