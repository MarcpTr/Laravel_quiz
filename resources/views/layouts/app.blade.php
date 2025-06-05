<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    <title>@yield('title', 'Quiz Time')</title>
</head>

<body>
    <header class="sticky h-12 top-0 w-full z-50 bg-blue-600  px-8">
        <nav class="flex justify-between h-full">
            <div class="content-center">
                <a href="{{ url('/') }}"> 
                    Quiz Time
                </a>
            </div>
            <div class="content-center space-x-8 ">
                @guest
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}">Acceder</a>
                    @endif
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Registrarse</a>
                    @endif
                @else
                    <a href="{{ route('user.profile') }}" role="button">
                        {{ Auth::user()->name }}
                    </a>

                @endguest
                <a href="{{ route('quizzes.index') }}">Cuestionarios</a>
                <a href="{{ route('categories.index') }}">Categorias</a>
                @if (auth()->check() && auth()->user()->name === 'admin')
                    <a href="{{ route('quizzes.create') }}" role="button">
                        Crear cuestionario
                    </a>
                    <a href="{{ route('categories.create') }}" role="button">
                        Crear categoria
                    </a>
                    <a href="{{ route('admin.quizzes.index') }}" role="button">
                        Lista cuestionarios
                    </a>
                @endif
            </div>
        </nav>
    </header>
    <div class="flex justify-center">
        @yield('content')
    </div>

</body>

</html>
