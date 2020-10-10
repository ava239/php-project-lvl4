@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('labels.edit_title') }}</h1>
        {{ BsForm::patch(route('labels.update', $label), ['class' => 'w-50']) }}
        @include('labels.form')
        <div>
            {{ BsForm::submit(__('update'))->primary() }}
        </div>
        {{ Form::close() }}
    </div>
@endsection
