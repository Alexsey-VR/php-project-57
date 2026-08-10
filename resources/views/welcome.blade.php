@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 2">
    @include('flash::message')
</div>  

<h1>Привет от Хекслета!</h1>
@endsection

@section('logout')
{{ html()->modelForm($user, 'POST', route('logout'))->open() }}
    {{ html()->submit('Выйти') }}
{{ html()->closeModelForm() }}
@endsection