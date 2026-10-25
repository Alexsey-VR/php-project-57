<?php

namespace App\Services;

use App\Models\{Task, TaskStatus, Label};

class OrphanCleanupService
{
    public function cleanupFor(Task $task): void
    {
        $labelIds = $task->labels()
            ->get(['task_labels', 'label_id'])
            ->pluck('label_id');

        $task->labels()->detach();
        $task->delete();

        Label::whereIn('id', $labelIds)
            ->doesntHave('tasks')
            ->delete();

        if (
            $task->status instanceof TaskStatus
            && !$task->status->hasTasks()
        ) {
            $task->status->delete();
        }
    }
}
