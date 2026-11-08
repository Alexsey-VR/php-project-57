@extends('layouts.app')

@section('content')
<div>
    <h1 class="text-2xl font-bold px-4 py-4 text">{{ __('tasks.labels') }}</h1>
    <div class="p-2">
        @can('create', App\Models\Label::class)
            <button class="rounded-md text-sm text-center font-semibold text-white h-10 w-auto px-4 bg-indigo-600 cursor-pointer">
                <a href="{{ route('labels.create') }}">
                    {{ __('tasks.label.header.create') }}
                </a>
            </button>
        @endcan
    </div>
    <table class="table-fixed">
        <thead class="border-b bg-gray-100 text-left">
            <tr>
                <th style="padding-left: var(--col-px-id); width: var(--col-w-id)" class="py-2">ID</th>
                <th style="padding-left: var(--col-px-name); width: var(--col-w-name); min-width: var(--col-min-w-name)" class="py-2">{{ __('tasks.label.name') }}</th>
                <th style="padding-left: var(--col-px-description); width: var(--col-w-description); min-width: var(--col-min-w-description)" class="py-2">{{ __('tasks.label.description') }}</th>
                <th style="padding-left: var(--col-px-date); width: var(--col-w-date); min-width: var(--col-min-w-date)" class="py-2">{{ __('tasks.label.header.date') }}</th>
                <th style="padding-left: var(--col-px-actions); width: var(--col-w-actions); min-width: var(--col-min-w-actions)" class="py-2">{{ __('tasks.label.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($labels as $label)
                <tr>
                    <td style="padding-left: var(--col-px-id); width: var(--col-w-id)" class="py-2">{{ $label->id }}</td>
                    <td style="padding-left: var(--col-px-name); width: var(--col-w-name); min-width: var(--col-min-w-name)" class="py-2">
                        <a href="{{ route('labels.show', $label) }}">{{ $label->name }} </a>
                    </td>
                    <td style="padding-left: var(--col-px-description); width: var(--col-w-description); min-width: var(--col-min-w-description)" class="py-2">{{ $label->description }}</td>
                    <td style="padding-left: var(--col-px-date); width: var(--col-w-date); min-width: var(--col-min-w-date)" class="py-2">{{ $label->created_at }}</td>
                    <td style="padding-left: var(--col-px-actions); width: var(--col-w-actions); min-width: var(--col-min-w-actions)" class="py-2">
                        <div class="flex space-x-4">
                            {{ html()->modelForm($label, 'DELETE', route('labels.destroy', $label))
                                    ->attribute('id', "form-label-{$label->id}")
                                    ->open() }}
                                @csrf
                                <a href="{{ route('labels.destroy', $label) }}"
                                        data-confirm="{{ __('tasks.sweetalert.question') }} {{ __('tasks.sweetalert.text', ['name' => $label->name]) }}"
                                        onclick="event.preventDefault(); if (confirm(this.dataset.confirm)) { this.closest('form').submit(); }"
                                        class="text-red-500 hover:text-red-700"
                                        rel="nofollow"
                                >
                                    {{ __('tasks.label.delete') }}
                                </a>
                            {{ html()->closeModelForm() }}
                            @can('update', $label)
                                <a href="{{ route('labels.edit', $label) }}"
                                    class="text-blue-500 hover:text-blue-700">{{ __('tasks.label.edit') }}
                                </a>
                            @endcan
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('pagination')
    <div>{{ $labels->links() }}</div>
@endsection
