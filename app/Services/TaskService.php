<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use App\Services\OrphanCleanupService;

class TaskService
{
    public function __construct(
        protected OrphanCleanupService $cleanupService
    ) {
        //
    }

    public function getTaskInstance(): Task
    {
        return new Task();
    }

    /**
     * @param array<string,mixed> $validatedData
     */
    public function createTask(array $validatedData): Task
    {
        // TODO: move this check to TaskPolicy
        $validatedData['created_by_id'] = Auth::id();

        $task = Task::create($validatedData);
        if (isset($validatedData['labels'])) {
            $task->labels()->attach($validatedData['labels']);
        }

        return $task;
    }

    public function loadRelatedInfo(Task $task): void
    {
        $task->load('labels');
    }

    /**
     * @param array<string,mixed> $validatedData
     */
    public function updateTask(array $validatedData, Task $task): void
    {
        $task->update($validatedData);

        if (isset($validatedData['labels'])) {
            $task->labels()->sync($validatedData['labels']);
        } else {
            $task->labels()->detach();
        }
    }

    public function destroyTask(Task $task): void
    {
        $this->cleanupService->cleanupFor($task);
    }
}
