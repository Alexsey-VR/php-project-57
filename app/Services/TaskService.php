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
        if (
            !(($taskStatus = TaskStatus::where('name', $validatedData['status'])->first())
            instanceof TaskStatus)
        ) {
            $taskStatus = new TaskStatus();
            $taskStatus->fill(['name' => $validatedData['status']]);
            $taskStatus->save();
        }

        $validatedData['status_id'] = $taskStatus->id;
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

        return [
            'status' => __('tasks.status.header.name'),
            'creator' => __('tasks.creator'),
            'assignee' => __('tasks.assignee'),
            'query_status' => $validatedData['status'] ?? null,
            'query_creator' => $validatedData['created_by_id'] ?? null,
            'query_assignee' => $validatedData['assigned_to_id'] ?? null
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
        $createOptions['status'] = TaskStatus::getAllowedTaskStatusOptions($locale)->toArray();
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
        $taskQuery = Task::query();
        if (array_key_exists('status', $validatedData)) {
            $taskQuery->whereHas('status', fn($query) => $query->where('name', $validatedData['status']));
        }
        if (array_key_exists('created_by_id', $validatedData)) {
            $taskQuery->where('created_by_id', $validatedData['created_by_id']);
        }
        if (array_key_exists('assigned_to_id', $validatedData)) {
            $taskQuery->where('assigned_to_id', $validatedData['assigned_to_id']);
        }

        return $taskQuery->get();
    }

    /**
     * @param array<string,mixed> $validatedData
     */
    public function updateTask(array $validatedData, Task $task): void
    {
        $taskStatus = $task->status;
        if ($taskStatus instanceof TaskStatus) {
            $taskStatus->fill(['name' => $validatedData['status']]);
            $taskStatus->save();
            $validatedData['status_id'] = $taskStatus->id;
        }

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
