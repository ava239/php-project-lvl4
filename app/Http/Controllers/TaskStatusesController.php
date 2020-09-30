<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\Request;

class TaskStatusesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
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

        flash(__('task_status.created'))->success();

        return redirect()
            ->route('task_statuses.index');
    }

    public function edit($id)
    {
        $taskStatus = TaskStatus::findOrFail($id);

        return view('taskStatuses.edit', compact('taskStatus'));
    }

    public function update(Request $request, $id)
    {
        $taskStatus = TaskStatus::findOrFail($id);

        $data = $this->validate(
            $request,
            [
                'name' => 'required|unique:task_statuses,name,' . $taskStatus->id,
            ]
        );

        $taskStatus->fill($data);
        $taskStatus->save();

        flash(__('task_status.updated'))->success();

        return redirect()
            ->route('task_statuses.index');
    }

    public function destroy($id)
    {
        $taskStatus = TaskStatus::find($id);
        if ($taskStatus) {
            $taskStatus->delete();
            flash(__('task_status.deleted'))->success();
        }
        return redirect()
            ->route('task_statuses.index');
    }
}
