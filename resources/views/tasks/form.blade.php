{{ BsForm::text('name', $task->name)->label(__('name')) }}
{{ BsForm::textarea('description', $task->description)->label(__('description')) }}
{{ BsForm::select('status_id', $taskStatuses, $task->status_id)->label(__('status'))->placeholder(__('tasks.choose_status')) }}
{{ BsForm::select('assigned_to_id', $users, $task->assigned_to_id)->label(__('assignee'))->placeholder(__('tasks.choose_assignee')) }}
{{ BsForm::select('labels[]', $labels, $taskLabels)->multiple()->label(__('labels')) }}
