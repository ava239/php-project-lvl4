@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('tasks.edit_title') }}</h1>
        {{ BsForm::patch(route('tasks.update', $task), ['class' => 'w-50']) }}
        @include('tasks.form')
        <div>
            {{ BsForm::submit(__('update'))->primary() }}
        </div>
        {{ BsForm::close() }}
    </div>
@endsection
