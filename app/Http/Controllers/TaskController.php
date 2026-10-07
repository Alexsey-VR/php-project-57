<?php

namespace App\Http\Controllers;

use App\Models\{Task, TaskStatus, Label, User};
use App\Services\TaskService;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\{TaskFilterRequest, TaskFormRequest};
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct(
        protected TaskService $taskService
    ) {
       //
    }

    /**
     * Display a listing of the resource.
     */
    public function index(TaskFilterRequest $request): View
    {
        $validatedData = $request->validated();
        $placeholders = $this->taskService->getTaskFilterPlaceholders($validatedData);
        $options = $this->taskService->getFilterOptions();
        $tasks = $this->taskService->getFilteredTasks($validatedData);

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
        $task = new Task();
        $options = $this->taskService->getCreateOptions();

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
        $task->load('labels');

        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task): View
    {
        $options = $this->taskService->getCreateOptions();

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
            $validatedData = $request->validated(),
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
        if (
            Auth::id() !== $task->created_by_id
        ) {
            flash(__('flash.task.restricted_delete'))->error();
        }

        $this->taskService->destroyTask($task);

        flash(__('flash.task.deleted'))->success();

        return redirect()->route('tasks.index');
    }
}
