<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\{TaskService, TaskQueryService};
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\{TaskFilterRequest, TaskFormRequest};
use Illuminate\View\View;

class TaskController extends Controller
{
    public function __construct(
        protected TaskService $taskService,
        protected TaskQueryService $taskQueryService
    ) {
       //
    }

    /**
     * Display a listing of the resource.
     */
    public function index(TaskFilterRequest $request): View
    {
        $validatedData = $request->validated();
        $placeholders = $this->taskQueryService->getTaskFilterPlaceholders($validatedData);
        $options = $this->taskQueryService->getFilterOptions();
        $tasks = $this->taskQueryService->getFilteredTasks($validatedData);

        return view('tasks.index', compact([
            'tasks',
            'options',
            'placeholders'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $task = $this->taskService->getTaskInstance();
        $options = $this->taskQueryService->getCreateOptions();

        return view('tasks.create', compact([
            'task',
            'options'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskFormRequest $request): RedirectResponse
    {
        $this->taskService->createTask($request->validated());
        flash(__('flash.task.created'))->success();

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task): View
    {
        $this->taskService->loadRelatedInfo($task);

        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task): View
    {
        $options = $this->taskQueryService->getCreateOptions();

        return view('tasks.edit', compact([
            'task',
            'options'
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskFormRequest $request, Task $task): RedirectResponse
    {
        $this->taskService->updateTask(
            $request->validated(),
            $task
        );
        flash(__('flash.task.updated'))->success();

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): RedirectResponse
    {
        if (Gate::allows('delete', $task)) {
            $this->taskService->destroyTask($task);
            flash(__('flash.task.deleted'))->success();
        } else {
            flash(__('flash.task.restricted_delete'))->error();
        }

        return redirect()->route('tasks.index');
    }
}
