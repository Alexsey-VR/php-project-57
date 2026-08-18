@extends('layouts.app')

@section('content')
<div class="flex rounded-md text-base text-center">
    @include('flash::message')
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(event, name) {
    event.preventDefault();
    const form = event.target.closest('form');
    Swal.fire({
        title: "Вы уверены?",
        text: `Это действие нельзя отменить! Удалить статус \"${name}\"?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Да, удалить",
        cancelButtonText: "Отмена"
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
</script>
@endpush

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
                        {{ html()->modelForm($task_status, 'DELETE', route('task_statuses.destroy', $task_status))->open() }}
                            @csrf
                            <button type='submit'
                                    onclick="confirmDelete(event, '{{ $task_status->name }}');"
                                    class="text-red-500 hover:text-red-70"
                            >
                                Удалить
                            </button>                        
                        <a href="{{ route('task_statuses.edit', $task_status) }}"
                            class="text-blue-500 hover:text-blue-70"
                        >
                            Изменить
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
