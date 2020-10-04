<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Task::class);
    }

    public function index()
    {
        $tasks = Task::orderByDesc('created_at')->paginate(15);

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $task = new Task();
        $taskStatuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();

        $taskLabels = [];

        return view('tasks.create', compact('task', 'taskStatuses', 'users', 'labels', 'taskLabels'));
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'description' => 'max:500',
                'status_id' => 'required|exists:App\Models\TaskStatus,id',
                'assigned_to_id' => 'nullable|exists:App\Models\User,id',
                'labels.*' => 'required|exists:App\Models\Label,id',
            ]
        );

        $task = new Task();
        $task->name = $request->input('name');
        $task->description = $request->input('description');
        $task->status()->associate($request->input('status_id'));
        $task->assignee()->associate($request->input('assigned_to_id'));
        $task->creator()->associate(Auth::user());

        $task->saveOrFail();
        $task->labels()->attach($request->input('labels'));

        flash(__('tasks.created'))->success();

        return redirect()
            ->route('tasks.show', $task);
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $taskStatuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();

        $taskLabels = $task->labels->keyBy('id')->keys()->toArray();

        return view('tasks.edit', compact('task', 'taskStatuses', 'users', 'labels', 'taskLabels'));
    }

    public function update(Request $request, Task $task)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'description' => 'max:500',
                'status_id' => 'required|exists:App\Models\TaskStatus,id',
                'assigned_to_id' => 'nullable|exists:App\Models\User,id',
                'labels.*' => 'required|exists:App\Models\Label,id',
            ]
        );

        $task->name = $request->input('name');
        $task->description = $request->input('description');

        $task->status()->associate($request->input('status_id'));
        $task->assignee()->associate($request->input('assigned_to_id'));
        $task->labels()->sync($request->input('labels'));

        $task->saveOrFail();

        flash(__('tasks.updated'))->success();

        return redirect()
            ->route('tasks.show', $task);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        flash(__('tasks.deleted'))->success();

        return redirect()
            ->route('tasks.index');
    }
}
