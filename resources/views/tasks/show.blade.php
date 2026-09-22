@extends('layouts.task')

@section('label')
    <div class="p-4 text-2xl font-bold text">
        <h1>{{ __('tasks.name') }}:{{ $task->name }}</h1>
    </div>
@endsection

@section('content')
    {{ html()->label(__('tasks.name'), 'name')->class('text-bold') }}
<div class="bg-white p-2">
    {{ $task->name }}
</div>
{{ html()->label(__('tasks.description'), 'description') }}
<div class="bg-white p-2">
    {{ $task->description }}
</div>
{{ html()->label(__('tasks.init_status'), 'init_status') }}
<div class="bg-white p-2">
    {{ $task->status->name }}
</div>
{{ html()->label(__('tasks.creator'), 'creator') }}
<div class="bg-white p-2">
    {{ $task->creator->name }}
</div>
{{ html()->label(__('tasks.assignee'), 'assignee') }}
<div class="bg-white p-2">
    {{ $task->assignee->name }}
</div>
{{ html()->label(__('tasks.labels'), 'label_id') }}
<div class="bg-white p-2">
    {{ $task->label_id }}
</div>
@endsection
