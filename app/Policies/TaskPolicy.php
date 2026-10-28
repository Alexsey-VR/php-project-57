<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Determine whether the user can create the task
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Deterrmine whether the user can show the task status
     */
    public function show(User $user, Task $task): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the task
     */
    public function update(User $user, Task $task): bool
    {
        return $user->id === $task->created_by_id;
    }

    /**
     * Determine whether the user can delete the task.
     */
    public function delete(User $user, Task $task): bool
    {
        return $user->id === $task->created_by_id;
    }
}
