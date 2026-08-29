@extends('layouts.app')

@section('content')
<div>
    <h1>ID</h1>
    <p class="text-3xl font-bold">{{ $task_status->id }}</p>
</div>
<div>
    <h1>{{ __('tasks.status.name') }}</h1>
    <p class="text-3xl font-bold">{{ $task_status->name }}</p>
</div>
<div>
    <h1>{{ __('tasks.status.create_date') }}</h1>
    <p class="text-3xl font-bold">{{ $task_status->created_at }}</p>
</div>
@endsection