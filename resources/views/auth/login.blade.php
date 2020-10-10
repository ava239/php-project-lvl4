@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    {{ BsForm::post(route('login')) }}
                    {{ BsForm::email('email')->label(__('E-Mail Address'))->style('login') }}
                    {{ BsForm::password('password')->attribute('autocomplete', 'current-password')->required()->label(__('Password'))->style('login') }}
                    {{ BsForm::checkbox('remember')->label(__('Remember Me'))->style('login') }}
                    {{ BsForm::submit(__('Login'))->style('login')->attribute('addForgotLink', true) }}
                    {{ BsForm::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
