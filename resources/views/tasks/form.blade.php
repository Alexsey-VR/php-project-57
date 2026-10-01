{{ html()->label(__('tasks.name'), 'name') }}
<div class="w-full bg-white p-2 rounded-md outline-solid outline-indigo-100">
    {{ html()->input('name', 'name')->class('w-full') }}
</div>
{{ html()->label(__('tasks.description'), 'description') }}
<div class="w-full bg-white p-2 rounded-md outline-solid outline-indigo-100">
    {{ html()->textarea('description')->class('w-full h-32') }}
</div>
{{ html()->label(__('tasks.init_status'), 'status') }}
<div class="w-full bg-white p-2 rounded-md outline-solid outline-indigo-100">
    {{ html()->select('status', $taskStatusOptions)
        ->class('w-full') }}
</div>
{{ html()->label(__('tasks.assignee'), 'assigned_to_id') }}
<div class="w-full bg-white p-2 rounded-md outline-solid outline-indigo-100">
    {{ html()->select('assigned_to_id', $assigneeList)
        ->class('w-full') }}
</div>
{{ html()->label(__('tasks.labels'), 'labels[]') }}
<div class="w-full bg-white p-2 rounded-md outline-solid outline-indigo-100">
    {{ html()->select('labels[]', $labelOptions)
        ->multiple()
        ->class('w-full h-32') }}
</div>
