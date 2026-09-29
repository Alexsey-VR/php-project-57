@extends('layouts.app')

@section('content')
<div>
    <h1 class="text-2xl font-bold px-4 py-4 text">{{ __('tasks.labels') }}</h1>
    <div class="p-2">
        <button class="rounded-md text-sm text-center font-semibold text-white h-10 w-auto px-4 bg-indigo-600">
            <a href="{{ route('labels.create') }}">
                {{ __('tasks.label.header.create') }}
            </a>
        </button>
    </div>
    <table class="table-auto">
        <thead class="border-b bg-gray-100 text-left">
            <tr>
                <th class="py-2 px-4">ID</th>
                <th class="py-2 px-4">{{ __('tasks.label.name') }}</th>
                <th class="py-2 px-4">{{ __('tasks.label.description') }}</th>
                <th class="py-2 px-4">{{ __('tasks.label.header.date') }}</th>
                <th class="py-2 px-4">{{ __('tasks.label.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($labels as $label)
                <tr>
                    <td class="py-2 px-4">{{ $label->id }}</td>
                    <td class="py-2 px-4">
                        <a href="{{ route('labels.show', $label) }}">{{ $label->name }} </a>
                    </td>
                    <td class="py-2 px-4">{{ $label->description }}</td>
                    <td class="py-2 px-4">{{ $label->created_at }}</td>
                    <td class="py-2 px-4">
                        <div class="flex space-x-4">
                            {{ html()->modelForm($label, 'DELETE', route('labels.destroy', $label))
                                    ->attribute('id', "form-label-{$label->id}")
                                    ->open() }}
                                @csrf
                                <button type='submit'
                                        onclick="confirmDelete(event, '{{ $label->name }}', 'form-label-{{ $label->id }}');"
                                        class="text-red-500 hover:text-red-700"
                                >
                                    {{ __('tasks.label.delete') }}
                                </button>
                            {{ html()->closeModelForm() }}
                            <a href="{{ route('labels.edit', $label) }}"
                                class="text-blue-500 hover:text-blue-700">{{ __('tasks.label.edit') }}
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
