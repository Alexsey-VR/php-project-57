@extends('layouts.app')

<div class="w-full max-w-md bg-indigo-50 rounded-2xl shadow-lg p-8 space-y-6">
    {{ html()->modelForm($task_status, 'DELETE', route('task_statuses.destroy', $task_status))->open() }}
        @csrf
        {{ html()->submit('Удалить')
            ->attribute('onclick', 'return Swal.fire({
                title: "Вы уверены?",
                text: "Это действие нельзя отменить!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: "#3085d6"
                cancelButtonColor: "#d33"
                confirmButtonText: "Да, удалить",
            }).then((result) => {
                if (result.isConfirmed) {
                    return true;
                }
                return false;
            })') }}
    {{ html()->closeModelForm() }}
</div>
