@extends('layouts.app')

@section('content')
<div>
    <h1 class="text-2xl font-bold px-4 py-4 text">{{ __('tasks.statuses') }}</h1>
    <div class="p-2">
        @can('create', App\Models\TaskStatus::class)
            <button class="rounded-md text-sm text-center font-semibold text-white h-10 w-auto px-4 bg-indigo-600 cursor-pointer">
                <a href="{{ route('task_statuses.create') }}">
                    {{ __('tasks.status.header.create') }}
                </a>
            </button>
        @endcan
    </div>
    <table class="table-fixed">
        <thead class="border-b bg-gray-100 text-left">
            <tr>
                <th style="padding-left: var(--col-px-id); width: var(--col-w-id)" class="py-2">ID</th>
                <th style="padding-left: var(--col-px-status); width: var(--col-w-status); min-width: var(--col-min-w-status)" class="py-2">{{ __('tasks.status.name') }}</th>
                <th style="padding-left: var(--col-px-date); width: var(--col-w-date); min-width: var(--col-min-w-date)" class="py-2">{{ __('tasks.status.header.date') }}</th>
                <th style="padding-left: var(--col-px-actions); width: var(--col-w-actions); min-width: var(--col-min-w-actions)" class="py-2">{{ __('tasks.status.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($task_statuses as $task_status)
                <tr>
                    <td style="padding-left: var(--col-px-id); width: var(--col-w-id)" class="py-2">{{ $task_status->id }}</td>
                    <td style="padding-left: var(--col-px-status); width: var(--col-w-status); min-width: var(--col-min-w-status)" class="py-2">
                        <a href="{{ route('task_statuses.show', $task_status) }}">{{ $task_status->name }} </a>
                    </td>
                    <td style="padding-left: var(--col-px-date); width: var(--col-w-date); min-width: var(--col-min-w-date)" class="py-2">{{ $task_status->created_at }}</td>
                    <td style="padding-left: var(--col-px-actions); width: var(--col-w-actions); min-width: var(--col-min-w-actions)" class="py-2">
                        <div class="flex space-x-4">
                            {{ html()->modelForm($task_status, 'DELETE', route('task_statuses.destroy', $task_status))
                                    ->attribute('id', "form-status-{$task_status->id}")
                                    ->open() }}
                                @csrf
                                <a href="{{ route('task_statuses.destroy', $task_status) }}"
                                        data-confirm="{{ __('tasks.sweetalert.question') }} {{ __('tasks.sweetalert.text', ['name' => $task_status->name]) }}"
                                        onclick="event.preventDefault(); if (confirm(this.dataset.confirm)) { this.closest('form').submit(); }"
                                        class="text-red-500 hover:text-red-700"
                                        rel="nofollow"
                                >
                                    {{ __('tasks.status.delete') }}
                                </a>
                            {{ html()->closeModelForm() }}
                            @can('update', $task_status)
                                <a href="{{ route('task_statuses.edit', $task_status) }}"
                                    class="text-blue-500 hover:text-blue-700">{{ __('tasks.status.edit') }}
                                </a>
                            @endcan
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('pagination')
    <div>{{ $task_statuses->links() }}</div>
@endsection
