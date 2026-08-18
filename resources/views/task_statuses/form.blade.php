<div class="w-full">
    {{ html()->label('Имя', 'name')
        ->class('block px-2 py-4') }}
    {{ html()->input('text', 'name')
        ->class('w-full bg-white p-2 rounded-md outline-solid outline-indigo-100') }}
</div>