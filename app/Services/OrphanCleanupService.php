<?php

namespace App\Services;

use App\Models\{Task, TaskStatus, Label};

class OrphanCleanupService
{
    public function cleanupFor(Task|TaskStatus|Label $model): void
    {
        $model->cleanUp();
    }
}
