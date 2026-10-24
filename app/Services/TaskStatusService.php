<?php

namespace App\Services;

use App\Models\{User, Task, TaskStatus, Label};
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class TaskStatusService
{
    public function getTaskStatusInstance(): TaskStatus
    {
        return new TaskStatus();
    }

    /**
     * @return Collection<int, TaskStatus>
     */
    public function getTaskStatuses(): Collection
    {
        return TaskStatus::all();
    }

    /**
     * @param array<string, mixed> $validatedData
     */
    public function createTaskStatus(array $validatedData): void
    {
        TaskStatus::create($validatedData);
    }

    public function getTaskStatusName(TaskStatus $taskStatus): string
    {
        return $taskStatus->name;
    }

    /**
     * @param array<string, mixed> $validatedData
     */
    public function updateTaskStatus(array $validatedData, TaskStatus $taskStatus): void
    {
        $taskStatus->update($validatedData);
    }

    public function destroyTaskStatus(TaskStatus $taskStatus): bool
    {
        if (!$taskStatus->hasTasks()) {
            $taskStatus->delete();

            return true;
        }

        return false;
    }
}
