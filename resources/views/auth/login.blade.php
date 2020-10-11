@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('layout.texts.login') }}</div>

                <div class="card-body">
                    {{ BsForm::post(route('login')) }}
                    {{ BsForm::email('email')->label(__('layout.texts.email'))->style('login') }}
                    {{ BsForm::password('password')->attribute('autocomplete', 'current-password')->required()->label(__('layout.texts.password'))->style('login') }}
                    {{ BsForm::checkbox('remember')->label(__('layout.texts.remember_me'))->style('login') }}
                    {{ BsForm::submit(__('layout.texts.login'))->style('login')->attribute('addForgotLink', true) }}
                    {{ BsForm::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
