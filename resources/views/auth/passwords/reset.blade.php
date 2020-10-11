@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('layout.texts.reset_password') }}</div>

                <div class="card-body">
                    {{ BsForm::post(route('password.update')) }}
                    {{ Form::hidden('token', $token) }}
                    {{ BsForm::email('email')->label(__('layout.texts.email'))->style('login')->value($email) }}
                    {{ BsForm::password('password')->label(__('layout.texts.password'))->attribute('autocomplete', 'new-password')->required()->style('login') }}
                    {{ BsForm::password('password_confirmation')->label(__('layout.texts.confirm_password'))->attribute('autocomplete', 'new-password')->required()->style('login')->inlineValidation('false') }}
                    {{ BsForm::submit(__('layout.texts.reset_password'))->style('login') }}
                    {{ BsForm::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
