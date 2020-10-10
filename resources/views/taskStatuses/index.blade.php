@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('task_statuses.title') }}</h1>
        @auth
            <a href="{{ route('task_statuses.create') }}" class="btn btn-primary">{{ __('layout.buttons.add_new') }}</a>
        @endauth
        <table class="table mt-2">
            <thead>
            <tr>
                <th>{{ __('layout.headers.id') }}</th>
                <th>{{ __('layout.headers.name') }}</th>
                <th>{{ __('layout.headers.created_at') }}</th>
                @auth
                    <th>{{ __('layout.headers.actions') }}</th>
                @endauth
            </tr>
            </thead>
            @foreach($taskStatuses as $taskStatus)
                <tr>
                    <td>{{ $taskStatus->id }}</td>
                    <td>{{ $taskStatus->name }}</td>
                    <td>{{ $taskStatus->created_at }}</td>
                    @auth
                        <td>

                            @can('update', $taskStatus)
                                <a href="{{ route('task_statuses.edit', $taskStatus) }}">
                                    {{ __('layout.buttons.edit') }}
                                </a>
                            @endcan
                            @can('delete', $taskStatus)
                                <a href="{{ route('task_statuses.destroy', $taskStatus) }}"
                                   data-confirm="{{ __('layout.confirmation') }}"
                                   data-method="delete" rel="nofollow" class="text-danger">
                                    {{ __('layout.buttons.remove') }}</a>
                            @endcan
                        </td>
                    @endauth
                </tr>
            @endforeach
        </table>

        {{ $taskStatuses->links() }}
    </div>
@endsection
