@extends('layouts.task')

@section('label')
    <div class="p-4 text-2xl font-bold text">
        <h1>{{ __('tasks.label.header.create') }}</h1>
    </div>
@endsection

@section('content')
    {{ html()->modelForm($label, 'POST', route('labels.store'))->open() }}
        @csrf
        @include('labels.form')
        <div class="p-2">
            {{ html()->submit(__('tasks.label.confirm'))
                ->class('rounded-md text-sm text-center font-semibold text-white h-10 w-32 px-4 bg-indigo-600') }}
        </div>
    {{ html()->closeModelForm() }}
@endsection
