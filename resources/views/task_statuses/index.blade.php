@extends('layouts.app')

@section('logout')
{{ html()->modelForm($user, 'POST', route('logout'))->open() }}
    @csrf
    <button class="rounded-md text-sm text-center font-semibold text-white h-10 w-24 bg-indigo-600">
        Выйти
    </button>
{{ html()->closeModelForm() }}
@endsection

@section('content')
<div>
    <h1>Здесь будет список статусов</h1>
</div>
@endsection