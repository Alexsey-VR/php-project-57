<?php

namespace App\Services;

use App\Models\{Task, TaskStatus, Label};
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class TaskService
{
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
        $labelIds = $task->labels()->pluck('label_id')->toArray();
        $task->labels()->detach();
        $task->delete();
        if (
            Task::where('status_id', $task->status_id)->count() === 0
            && $task->status instanceof TaskStatus
        ) {
            $task->status->delete();
        }

        foreach ($labelIds as $labelId) {
            $label = Label::find($labelId);
            if (
                $label instanceof Label
                && $label->tasks()->count() === 0
            ) {
                $label->delete();
            }
        }
    }
}
