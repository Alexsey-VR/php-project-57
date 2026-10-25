<?php

namespace App\Services;

use App\Models\{Task, TaskStatus, Label};

class OrphanCleanupService
{
    public function cleanupFor(Task|TaskStatus|Label $task): void
    {
        $task->cleanUp();
    }
}
