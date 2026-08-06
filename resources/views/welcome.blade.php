@extends('layouts.app')

@section('content')
<h1>Привет от Хекслета!</h1>
@endsection

@section('logout')
{{ html()->modelForm($user, 'POST', route('logout'))->open() }}
    {{ html()->submit('Выйти') }}
{{ html()->closeModelForm() }}
@endsection