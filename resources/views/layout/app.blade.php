<!DOCTYPE html>
<html lang="en">

    <head>
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

</html>
