@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('tasks.title') }}</h1>
        <div class="d-flex">
            <div>
                {!! Form::open()->get()->formInline()->fill($filter)->attrs(['class' => 'filter-form']) !!}
                {!! Form::select('filter[status_id]', null, $taskStatuses) !!}
                {!! Form::select('filter[created_by_id]', null, $creators) !!}
                {!! Form::select('filter[assigned_to_id]', null, $assignees) !!}
                {!! Form::submit(__('apply'))->outline() !!}
                @if($filter->count())
                    <a href="{{ route('tasks.index') }}" class="btn btn-outline-danger">{{ __('reset') }}</a>
                @endif
                {!! Form::close() !!}
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
                            @can('delete', $task)
                                <a href="{{ route('tasks.destroy', $task) }}" data-confirm="{{ __('confirmation') }}"
                                   data-method="delete" rel="nofollow">
                                    {{ __('remove') }}
                                </a>
                            @endcan
                            @can('update', $task)
                                <a href="{{ route('tasks.edit', $task) }}">
                                    {{ __('edit') }}
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
