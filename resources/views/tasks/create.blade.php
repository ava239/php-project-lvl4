@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('tasks.create_title') }}</h1>
        {{ BsForm::post(route('tasks.store'), ['class' => 'w-50']) }}
        @include('tasks.form')
        <div>
            {{ BsForm::submit(__('layout.buttons.create'))->primary() }}
        </div>
        {{ BsForm::close() }}
    </div>
@endsection
