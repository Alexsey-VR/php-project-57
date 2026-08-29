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
                <div class="flex flex-row items-center h-16">
                    <a href="{{ route('index') }}"
                        class="flex text-xl font-bold text-gray-900 hover:text-indigo-600 ml-1">
                        {{ __('app.name') }}
                    </a>
                    <div class="flex items-center space-x-4 ml-auto">
                        @auth
                            <a href="{{ route('task_statuses.index') }}" 
                                class="text-sm text-gray-700 ml-auto hover:text-indigo-600">
                                {{ __('tasks.statuses') }}
                            </a>
                            {{ html()->modelForm($user, 'POST', route('logout'))->open() }}
                                @csrf
                                <button class="rounded-md text-sm text-center font-semibold text-white h-10 w-24 bg-indigo-600">
                                    {{ __('app.exit') }}
                                </button>
                            {{ html()->closeModelForm() }}
                        @else
                            @yield('login')
                            @yield('register')
                        @endauth
                </div>
            </div>
        </nav>
        @yield('label')
        @yield('content')
        @stack('scripts')
    </body>
</html>
