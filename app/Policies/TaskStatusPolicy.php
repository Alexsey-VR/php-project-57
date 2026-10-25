<?php

namespace App\Policies;

use App\Models\TaskStatus;
use App\Models\User;

class TaskStatusPolicy
{
    /**
     * Determine whether the user can delete the task status.
     */
    public function delete(User $user, TaskStatus $status): bool
    {
        return !$status->hasTasks();
    }
}
