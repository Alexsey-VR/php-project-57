@extends('layouts.app')

@section('content')
<div class="flex rounded-md text-base text-center">
    @include('flash::message')
</div>

<div class="text-lg font-bold p-8">
    <h1>Привет от Хекслета!</h1>
</div>
@endsection

@section('logout')
{{ html()->modelForm($user, 'POST', route('logout'))->open() }}
    @csrf
    <button class="rounded-md text-sm text-center font-semibold text-white h-10 w-24 bg-indigo-600">
        Выйти
    </button>
{{ html()->closeModelForm() }}
@endsection
