<div class="w-full">
    {{ html()->label(__('tasks.status.name'), 'name') }}
    {{ html()->text('name', $name)
        ->class(
            'w-full bg-white p-2 rounded-md outline-solid ' .
            ($errors->has('name') ? 'outline-red-500' : 'outline-indigo-100')
        ) }}
</div>