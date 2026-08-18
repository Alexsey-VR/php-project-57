@extends('layouts.auth')

@section('content')
<div class="w-full max-w-md bg-indigo-50 rounded-2xl shadow-lg p-8 space-y-6">
    <h1 class="text-3xl text-center font-serif">Менеджер задач</h1>
    {{ html()->modelForm($user, 'POST', route('register.store'))->open() }}
        @csrf
        <div class="grid gap-4 rounded-md">
            {{ html()->label('Имя', 'name') }}
            <div class="w-full bg-white p-2 rounded-md outline-solid outline-indigo-100">
                {{ html()->input('text', 'name')->class('w-full') }}
            </div>

            @include('auth.form')

            {{ html()->label('Подтверждение', 'password_confirmation') }}
            <div class="w-full bg-white p-2 rounded-md outline-solid outline-indigo-100">
                {{ html()->input('password', 'password_confirmation')->class('w-full') }}
            </div>
            <div class="grid grid-cols-2 gap-4">
                <a href="{{ route('login') }}" class="underline">Уже зарегистрированы?</a>
                <div class="shadow-md bg-indigo-100 p-2 rounded-md outline-indigo-100 text-center font-medium">
                    {{ html()->submit('Создать') }}
                </div>
            </div>
        </div>
    {{ html()->closeModelForm() }}
</div>
@endsection
