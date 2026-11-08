@extends('layouts.app')

@section('label')
    <div class="p-4 text-2xl font-bold">
        <h1>{{ __('tasks.tasks') }}</h1>
    </div>
@endsection

@section('content')
    <div class="bg-white p-2 rounded-md outline-solid outline-indigo-100 flex items-center">
        {{ html()->form('GET', route('tasks.index'))
            ->class("flex items-center")
            ->open() }}
            {{ html()->select('filter[status_id]', $options['filter_status'], $placeholders['query_status'])
                    ->prependChild(
                        html()->option($placeholders['status'])
                            ->disabled()
                            ->attribute('hidden', 'hidden')
                            ->selectedIf($placeholders['query_status'] === null)
                    )
                    ->style("margin-left: var(--col-ml-status); width: var(--col-w-status)")
                    ->class('h-10 p-2 rounded-md outline-solid outline-indigo-100 has-placeholder cursor-pointer') }}
            {{ html()->select('filter[created_by_id]', $options['filter_creator'], $placeholders['query_creator'])
                    ->prependChild(
                        html()->option($placeholders['creator'])
                            ->disabled()
                            ->attribute('hidden', 'hidden')
                            ->selectedIf($placeholders['query_creator'] === null)
                    )
                    ->style("padding-left: var(--col-px-status); margin-left: var(--col-ml-creator); width: var(--col-fw-creator)")
                    ->class('h-10 p-2 rounded-md outline-solid outline-indigo-100 cursor-pointer') }}
            {{ html()->select('filter[assigned_to_id]', $options['filter_assignee'], $placeholders['query_assignee'])
                    ->prependChild(
                        html()->option($placeholders['assignee'])
                            ->disabled()
                            ->attribute('hidden', 'hidden')
                            ->selectedIf($placeholders['query_assignee'] === null)
                    )
                    ->style("padding-left: var(--col-px-creator); margin-left: var(--col-ml-assignee); width: var(--col-w-assignee)")
                    ->class('h-10 p-2 rounded-md outline-solid outline-indigo-100 cursor-pointer') }}
            {{ html()->submit(__('tasks.apply'))
                    ->class("rounded-md ml-4 text-sm text-center font-semibold text-white h-10 w-32 px-4 bg-indigo-600 justify-center cursor-pointer") }}
        {{ html()->form()->close() }}
        @can('create', App\Models\Task::class)
            <a href="{{ route('tasks.create') }}" 
                class="rounded-md text-sm text-center font-semibold text-white ml-4 h-10 w-32 px-4 bg-indigo-600 flex items-center justify-center">
                    {{ __('tasks.create') }}
            </a>
        @endcan
    </div>
    <table class="table-fixed">
        <thead class="border-b bg-gray-100 text-left">
            <tr>
                <th style="padding-left: var(--col-px-id); width: var(--col-w-id)" class="py-2">ID</th>
                <th style="padding-left: var(--col-px-status); width: var(--col-w-status)" class="py-2">{{ __('tasks.init_status') }}</th>
                <th style="padding-left: var(--col-px-name); width: var(--col-w-name); min-width: var(--col-min-w-name)" class="py-2">{{ __('tasks.name') }}</th>
                <th style="padding-left: var(--col-px-creator); width: var(--col-w-creator); min-width: var(--col-min-w-creator)" class="py-2">{{ __('tasks.creator') }}</th>
                <th style="padding-left: var(--col-px-assignee); width: var(--col-w-assignee); min-width: var(--col-min-w-assignee)" class="py-2">{{ __('tasks.assignee') }}</th>
                <th style="padding-left: var(--col-px-date); width: var(--col-w-date); min-width: var(--col-min-w-date)" class="py-2">{{ __('tasks.created_at') }}</th>
                <th style="padding-left: var(--col-px-actions); width: var(--col-w-actions); min-width: var(--col-min-w-actions)" class="py-2">{{ __('tasks.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td style="padding-left: var(--col-px-id); width: var(--col-w-id)" class="py-2">{{ $task->id }}</td>
                    <td style="padding-left: var(--col-px-status); width: var(--col-w-status)" class="py-2">{{ $task->status->name }}</td>
                    <td style="padding-left: var(--col-px-name); width: var(--col-w-name)" class="py-2">
                        <a href="{{ route('tasks.show', $task) }}">{{ $task->name }}</a>
                    </td>
                    <td style="padding-left: var(--col-px-creator); width: var(--col-w-creator)" class="py-2">{{ $task->createdBy->name }}</td>
                    <td style="padding-left: var(--col-px-assignee); width: var(--col-w-assignee)" class="py-2">{{ $task->assignedTo->name }}</td>
                    <td style="padding-left: var(--col-px-date); width: var(--col-w-date)" class="py-2">{{ $task->created_at }}</td>
                    <td style="padding-left: var(--col-px-actions); width: var(--col-w-actions)" class="py-2">
                        <div class="flex space-x-4">
                            @can('delete', $task)
                                {{ html()->modelForm($task, 'DELETE', route('tasks.destroy', $task))
                                        ->open() }}
                                    @csrf
                                    <a href="{{ route('tasks.destroy', $task) }}"
                                            data-confirm="{{ __('tasks.sweetalert.question') }} {{ __('tasks.sweetalert.text', ['name' => $task->name]) }}"
                                            onclick="event.preventDefault(); if (confirm(this.dataset.confirm)) { this.closest('form').submit(); }"
                                            class="text-red-500 hover:text-red-700"
                                            rel="nofollow"
                                    >
                                        {{ __('tasks.delete') }}
                                    </a>
                                {{ html()->closeModelForm() }}
                            @endcan
                            @can('update', $task)
                                <a href="{{ route('tasks.edit', $task) }}"
                                    class="text-blue-500 hover:text-blue-700">{{ __('tasks.edit') }}
                                </a>
                            @endcan
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('pagination')
    <div>{{ $tasks->links() }}</div>
@endsection
