{{ html()->label(__('tasks.label.name'), 'name') }}
<div class="w-full bg-white p-2 rounded-md outline-solid outline-indigo-100">
    {{ html()->input('name', 'name')->class('w-full') }}
</div>
{{ html()->label(__('tasks.label.description'), 'description') }}
<div class="w-full bg-white p-2 rounded-md outline-solid outline-indigo-100">
    {{ html()->textarea('description')->rows(3)->class('w-full') }}
</div>
