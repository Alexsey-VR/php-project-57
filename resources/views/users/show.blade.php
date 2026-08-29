@extends('layouts.app')

@section('content')
    <div>
        <h1>{{ __('users.user') }}</h1>
        <p class="text-3xl font-bold">{{ $user->name }}</p>
    </div>
    <div>
        <h1>{{ __('users.email') }}</h1>
        <p>{{ $user->email }}</p>
    </div>
    <div>
        <h1>{{ __('users.created_at') }}</h1>
        <p>{{ $user->created_at }}</p>
    </div>
    <div>
        <h1>{{ __('users.updated_at') }}</h1>
        <p>{{ $user->updated_at }}</p>
    </div>
@endsection
