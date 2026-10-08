<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use App\Http\Requests\TaskStatusFormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use SweetAlert2\Laravel\Swal;

class TaskStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $task_statuses = TaskStatus::all();

        return view('task_statuses.index', compact('task_statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $task_status = new TaskStatus();
        $locale = app()->getLocale();
        $task_status_options = TaskStatus::getAllowedTaskStatusOptions($locale)->toArray();

        return view('task_statuses.create', compact('task_status', 'task_status_options'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStatusFormRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if (TaskStatus::where('name', $data['name'])->count() > 0) {
            flash(__('flash.status.dublicated'))->error();
        } else {
            TaskStatus::create($data);
            flash(__('flash.status.created'))->success();
        }

        return redirect()->route('task_statuses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskStatus $task_status): View
    {
        return view('task_statuses.show', compact('task_status'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskStatus $task_status): View
    {
        $locale = app()->getLocale();
        $task_status_options = TaskStatus::getAllowedTaskStatusOptions($locale)->toArray();
        return view('task_statuses.edit', compact('task_status', 'task_status_options'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskStatusFormRequest $request, TaskStatus $task_status): RedirectResponse
    {
        $data = $request->validated();
        $task_status->update($data);
        flash(__('flash.status.updated'))->success();

        return redirect()->route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskStatus $task_status): RedirectResponse
    {
        if ($task_status->tasks->count() === 0) {
            $task_status->delete();
            flash(__('flash.status.deleted'))->success();
        } else {
            flash(__('flash.status.restricted_delete'))->error();
        }

        return redirect()->route('task_statuses.index');
    }
}
