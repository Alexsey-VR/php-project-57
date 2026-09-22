<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $validatedData = $request->validate([
            'status' => ['nullable', 'string', 'max:255'],
            'created_by_id' => ['nullable', 'integer', 'exists:users,id'],
            'assigned_to_id' => ['nullable', 'integer', 'exists:users,id']
        ]);
        $queryTaskStatus = $validatedData['status'] ?? null;
        $queryCreatorId = $validatedData['created_by_id'] ?? null;
        $queryAssigneeId = $validatedData['assigned_to_id'] ?? null;

        $taskStatusPlaceholder = __('tasks.status.header.name');
        $creatorPlaceholder = __('tasks.creator');
        $assigneePlaceholder = __('tasks.assignee');

        $taskQuery = Task::query();
        if ($queryTaskStatus !== null) {
            $taskQuery->whereHas('status', fn($query) => $query->where('name', $queryTaskStatus));
        }
        if ($queryCreatorId !== null) {
            $taskQuery->where('created_by_id', $queryCreatorId);
        }
        if ($queryAssigneeId !== null) {
            $taskQuery->where('assigned_to_id', $queryAssigneeId);
        }
        $tasks = $taskQuery->get();

        $locale = app()->getLocale();
        $taskStatusOptions = TaskStatus::getAllowedTaskStatusOptions($locale)->toArray();
        $authorList = User::getAllowedAuthorOptions()->toArray();
        $assigneeList = User::getAllowedAssigneeOptions()->toArray();

        return view('tasks.index', compact([
            'tasks',
            'taskStatusOptions',
            'authorList',
            'assigneeList',
            'taskStatusPlaceholder',
            'creatorPlaceholder',
            'assigneePlaceholder',
            'queryTaskStatus',
            'queryCreatorId',
            'queryAssigneeId'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $task = new Task();
        $locale = app()->getLocale();
        $taskStatusOptions = TaskStatus::getAllowedTaskStatusOptions($locale)->toArray();
        $assigneeList = User::getAllowedAssigneeOptions()->toArray();

        return view('tasks.create', compact([
            'task',
            'taskStatusOptions',
            'assigneeList'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable','string', 'max:512'],
            'status' => ['required', 'string', 'max:255'],
            'assigned_to_id' => ['required', 'integer', 'exists:users,id'],
            'label_id' => ['required', 'integer']
        ]);

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
        Task::create($validatedData);
        flash(__('flash.task.created'))->success();

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task): View
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task): View
    {
        $locale = app()->getLocale();
        $taskStatusOptions = TaskStatus::getAllowedTaskStatusOptions($locale)->toArray();
        $assigneeList = User::getAllowedAssigneeOptions()->toArray();
        return view('tasks.edit', compact([
            'task',
            'taskStatusOptions',
            'assigneeList'
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required','string', 'max:512'],
            'status' => ['required', 'string', 'max:255'],
            'assigned_to_id' => ['required', 'integer', 'exists:users,id'],
            'label_id' => ['required', 'integer']
        ]);

        $taskStatus = $task->status;
        if ($taskStatus instanceof TaskStatus) {
            $taskStatus->fill(['name' => $validatedData['status']]);
            $taskStatus->save();

            $validatedData['status_id'] = $taskStatus->id;
        }

        $task->update($validatedData);
        flash(__('flash.task.updated'))->success();

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();
        if (Task::where('status_id', $task->status_id)->count() === 0) {
            $task->status()->delete();
        };
        flash(__('flash.task.deleted'))->success();

        return redirect()->route('tasks.index');
    }
}
