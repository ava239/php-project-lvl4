@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('tasks.title') }}</h1>
        @can('create', App\Task::class)
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">{{ __('tasks.add_new') }}</a>
        @endcan
        <table class="table mt-2">
            <thead>
            <tr>
                <th>{{ __('tasks.id') }}</th>
                <th>{{ __('tasks.name') }}</th>
                <th>{{ __('tasks.created_at') }}</th>
                @canany(['delete','update'], App\Task::class)
                    <th>{{ __('tasks.actions') }}</th>
                @endcanany
            </tr>
            </thead>
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->created_at }}</td>
                    @canany(['delete','update'], $task)
                        <td>
                            @can('delete', $task)
                                <a href="{{ route('task_statuses.destroy', $task) }}" data-confirm="are you sure?"
                                   data-method="delete">
                                    {{ __('task_statuses.remove') }}
                                </a>
                            @endcan
                            @can('update', $task)
                                <a href="{{ route('task_statuses.edit', $task) }}">
                                    {{ __('task_statuses.edit') }}
                                </a>
                            @endcan
                        </td>
                    @endcanany
                </tr>
            @endforeach
        </table>

        {{ $tasks->links() }}
    </div>
@endsection
