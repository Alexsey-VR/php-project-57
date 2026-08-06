<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="csrf-param" content="_token">
        @vite(['resources/css/app.css'])
    </head>
    <body>
        <div class="flex min-h-screen items-center justify-center bg-indigo-100 px-4">
            @yield('content')
        </div>
    </body>
</html>