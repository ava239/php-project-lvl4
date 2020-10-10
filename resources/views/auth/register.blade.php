@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    {{ BsForm::post(route('register')) }}
                    {{ BsForm::text('name')->label(__('Name'))->style('name') }}
                    {{ BsForm::email('email')->label(__('E-Mail Address'))->style('login') }}
                    {{ BsForm::password('password')->label(__('Password'))->attribute('autocomplete', 'new-password')->required()->style('login') }}
                    {{ BsForm::password('password_confirmation')->label(__('Confirm Password'))->attribute('autocomplete', 'new-password')->required()->style('login')->inlineValidation('false') }}
                    {{ BsForm::submit(__('Register'))->style('login') }}
                    {{ BsForm::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
