{!! Form::text('name', __('tasks.name')) !!}
{!! Form::textarea('description', __('tasks.description'))->attrs(['rows' => 10]) !!}
{!! Form::select('status_id', __('tasks.status'), $taskStatuses->prepend(__('tasks.choose_status'), '')) !!}
{!! Form::select('assigned_to_id', __('tasks.assignee'), $users->prepend(__('tasks.choose_assignee'), '')) !!}
