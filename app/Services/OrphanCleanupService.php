<?php

namespace App\Services;

use App\Models\{Task, TaskStatus, Label};

class OrphanCleanupService
{
    public function cleanupFor(Task $task): void
    {
        $labelIds = $task->labels()->pluck('label_id');
        $task->labels()->detach();
        $task->delete();
        Label::whereDoesntHave('tasks')->whereIn('id', $labelIds)->delete();
        TaskStatus::whereDoesntHave('tasks')->delete();
    }
}
