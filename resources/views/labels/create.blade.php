@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('labels.create_title') }}</h1>
        {{ BsForm::post(route('labels.store'), ['class' => 'w-50']) }}
        @include('labels.form')
        <div>
            {{ BsForm::submit(__('layout.buttons.create'))->primary() }}
        </div>
        {{ BsForm::close() }}
    </div>
@endsection
