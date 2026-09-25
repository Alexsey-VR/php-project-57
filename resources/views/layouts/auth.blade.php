<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ __('app.name') }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="csrf-param" content="_token">
        @vite(['resources/css/app.css'])
    </head>
    <body>
        @if ($errors->any())
            <div class="rounded-md bg-red-50 p-3 text-sm text-red-700">
                <ul class="list-desc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="flex min-h-screen items-center justify-center bg-indigo-100 px-4">
            <div class="w-full max-w-md bg-indigo-50 rounded-2xl shadow-lg p-8 space-y-6">
                <h1 class="text-3xl text-center font-serif">{{ __('app.name') }}</h1>
                    @yield('content')
            </div>
        </div>
    </body>
</html>