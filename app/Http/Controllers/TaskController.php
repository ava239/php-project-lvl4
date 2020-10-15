<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Task::class);
    }

    public function index(Request $request)
    {
        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters([
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('assigned_to_id'),
                AllowedFilter::exact('created_by_id')
            ])
            ->with(['status', 'creator', 'assignee'])
            ->latest()
            ->paginate(15);

        $filter = $request->get('filter');

        $taskStatuses = TaskStatus::pluck('name', 'id');
        $creators = User::pluck('name', 'id');
        $assignees = User::pluck('name', 'id');

        return view('tasks.index', compact('tasks', 'taskStatuses', 'creators', 'assignees', 'filter'));
    }

    public function create()
    {
        $task = new Task();

        $taskStatuses = TaskStatus::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $labels = Label::pluck('name', 'id');

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
                'status_id' => 'required|exists:task_statuses,id',
                'assigned_to_id' => 'nullable|exists:users,id',
                'labels.*' => 'required|exists:labels,id',
            ]
        );

        $task = new Task();
        $data = $request->only(['name', 'description']);
        $task->fill($data);

        $task->status()->associate($request->input('status_id'));
        $task->assignee()->associate($request->input('assigned_to_id'));
        $task->creator()->associate(Auth::user());

        $task->saveOrFail();
        $task->labels()->attach($request->input('labels'));

        flash(__('tasks.flash.created'))->success();

        return redirect()
            ->route('tasks.show', $task);
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $taskStatuses = TaskStatus::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $labels = Label::pluck('name', 'id');

        $taskLabels = $task->labels->modelKeys();

        return view('tasks.edit', compact('task', 'taskStatuses', 'users', 'labels', 'taskLabels'));
    }

    public function update(Request $request, Task $task)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'description' => 'max:500',
                'status_id' => 'required|exists:task_statuses,id',
                'assigned_to_id' => 'nullable|exists:users,id',
                'labels.*' => 'required|exists:labels,id',
            ]
        );

        $data = $request->only(['name', 'description']);
        $task->fill($data);

        $task->status()->associate($request->input('status_id'));
        $task->assignee()->associate($request->input('assigned_to_id'));

        $task->saveOrFail();
        $task->labels()->sync($request->input('labels'));

        flash(__('tasks.flash.updated'))->success();

        return redirect()
            ->route('tasks.show', $task);
    }

    public function destroy(Task $task)
    {
        $task->labels()->detach();

        $task->delete();

        flash(__('tasks.flash.deleted'))->success();

        return redirect()
            ->route('tasks.index');
    }
}
