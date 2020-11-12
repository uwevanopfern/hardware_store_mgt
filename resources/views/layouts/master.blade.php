<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Hardware Store</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com" />
        <link
            href="https://fonts.googleapis.com/css?family=Nunito"
            rel="stylesheet"
        />

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
        <!-- All Generated styles form dashlite -->
        <link rel="stylesheet" href="{{ asset('css/dashlite.css') }}" />
        <!-- This file is for you to include your own styles -->
        <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />

        <!-- Premade Skin style -->
        <link
            rel="stylesheet"
            href="{{ asset('assets/css/skins/theme-{blue|red|...}.css') }}"
        />
    </head>
    <body>
        <div id="app">
            @yield('content')
        </div>
        <script src="{{ asset('js/bundle.js') }}"></script>
        <script src="{{ asset('js/example-chart.js') }}"></script>
        <script src="{{ asset('js/example-sweetalert.js') }}"></script>
        <script src="{{ asset('js/example-toastr.js') }}"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
    </body>
</html>
