@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        {{ BsForm::post(route('password.email')) }}
                        {{ BsForm::email('email')->label(__('E-Mail Address'))->style('login') }}
                        {{ BsForm::submit(__('Send Password Reset Link'))->style('login') }}
                        {{ BsForm::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
