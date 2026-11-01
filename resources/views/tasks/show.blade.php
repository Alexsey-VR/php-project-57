@extends('layouts.task')

@section('label')
    <div class="p-4 text-2xl font-bold text">
        <h1>{{ __('tasks.name') }}:{{ $task->name }}</h1>
    </div>
@endsection

@section('content')
    @can('view', $task)
        {{ html()->label(__('tasks.name'), 'name')->class('text-bold') }}
        <div class="bg-white p-2 rounded-md outline-solid outline-indigo-100">
            {{ $task->name }}
        </div>
        {{ html()->label(__('tasks.description'), 'description') }}
        <div class="bg-white p-2 rounded-md overflow-y-auto outline-solid outline-indigo-100 h-32">
            {{ $task->description }}
        </div>
        {{ html()->label(__('tasks.init_status'), 'init_status') }}
        <div class="bg-white p-2 rounded-md outline-solid outline-indigo-100">
            {{ $task->status->name }}
        </div>
        {{ html()->label(__('tasks.creator'), 'created_by') }}
        <div class="bg-white p-2 rounded-md outline-solid outline-indigo-100">
            {{ $task->createdBy->name }}
        </div>
        {{ html()->label(__('tasks.assignee'), 'assigned_to') }}
        <div class="bg-white p-2 rounded-md outline-solid outline-indigo-100">
            {{ $task->assignedTo->name }}
        </div>
        {{ html()->label(__('tasks.labels'), 'labels') }}
        <div class="bg-white p-2 rounded-md overflow-y-auto outline-solid outline-indigo-100 h-32">
            @if ($task->labels && $task->labels->isNotEmpty())
                <ul>
                    @foreach($task->labels as $label)
                        <li>{{ $label->name }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    @endcan
@endsection
