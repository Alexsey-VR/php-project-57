{{ html()->label('Email', 'email') }}
<div class="w-full bg-white p-2 rounded-md outline-solid outline-indigo-100">
    {{ html()->input('email', 'email')->class('w-full') }}
</div>
{{ html()->label('Пароль', 'password') }}
<div class="w-full bg-white p-2 rounded-md outline-solid outline-indigo-100">
    {{ html()->input('password', 'password')->class('w-full') }}
</div>