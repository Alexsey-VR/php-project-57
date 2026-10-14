<div class="w-full">
    {{ html()->label(__('tasks.status.name'), 'name') }}
    {{ html()->text('name', $task_status_option)
        ->class('w-full bg-white p-2 rounded-md outline-solid outline-indigo-100') }}
</div>