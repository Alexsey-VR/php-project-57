@extends('layouts.task')

@section('label')
    <div class="p-4 text-2xl font-bold text">
        <h1>{{ __('tasks.label.name') }}: {{ $label->name }}</h1>
    </div>
@endsection

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
    @can('view', $label)
        {{ html()->label(__('tasks.label.name'), 'name')->class('text-bold') }}
        <div class="bg-white p-2">
            {{ $label->name }}
        </div>
        {{ html()->label(__('tasks.label.description'), 'description') }}
        <div class="bg-white p-2 overflow-y-auto">
            {{ $label->description }}
        </div>
    @endcan
@endsection
