<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen font-body">
<nav class="bg-white">
    <div class="relative container mx-auto px-4 py-3 flex justify-between items-center">
        <a class="text-xl font-semibold" href="{{ url('/') }}">
            {{ config('app.name', 'Video Previewer') }}
        </a>

        <ul class="flex space-x-4">
            @guest
                <li>
                    <a class="hover:text-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li>
                        <a class="hover:text-primary" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <div x-data="{ logout: false}">

                    <button @click="logout = true" class="focus:outline-none">{{ Auth::user()->name }}</button>

                    <div class="absolute bg-white shadow-md rounded-lg p-2" x-show="logout"
                         @click.away="logout = false">
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </div>
                </div>
            @endguest
        </ul>
    </div>
</nav>

<main class="py-4">
    @yield('content')
</main>


<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
