<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }

    public function status()
    {
        return $this->belongsTo(TaskStatus::class, 'status_id');
    }

    public function isCreatedBy(User $user): bool
    {
        return $this->creator->id === $user->id;
    }
}
