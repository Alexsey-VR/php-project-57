<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
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
     * @param array<int, mixed> $labelNames
     * @return Collection<int, int>
     */
    private function prepareRelatedLabels(array $labelNames, Task $task): Collection
    {
        return collect($labelNames)->map(
            function ($labelName) use ($task) {
                return $task->labels()->createOrFirst(
                    ['name' => $labelName],
                    ['description' => null]
                );
            }
        )->pluck('id');
    }

    /**
     * @param array<string,mixed> $validatedData
     */
    public function createTask(array $validatedData): Task
    {
        $task = DB::transaction(
            function () use ($validatedData) {
                $task = new Task($validatedData);
                $task->createdBy()->associate(Auth::id());
                $task->save();

                if (isset($validatedData['labels'])) {
                    $this->prepareRelatedLabels($validatedData['labels'], $task);
                }

                return $task;
            }
        );

        return $task;
    }

    public function loadRelatedInfo(Task $task): void
    {
        $task->load(['status', 'labels']);
    }

    /**
     * @param array<string,mixed> $validatedData
     */
    public function updateTask(array $validatedData, Task $task): void
    {
        DB::transaction(
            function () use ($validatedData, $task) {
                if (isset($validatedData['labels'])) {
                    $labels = $this->prepareRelatedLabels($validatedData['labels'], $task);
                    $task->labels()->sync($labels);
                } else {
                    $task->labels()->detach();
                }

                $task->update($validatedData);
            }
        );
    }

    public function destroyTask(Task $task): bool
    {
        return $this->cleanupService->cleanupFor($task);
    }
}
