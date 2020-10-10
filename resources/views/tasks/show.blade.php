@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-5">
            {{ __('tasks.show_title') }}: {{ $task->name }}
            @auth
                <a href="{{ route('tasks.edit', $task) }}">&#9881;</a>
            @endauth
        </h1>
        <p>{{ __('layout.headers.name') }}: {{ $task->name }}</p>
        <p>{{ __('layout.headers.status') }}: {{ $task->status->name }}</p>
        @if($task->description)
            <p>{{ __('layout.headers.description') }}: {{ $task->description }}</p>
        @endif
        @if($task->labels()->exists())
            <p>{{ __('layout.headers.labels') }}: </p>
            <ul>
                @foreach($task->labels as $label)
                    <li>{{ $label->name }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
