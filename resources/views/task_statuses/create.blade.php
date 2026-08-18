@extends('layouts.app')

@section('label')
    <div class="p-4 text-2xl font-bold text">
        <h1>Создать статус</h1>
    </div>
@endsection

@section('content')
    {{ html()->modelForm($task_status, 'POST', route('task_statuses.store'))->open() }}
        @csrf
        @include('task_statuses.form')
        <div class="p-2">
            {{ html()->submit('Создать')
                ->class('rounded-md text-sm text-center font-semibold text-white h-10 w-32 px-4 bg-indigo-600') }}
        </div>
    {{ html()->closeModelForm() }}
@endsection
