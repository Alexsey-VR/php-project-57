<?php

namespace App\Services;

use App\Models\{User, Task, TaskStatus, Label};
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class TaskService
{
    /**
     * @param array<string,mixed> $validatedData
     */
    public function createTask(array $validatedData): Task
    {
        $validatedData['created_by_id'] = Auth::id();
        $task = Task::create($validatedData);
        if (isset($validatedData['labels'])) {
            $task->labels()->attach($validatedData['labels']);
        }

        return $task;
    }

    /**
     * @param array<string,mixed> $validatedData
     * @return array<string,string>
     */
    public function getTaskFilterPlaceholders(array $validatedData): array
    {
        $filter = $validatedData['filter'] ?? [];

        return [
            'status' => __('tasks.status.header.name'),
            'creator' => __('tasks.creator'),
            'assignee' => __('tasks.assignee'),
            'query_status' => $filter['status_id'] ?? null,
            'query_creator' => $filter['created_by_id'] ?? null,
            'query_assignee' => $filter['assigned_to_id'] ?? null
        ];
    }

    /**
     * @return array<string,mixed>
     */
    public function getFilterOptions(): array
    {
        $locale = app()->getLocale();
        $filterOptions['filter_status'] = TaskStatus::getAllowedTaskStatusOptions($locale)->toArray();
        $filterOptions['filter_creator'] = User::getAllowedAuthorOptions()->toArray();
        $filterOptions['filter_assignee'] = User::getAllowedAssigneeOptions()->toArray();

        return $filterOptions;
    }

    /**
     * @return array<string,mixed>
     */
    public function getCreateOptions(): array
    {
        $locale = app()->getLocale();
        $createOptions['status'] = TaskStatus::pluck('name', 'id');
        $createOptions['assignee'] = User::getAllowedAssigneeOptions()->toArray();
        $createOptions['label'] = Label::pluck('name', 'id');

        return $createOptions;
    }

    /**
     * @param array<string,mixed> $validatedData
     * @return Collection<int,Task>
     */
    public function getFilteredTasks(array $validatedData): Collection
    {
        $filter = $validatedData['filter'] ?? [];
        $taskQuery = Task::query();
        if (array_key_exists('status_id', $filter)) {
            $taskQuery->where('status_id', $filter['status_id']);
        }
        if (array_key_exists('created_by_id', $filter)) {
            $taskQuery->where('created_by_id', $filter['created_by_id']);
        }
        if (array_key_exists('assigned_to_id', $filter)) {
            $taskQuery->where('assigned_to_id', $filter['assigned_to_id']);
        }

        return $taskQuery->get();
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
