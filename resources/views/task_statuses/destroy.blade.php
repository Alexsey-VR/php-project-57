@extends('layouts.app')

<div class="w-full max-w-md bg-indigo-50 rounded-2xl shadow-lg p-8 space-y-6">
    {{ html()->modelForm($task_status, 'DELETE', route('task_statuses.destroy', $task_status))->open() }}
        @csrf
        {{ html()->submit('Удалить') }}
    {{ html()->closeModelForm() }}
</div>
