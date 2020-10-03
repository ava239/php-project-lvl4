{!! Form::text('name', __('tasks.name')) !!}
{!! Form::textarea('description', __('tasks.description'))->attrs(['rows' => 10]) !!}
{!! Form::select('status_id', __('tasks.status'))->options(\App\Models\TaskStatus::all()) !!}
{!! Form::select('assigned_to_id', __('tasks.assignee'))->options(\App\Models\User::all()) !!}
