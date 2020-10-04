@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('tasks.edit_title') }}</h1>
        {!! Form::open()->fill($task)->route('tasks.update', [$task])->method('PATCH')->attrs(['class' => 'w-50']) !!}
        @include('tasks.form')
        <div>
            {!! Form::submit(__('update')) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
