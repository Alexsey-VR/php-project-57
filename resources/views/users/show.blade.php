@extends('layouts.app')

@section('content')
    <div>
        <h1>Пользователь</h1>
        <p class="text-3xl font-bold">{{ $user->name }}</p>
    </div>
    <div>
        <h1>Email</h1>
        <p>{{ $user->email }}</p>
    </div>
    <div>
        <h1>Created at</h1>
        <p>{{ $user->created_at }}</p>
    </div>
    <div>
        <h1>Updated at</h1>
        <p>{{ $user->updated_at }}</p>
    </div>
@endsection