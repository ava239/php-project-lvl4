@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-5">
            {{ __('tasks.show_title') }}: {{ $task->name }}
            @auth
                <a href="{{ route('tasks.edit', $task) }}">&#9881;</a>
            @endauth
        </h1>
        <p>{{ __('tasks.name') }}: {{ $task->name }}</p>
        <p>{{ __('tasks.status') }}: {{ $task->status->name }}</p>
        <p>{{ __('tasks.description') }}: {{ $task->description }}</p>
    </div>
@endsection
