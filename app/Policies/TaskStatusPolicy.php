<?php

namespace App\Policies;

use App\Models\TaskStatus;
use App\Models\User;
use Auth;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TaskStatusPolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        return Auth::check();
    }

    public function update(User $user): bool
    {
        return Auth::check();
    }

    public function delete(User $user): bool
    {
        return Auth::check();
    }
}
