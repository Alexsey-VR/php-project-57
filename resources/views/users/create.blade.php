@extends('layouts.login')

@section('content')
<div class="w-full max-w-md bg-indigo-50 rounded-2xl shadow-lg p-8 space-y-6">
    <h1 class="text-3xl text-center font-serif">Менеджер задач</h1>
    {{ html()->modelForm($user, 'POST', route('users.store'))->open() }}
        @csrf
        <div class="grid gap-4 rounded-md">
            {{ html()->label('Имя', 'name') }}
            <div class="w-full bg-white p-2 rounded-md outline-solid outline-indigo-100">
                {{ html()->input('text', 'name') }}
            </div>
            {{ html()->label('Email', 'email') }}
            <div class="w-full bg-white p-2 rounded-md outline-solid outline-indigo-100">
                {{ html()->input('email', 'email') }}
            </div>
            {{ html()->label('Password', 'password') }}
            <div class="w-full bg-white p-2 rounded-md outline-solid outline-indigo-100">
                {{ html()->input('password', 'password') }}
            </div>
            <div class="shadow-md bg-indigo-100 p-2 rounded-md outline-indigo-100 text-center font-medium">
                {{ html()->submit('Создать') }}
            </div>
        </div>
    {{ html()->closeModelForm() }}
</div>
@endsection