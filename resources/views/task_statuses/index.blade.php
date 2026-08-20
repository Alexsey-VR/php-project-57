@extends('layouts.app')

@section('content')
<div class="flex rounded-md text-base text-center">
    @include('flash::message')
</div>

<div>
    <h1 class="text-2xl font-bold px-4 py-4 text">Статусы</h1>
    <div class="p-2">
        <button class="rounded-md text-sm text-center font-semibold text-white h-10 w-auto px-4 bg-indigo-600">
            <a href="{{ route('task_statuses.create') }}">
                Создать статус
            </a>
        </button>
    </div>
    <table class="table-auto">
        <thead class="border-b bg-gray-100 text-left">
            <tr>
                <th class="py-2 px-4">ID</th>
                <th class="py-2 px-4">Имя</th>
                <th class="py-2 px-4">Дата создания</th>
                <th class="py-2 px-4">Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($task_statuses as $task_status)
                <tr>
                    <td class="py-2 px-4">{{ $task_status->id }}</td>
                    <td class="py-2 px-4">
                        <a href="{{ route('task_statuses.show', $task_status) }}">{{ $task_status->name }}</a>
                    </td>
                    <td class="py-2 px-4">{{ $task_status->created_at }}</td>
                    <td class="py-2 px-4">
                        <div class="flex space-x-4">
                            {{ html()->modelForm($task_status, 'DELETE', route('task_statuses.destroy', $task_status))->open() }}
                                @csrf
                                <button type='submit'
                                        onclick="confirmDelete(event, '{{ $task_status->name }}', 'form-{{ $task_status->id }}');"
                                        class="text-red-500 hover:text-red-700"
                                >
                                    Удалить
                                </button>   
                            {{ html()->closeModelForm() }}                     
                            <a href="{{ route('task_statuses.edit', $task_status) }}"
                                class="text-blue-500 hover:text-blue-700">Изменить</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
