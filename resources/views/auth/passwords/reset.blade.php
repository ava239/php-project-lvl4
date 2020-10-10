@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    {{ BsForm::post(route('password.update')) }}
                    {{ Form::hidden('token', $token) }}
                    {{ BsForm::email('email')->label(__('E-Mail Address'))->style('login')->value($email) }}
                    {{ BsForm::password('password')->label(__('Password'))->attribute('autocomplete', 'new-password')->required()->style('login') }}
                    {{ BsForm::password('password_confirmation')->label(__('Confirm Password'))->attribute('autocomplete', 'new-password')->required()->style('login')->inlineValidation('false') }}
                    {{ BsForm::submit(__('Reset Password'))->style('login') }}
                    {{ BsForm::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
