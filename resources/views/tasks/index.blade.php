@extends('layouts.app')

@section('label')
    <div class="p-4 text-2xl font-bold">
        <h1>{{ __('tasks.tasks') }}</h1>
    </div>
@endsection

@section('content')
    <div class="bg-white p-2 rounded-md outline-solid outline-indigo-100 flex items-center space-x-4">
        {{ html()->form('GET', route('tasks.index'))
            ->class("flex items-center space-x-4")
            ->open() }}
            {{ html()->select('status', $taskStatusOptions, $queryTaskStatus)
                    ->prependChild(
                        html()->option($taskStatusPlaceholder)
                            ->disabled()
                            ->attribute('hidden', 'hidden')
                            ->selectedIf($queryTaskStatus === null)
                    )
                    ->class('w-32 h-10 p-2 rounded-md outline-solid outline-indigo-100 has-placeholder') }}
            {{ html()->select('created_by_id', $authorList, $queryCreatorId)
                    ->prependChild(
                        html()->option($creatorPlaceholder)
                            ->disabled()
                            ->attribute('hidden', 'hidden')
                            ->selectedIf($queryCreatorId === null)
                    )
                    ->class('w-48 h-10 p-2 rounded-md outline-solid outline-indigo-100') }}
            {{ html()->select('assigned_to_id', $assigneeList, $queryAssigneeId)
                    ->prependChild(
                        html()->option($assigneePlaceholder)
                            ->disabled()
                            ->attribute('hidden', 'hidden')
                            ->selectedIf($queryAssigneeId === null)
                    )
                    ->class('w-48 h-10 p-2 rounded-md outline-solid outline-indigo-100') }}
            {{ html()->submit(__('tasks.apply'))
                    ->class("rounded-md text-sm text-center font-semibold text-white h-10 w-32 px-4 bg-indigo-600 justify-center") }}
        {{ html()->form()->close() }}
        <a href="{{ route('tasks.create') }}" 
            class="rounded-md text-sm text-center font-semibold text-white h-10 w-32 px-4 bg-indigo-600 flex items-center justify-center">
                {{ __('tasks.create') }}
        </a>
    </div>
    <table class="table-auto">
        <thead class="border-b bg-gray-100 text-left">
            <tr>
                <th class="py-2 px-4">ID</th>
                <th class="py-2 px-4">{{ __('tasks.init_status') }}</th>
                <th class="py-2 px-4">{{ __('tasks.creator') }}</th>
                <th class="py-2 px-4">{{ __('tasks.assignee') }}</th>
                <th class="py-2 px-4">{{ __('tasks.created_at') }}</th>
                <th class="py-2 px-4">{{ __('tasks.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td class="py-2 px-4">{{ $task->id }}</td>
                    <td class="py-2 px-4">{{ __("tasks.status.options.{$task->status->name}") }}</td>
                    <td class="py-2 px-4">
                        <a href="{{ route('tasks.show', $task) }}">{{ $task->creator->name }}</a>
                    </td>
                    <td class="py-2 px-4">{{ $task->assignee->name }}</td>
                    <td class="py-2 px-4">{{ $task->created_at }}</td>
                    <td class="py-2 px-4">
                        <div class="flex space-x-4">
                            {{ html()->modelForm($task, 'DELETE', route('tasks.destroy', $task))
                                    ->attribute('id', "form-task-{$task->id}")
                                    ->open() }}
                                @csrf
                                <button type='submit'
                                        onclick="confirmDelete(event, '{{ $task->name }}', 'form-task-{{ $task->id }}');"
                                        class="text-red-500 hover:text-red-700"
                                >
                                    {{ __('tasks.delete') }}
                                </button>
                            {{ html()->closeModelForm() }}
                            <a href="{{ route('tasks.edit', $task) }}"
                                class="text-blue-500 hover:text-blue-700">{{ __('tasks.edit') }}
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
