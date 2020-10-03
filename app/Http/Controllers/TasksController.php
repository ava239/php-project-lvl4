<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
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

        return view('tasks.create', compact('task', 'taskStatuses', 'users'));
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
            ]
        );

        $task = new Task();
        $task->name = $request->input('name');
        $task->description = $request->input('description');
        $task->status()->associate($request->input('status_id'));
        $task->assignee()->associate($request->input('assigned_to_id'));
        $task->creator()->associate(Auth::user());

        $task->saveOrFail();

        flash(__('tasks.created'))->success();

        return redirect()
            ->route('tasks.show', $task);
    }

    public function show(Task $task)
    {
        //
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $taskStatuses = TaskStatus::all();
        $users = User::all();

        return view('tasks.edit', compact('task', 'taskStatuses', 'users'));
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
            ]
        );

        $task->name = $request->input('name');
        $task->description = $request->input('description');

        $task->status()->associate($request->input('status_id'));
        $task->assignee()->associate($request->input('assigned_to_id'));

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
