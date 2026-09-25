<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ __('app.name')}}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="csrf-param" content="_token">
        @php
            $translation = [
                'question' => __('tasks.sweetalert.question'),
                'text'     => __('tasks.sweetalert.text'),
                'confirm'  => __('tasks.sweetalert.confirm'),
                'cancel'   => __('tasks.sweetalert.cancel') 
            ];
        @endphp
        <script>
            window.translation = @json($translation);
        </script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-indigo-100" >
        @include('sweetalert2::index')
        <nav class="bg-white border-b border-gray-200 shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-row justify-between items-center h-16">
                    <a href="{{ route('index') }}"
                        class="flex text-xl font-bold text-gray-900 hover:text-indigo-600">
                        {{ __('app.name') }}
                    </a>
                    @auth
                        <div class="flex flex-1 items-center justify-center gap-8">
                            <a href="{{ route('tasks.index') }}" 
                                class="text-sm text-gray-700 hover:text-indigo-600">
                                {{ __('tasks.tasks') }}
                            </a>
                            <a href="{{ route('task_statuses.index') }}" 
                                class="text-sm text-gray-700 hover:text-indigo-600">
                                {{ __('tasks.statuses') }}
                            </a>
                        </div>
                        <div flex items-center space-x-4>
                            {{ html()->modelForm($user, 'POST', route('logout'))->open() }}
                                @csrf
                                <button class="rounded-md text-sm text-center font-semibold text-white h-10 w-24 bg-indigo-600">
                                    {{ __('app.exit') }}
                                </button>
                            {{ html()->closeModelForm() }}
                        </div>
                    @else
                        <div flex items-center space-x-4>
                            @yield('login')
                            @yield('register')
                        </div>
                    @endauth
                </div>
            </div>
        </nav>
        @if ($errors->any())
            <div class="mb-4 rounded-md bg-red-50 p-3 text-sm text-red-700">
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