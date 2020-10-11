@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('layout.texts.reset_password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        {{ BsForm::post(route('password.email')) }}
                        {{ BsForm::email('email')->label(__('layout.texts.email'))->style('login') }}
                        {{ BsForm::submit(__('layout.texts.send_reset_link'))->style('login') }}
                        {{ BsForm::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
