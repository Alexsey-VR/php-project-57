@extends('layouts.app')

@section('content')
<div class="flex rounded-md text-base text-center">
    @include('flash::message')
</div>

<div class="text-lg font-bold p-8">
    <h1>{{ __('app.welcome') }}</h1>
</div>
@endsection
