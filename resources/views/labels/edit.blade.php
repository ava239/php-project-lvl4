@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('labels.edit_title') }}</h1>
        {!! Form::open()->fill($label)->route('labels.update', [$label])->method('PATCH')->attrs(['class' => 'w-50']) !!}
        @include('labels.form')
        <div>
            {!! Form::submit(__('update')) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
