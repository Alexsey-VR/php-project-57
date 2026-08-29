@extends('layouts.auth')

@section('content')
{{ html()->modelForm($user, 'POST', route('register.store'))->open() }}
    @csrf
    <div class="grid gap-4 rounded-md">
        {{ html()->label(__('users.name'), 'name') }}
        <div class="w-full bg-white p-2 rounded-md outline-solid outline-indigo-100">
            {{ html()->input('text', 'name')->class('w-full') }}
        </div>

        @include('auth.form')

        {{ html()->label(__('users.confirmation'), 'password_confirmation') }}
        <div class="w-full bg-white p-2 rounded-md outline-solid outline-indigo-100">
            {{ html()->input('password', 'password_confirmation')->class('w-full') }}
        </div>
        <div class="grid grid-cols-2 gap-4">
            <a href="{{ route('login') }}" class="underline">{{ __('users.already_registered') }}</a>
            <div class="shadow-md bg-indigo-100 p-2 rounded-md outline-indigo-100 text-center font-medium">
                {{ html()->submit(__('users.create')) }}
            </div>
        </div>
    </div>
{{ html()->closeModelForm() }}
@endsection
