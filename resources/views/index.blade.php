@extends('layouts.app')

@section('login')
<a href="{{ route('login') }}">
    <button class="rounded-md text-sm text-center font-semibold text-white h-10 w-24 bg-indigo-600 cursor-pointer">
        {{ __('app.login') }}
    </button>
</a>
@endsection

@section('register')
<a href="{{ route('register') }}">
    <button class="rounded-md text-sm text-center font-semibold text-white h-10 w-48 bg-indigo-600 cursor-pointer">
        {{ __('app.register') }}
    </button>
</a>
@endsection

@section('content')
<div class="text-lg font-bold p-8">
    <h1>{{ __('app.welcome') }}</h1>
</div>
@endsection