{{ BsForm::text('name', $task->name)->label(__('layout.headers.name')) }}
{{ BsForm::textarea('description', $task->description)->label(__('layout.headers.description')) }}
{{ BsForm::select('status_id', $taskStatuses, $task->status_id)->label(__('layout.headers.status'))->placeholder(__('tasks.placeholder.choose_status')) }}
{{ BsForm::select('assigned_to_id', $users, $task->assigned_to_id)->label(__('layout.headers.assignee'))->placeholder(__('tasks.placeholder.choose_assignee')) }}
{{ BsForm::select('labels[]', $labels, $taskLabelIds)->multiple()->label(__('layout.headers.labels')) }}
