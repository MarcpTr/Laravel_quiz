<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>
    <div>
        <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <ul> @guest
                            @if (Route::has('login'))
                                <li >
                                    <a href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li >
                                    <a  href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li >
                                <a href="{{ route("user.profile") }}" role="button">
                                    {{ Auth::user()->name }}
                                </a>
                               
                                <div >
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                        <li >
                            <a href="{{ route('quizzes.quizzes') }}">quizzes</a>
                        </li>
                        @if (auth()->check() && auth()->user()->name === 'admin')
                        <li>
                            <a href="{{ route("admin.create") }}" role="button">
                            crear quiz
                        </a></li>
                        <li>
                            <a href="{{ route("admin.list") }}" role="button">
                            Ver Quizzes
                        </a></li>
                        @endif
                    </ul> <main >
            @yield('content')
        </main>
    </div>
</body>
</html>
