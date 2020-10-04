<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(TaskStatus::class);
    }

    public function index()
    {
        $taskStatuses = TaskStatus::orderBy('name')->paginate(15);

        return view('taskStatuses.index', compact('taskStatuses'));
    }

    public function create()
    {
        $taskStatus = new TaskStatus();

        return view('taskStatuses.create', compact('taskStatus'));
    }

    public function store(Request $request)
    {
        $data = $this->validate(
            $request,
            [
                'name' => 'required|unique:task_statuses',
            ]
        );

        $taskStatus = new TaskStatus();
        $taskStatus->fill($data);
        $taskStatus->save();

        flash(__('task_statuses.created'))->success();

        return redirect()
            ->route('task_statuses.index');
    }

    public function edit(TaskStatus $taskStatus)
    {
        return view('taskStatuses.edit', compact('taskStatus'));
    }

    public function update(Request $request, TaskStatus $taskStatus)
    {
        $data = $this->validate(
            $request,
            [
                'name' => 'required|unique:task_statuses,name,' . $taskStatus->id,
            ]
        );

        $taskStatus->fill($data);
        $taskStatus->save();

        flash(__('task_statuses.updated'))->success();

        return redirect()
            ->route('task_statuses.index');
    }

    public function destroy(TaskStatus $taskStatus)
    {
        $taskStatus->delete();
        flash(__('task_statuses.deleted'))->success();

        return redirect()
            ->route('task_statuses.index');
    }
}