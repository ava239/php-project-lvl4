@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('tasks.title') }}</h1>
        @auth
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">{{ __('tasks.add_new') }}</a>
        @endauth
        <table class="table mt-2">
            <thead>
            <tr>
                <th>{{ __('tasks.id') }}</th>
                <th>{{ __('tasks.status') }}</th>
                <th>{{ __('tasks.name') }}</th>
                <th>{{ __('tasks.creator') }}</th>
                <th>{{ __('tasks.assignee') }}</th>
                <th>{{ __('tasks.created_at') }}</th>
                @auth
                    <th>{{ __('tasks.actions') }}</th>
                @endauth
            </tr>
            </thead>
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->status->name }}</td>
                    <td><a href="{{ route('tasks.show', $task) }}">{{ $task->name }}</a></td>
                    <td>{{ $task->creator->name }}</td>
                    <td>{{ optional($task->assignee)->name }}</td>
                    <td>{{ $task->created_at }}</td>
                    @auth
                        <td>
                            @can('delete', $task)
                                <a href="{{ route('tasks.destroy', $task) }}" data-confirm="{{ __('tasks.confirmation') }}"
                                   data-method="delete">
                                    {{ __('tasks.remove') }}
                                </a>
                            @endcan
                            @can('update', $task)
                                <a href="{{ route('tasks.edit', $task) }}">
                                    {{ __('tasks.edit') }}
                                </a>
                            @endcan
                        </td>
                    @endauth
                </tr>
            @endforeach
        </table>

        {{ $tasks->links() }}
    </div>
@endsection
