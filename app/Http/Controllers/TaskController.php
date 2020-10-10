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
            ->latest()
            ->paginate(15);

        $filter = $request->get('filter');

        $taskStatuses = TaskStatus::all()->mapWithKeys(function ($value) {
            return [$value->id => $value->name];
        });

        $creators = User::all()->mapWithKeys(function ($value) {
            return [$value->id => $value->name];
        });

        $assignees = User::all()->mapWithKeys(function ($value) {
            return [$value->id => $value->name];
        });

        return view('tasks.index', compact('tasks', 'taskStatuses', 'creators', 'assignees', 'filter'));
    }

    public function create()
    {
        $task = new Task();

        $taskStatuses = TaskStatus::all()->mapWithKeys(function ($value) {
            return [$value->id => $value->name];
        });
        $users = User::all()->mapWithKeys(function ($value) {
            return [$value->id => $value->name];
        });
        $labels = Label::all()->mapWithKeys(function ($value) {
            return [$value->id => $value->name];
        });

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
        $task->name = $request->input('name');
        $task->description = $request->input('description');

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
        $taskStatuses = TaskStatus::all()->mapWithKeys(function ($value) {
            return [$value->id => $value->name];
        });
        $users = User::all()->mapWithKeys(function ($value) {
            return [$value->id => $value->name];
        });
        $labels = Label::all()->mapWithKeys(function ($value) {
            return [$value->id => $value->name];
        });

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
                'status_id' => 'required|exists:task_statuses,id',
                'assigned_to_id' => 'nullable|exists:users,id',
                'labels.*' => 'required|exists:labels,id',
            ]
        );

        $task->name = $request->input('name');
        $task->description = $request->input('description');

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
        $task->delete();
        flash(__('tasks.flash.deleted'))->success();

        return redirect()
            ->route('tasks.index');
    }
}
