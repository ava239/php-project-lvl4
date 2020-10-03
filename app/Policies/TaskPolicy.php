<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return Auth::check();
    }

    public function update(User $user, Task $task)
    {
        return Auth::check();
    }

    public function delete(User $user, Task $task)
    {
        return Auth::check();
    }
}
