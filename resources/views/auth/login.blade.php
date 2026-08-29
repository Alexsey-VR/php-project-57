@extends('layouts.auth')

@section('content')
{{ html()->modelForm($user, 'POST', route('login.store'))->open() }}
    @csrf
    <div class="grid gap-4 rounded-md">
        @include('auth.form')

        <div class="shadow-md bg-indigo-100 p-2 rounded-md outline-indigo-100 text-center font-medium">
            {{ html()->submit(__('app.login')) }}
        </div>
    </div>
{{ html()->closeModelForm() }}
@endsection