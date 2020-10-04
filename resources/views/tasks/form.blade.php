{!! Form::text('name', __('name')) !!}
{!! Form::textarea('description', __('description'))->attrs(['rows' => 10]) !!}
{!! Form::select('status_id', __('status'), $taskStatuses->prepend(__('tasks.choose_status'), '')) !!}
{!! Form::select('assigned_to_id', __('assignee'), $users->prepend(__('tasks.choose_assignee'), '')) !!}
