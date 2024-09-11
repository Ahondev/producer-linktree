<!DOCTYPE html>
<html lang="en">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite(['resources/css/app.scss'])
        <title>@yield('title', '')</title>
        <meta name="domain" content="{{ env("APP_DOMAIN") }}">
        <meta name="csrf" content="{{ csrf_token() }}">
    </head>

    <body>

        <app-loading></app-loading>
{{--        @include("layout.partials.header")--}}

        <main id="app">
            @yield('content')
        </main>

{{--        @include("layout.partials.footer")--}}

    </body>

    @vite(['resources/js/app.js'])
    <script defer data-domain="sxko666.com" src="https://analytics.ahon.dev/js/script.js"></script>

</html>
