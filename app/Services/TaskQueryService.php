<?php

namespace App\Services;

use App\Models\{User, Task, TaskStatus, Label};
use Illuminate\Database\Eloquent\Collection;

class TaskQueryService
{
    /**
     * @param array<string,mixed> $validatedData
     * @return array<string,string|null>
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
        $filterOptions['filter_status'] = TaskStatus::getAllowedTaskStatusOptions()->toArray();
        $filterOptions['filter_creator'] = User::pluck('name', 'id');
        $filterOptions['filter_assignee'] = User::pluck('name', 'id');

        return $filterOptions;
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
     * @return array<string,mixed>
     */
    public function getCreateOptions(): array
    {
        $createOptions['status'] = TaskStatus::pluck('name', 'id');
        $createOptions['assignee'] = User::pluck('name', 'id');
        $createOptions['label'] = Label::pluck('name', 'id');

        return $createOptions;
    }
}
