@extends('layouts.task')

@section('label')
    <div class="p-4 text-2xl font-bold text">
        <h1>{{ __('tasks.label.name') }}:{{ $label->name }}</h1>
    </div>
@endsection

@section('content')
    {{ html()->label(__('tasks.label.name'), 'name')->class('text-bold') }}
<div class="bg-white p-2">
    {{ $label->name }}
</div>
{{ html()->label(__('tasks.label.description'), 'description') }}
<div class="bg-white p-2">
    {{ $label->description }}
</div>
@endsection
