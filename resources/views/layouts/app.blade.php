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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,800,800i,900,900i" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-grey-lighter">
    <div id="app">
        <nav class="flex items-center justify-between flex-wrap bg-white w-full px-6 py-6 shadow">
            <div class="md:ml-auto flex flex-col md:flex-row items-center list-reset {{ ! auth()->guest() ? 'container mx-auto md:px-0' : '' }} ">
                <!-- Authentication Links -->
                @guest
                    <li class="block md:mr-10 mb-3 md:mb-0 text-center">
                        <a class="block mt-4 lg:inline-block lg:mt-0 text-grey-dark hover:text-white mr-4 no-underline uppercase" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="block md:mr-10 mb-3 md:mb-0 text-center">
                        <a class="block mt-4 lg:inline-block lg:mt-0 text-grey-dark hover:text-white mr-4 no-underline uppercase" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @else
                @include('partials.user')
                @endguest
            </div>
        </nav>
        <section class="px-6 py-8 mb-4">
            <div class="container mx-auto">
                @yield('content')
            </div>
        </section>
    </div>
    {!! NoCaptcha::renderJs() !!}
</body>
</html>
