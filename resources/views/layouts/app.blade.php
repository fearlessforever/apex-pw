<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-grey-lighter">
    <div id="app">
        <nav class="flex items-center justify-between flex-wrap bg-black w-full px-6 py-6">
            <div class="md:ml-auto flex flex-col md:flex-row items-center list-reset">
                    <!-- Authentication Links -->
                    @guest
                        <li class="block md:mr-10 mb-3 md:mb-0 text-center">
                            <a class="block mt-4 lg:inline-block lg:mt-0 text-grey-dark hover:text-white mr-4 no-underline uppercase" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="block md:mr-10 mb-3 md:mb-0 text-center">
                            <a class="block mt-4 lg:inline-block lg:mt-0 text-grey-dark hover:text-white mr-4 no-underline uppercase" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
            </div>
        </nav>
        <div class="flex items-center justify-center w-full md:pt-6 my-6 md:mb-0">
            <div class="container mx-auto px-4">
                @yield('content')
            </div>
        </div>
    </div>
    {!! NoCaptcha::renderJs() !!}
</body>
</html>
