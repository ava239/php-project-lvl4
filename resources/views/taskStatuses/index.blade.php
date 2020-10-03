@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('task_statuses.title') }}</h1>
        @can('create', App\TaskStatus::class)
            <a href="{{ route('task_statuses.create') }}" class="btn btn-primary">{{ __('task_statuses.add_new') }}</a>
        @endcan
        <table class="table mt-2">
            <thead>
            <tr>
                <th>{{ __('task_statuses.id') }}</th>
                <th>{{ __('task_statuses.name') }}</th>
                <th>{{ __('task_statuses.created_at') }}</th>
                @canany(['delete','update'], App\TaskStatus::class)
                <th>{{ __('task_statuses.actions') }}</th>
                @endcanany
            </tr>
            </thead>
            @foreach($taskStatuses as $taskStatus)
                <tr>
                    <td>{{ $taskStatus->id }}</td>
                    <td>{{ $taskStatus->name }}</td>
                    <td>{{ $taskStatus->created_at }}</td>
                    @canany(['delete','update'], $taskStatus)
                    <td>
                        @can('delete', $taskStatus)
                            <a href="{{ route('task_statuses.destroy', $taskStatus) }}" data-confirm="are you sure?"
                               data-method="delete">
                                {{ __('task_statuses.remove') }}
                            </a>
                        @endcan
                        @can('update', $taskStatus)
                            <a href="{{ route('task_statuses.edit', $taskStatus) }}">
                                {{ __('task_statuses.edit') }}
                            </a>
                        @endcan
                    </td>
                    @endcanany
                </tr>
            @endforeach
        </table>

        {{ $taskStatuses->links() }}
    </div>
@endsection
