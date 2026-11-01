<?php

namespace App\Services;

use App\Models\{User, Task, TaskStatus, Label};
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use App\Services\OrphanCleanupService;

class TaskStatusService
{
    public function __construct(
        protected OrphanCleanupService $cleanupService
    ) {
        //
    }

    public function getTaskStatusInstance(): TaskStatus
    {
        return new TaskStatus();
    }

    /**
     * @return LengthAwarePaginator<int, TaskStatus>
     */
    public function getTaskStatuses(): LengthAwarePaginator
    {
        return TaskStatus::orderBy('id')
            ->paginate(config('pagination.per_page'))
            ->withQueryString();
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

    public function destroyTaskStatus(TaskStatus $taskStatus): void
    {
        $this->cleanupService->cleanupFor($taskStatus);
    }
}
