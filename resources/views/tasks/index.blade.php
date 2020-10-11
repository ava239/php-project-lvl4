@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('tasks.title') }}</h1>
        <div class="d-flex">
            <div>
                {{ BsForm::get(route('tasks.index'), ['class' => 'form-inline']) }}
                {{ BsForm::select('filter[status_id]', $taskStatuses, optional($filter)['status_id'])->attribute('class', 'form-control mr-2')->placeholder(__('tasks.placeholder.choose_status')) }}
                {{ BsForm::select('filter[created_by_id]', $creators, optional($filter)['created_by_id'])->attribute('class', 'form-control mr-2')->placeholder(__('tasks.placeholder.choose_creator')) }}
                {{ BsForm::select('filter[assigned_to_id]', $assignees, optional($filter)['assigned_to_id'])->attribute('class', 'form-control mr-2')->placeholder(__('tasks.placeholder.choose_assignee')) }}
                {{ BsForm::submit(__('layout.buttons.apply'))->primary()->attribute('class', 'btn btn-outline-primary mr-2') }}
                @if($filter)
                    <a href="{{ route('tasks.index') }}" class="btn btn-outline-danger">{{ __('layout.buttons.reset') }}</a>
                @endif
                {{ BsForm::close() }}
            </div>
            @auth
                <a href="{{ route('tasks.create') }}" class="btn btn-primary ml-auto">{{ __('layout.buttons.add_new') }}</a>
            @endauth
        </div>
        <table class="table mt-2">
            <thead>
            <tr>
                <th>{{ __('layout.headers.id') }}</th>
                <th>{{ __('layout.headers.status') }}</th>
                <th>{{ __('layout.headers.name') }}</th>
                <th>{{ __('layout.headers.creator') }}</th>
                <th>{{ __('layout.headers.assignee') }}</th>
                <th>{{ __('layout.headers.created_at') }}</th>
                @auth
                    <th>{{ __('layout.headers.actions') }}</th>
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
                            @can('update', $task)
                                <a href="{{ route('tasks.edit', $task) }}">
                                    {{ __('layout.buttons.edit') }}
                                </a>
                            @endcan
                            @can('delete', $task)
                                <a href="{{ route('tasks.destroy', $task) }}" data-confirm="{{ __('layout.texts.confirmation') }}"
                                   data-method="delete" rel="nofollow" class="text-danger">
                                    {{ __('layout.buttons.remove') }}</a>
                            @endcan
                        </td>
                    @endauth
                </tr>
            @endforeach
        </table>

        {{ $tasks->links() }}
    </div>
@endsection
