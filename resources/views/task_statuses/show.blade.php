@extends('layouts.task')

@section('content')
    {{ html()->label(__('tasks.status.name'), 'name') }}
    <div class="bg-white p-2 rounded-md outline-solid outline-indigo-100">
        {{ __("tasks.status.options.{$task_status->name}") }}
    </div>
@endsection