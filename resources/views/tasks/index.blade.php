@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('tasks.title') }}</h1>
        <div class="d-flex">
            <div>
                {{ BsForm::get(route('tasks.index'), ['class' => 'form-inline']) }}
                {{ BsForm::select('filter[status_id]', $taskStatuses, optional($filter)['status_id'])->attribute('class', 'form-control mr-2')->placeholder(__('tasks.choose_status')) }}
                {{ BsForm::select('filter[created_by_id]', $creators, optional($filter)['created_by_id'])->attribute('class', 'form-control mr-2')->placeholder(__('tasks.choose_creator')) }}
                {{ BsForm::select('filter[assigned_to_id]', $assignees, optional($filter)['assigned_to_id'])->attribute('class', 'form-control mr-2')->placeholder(__('tasks.choose_assignee')) }}
                {{ BsForm::submit(__('apply'))->primary()->attribute('class', 'btn btn-outline-primary mr-2') }}
                @if($filter)
                    <a href="{{ route('tasks.index') }}" class="btn btn-outline-danger">{{ __('reset') }}</a>
                @endif
                {{ BsForm::close() }}
            </div>
            @auth
                <a href="{{ route('tasks.create') }}" class="btn btn-primary ml-auto">{{ __('add_new') }}</a>
            @endauth
        </div>
        <table class="table mt-2">
            <thead>
            <tr>
                <th>{{ __('id') }}</th>
                <th>{{ __('status') }}</th>
                <th>{{ __('name') }}</th>
                <th>{{ __('creator') }}</th>
                <th>{{ __('assignee') }}</th>
                <th>{{ __('created_at') }}</th>
                @auth
                    <th>{{ __('actions') }}</th>
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
                                    {{ __('edit') }}
                                </a>
                            @endcan
                            @can('delete', $task)
                                <a href="{{ route('tasks.destroy', $task) }}" data-confirm="{{ __('confirmation') }}"
                                   data-method="delete" rel="nofollow" class="text-danger">
                                    {{ __('remove') }}</a>
                            @endcan
                        </td>
                    @endauth
                </tr>
            @endforeach
        </table>

        {{ $tasks->links() }}
    </div>
@endsection
