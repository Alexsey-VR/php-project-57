@extends('layouts.app')

@section('label')
    <div class="p-4 text-2xl font-bold text">
        <h1>{{ __('tasks.status.header.edit') }}</h1>
    </div>
@endsection

@section('content')
<div>
    {{ html()->modelForm($task_status, 'PATCH', route('task_statuses.update', $task_status))->open() }}
        @csrf
        @include('task_statuses.form')
        <div class="p-2">
            {{ html()->submit(__('tasks.status.update'))
                ->class('rounded-md text-sm text-center font-semibold text-white h-10 w-32 px-4 bg-indigo-600') }}
        </div>
    {{ html()->closeModelForm() }}
</div>
@endsection
