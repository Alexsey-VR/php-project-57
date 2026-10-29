<?php

namespace App\Policies;

use App\Models\TaskStatus;
use App\Models\User;

class TaskStatusPolicy
{
    /**
     * Deterrmine whether the user can create the task status
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Deterrmine whether the user can show the task status
     */
    public function show(User $user, TaskStatus $taskStatus): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the task status
     */
    public function update(User $user, TaskStatus $status): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the task status.
     */
    public function delete(User $user, TaskStatus $status): bool
    {
        return !$status->hasTasks();
    }
}
