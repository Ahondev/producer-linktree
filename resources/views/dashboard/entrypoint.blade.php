<html lang="en" class="dark">

<head>
    <meta name="csrf" content="{{ csrf_token() }}">
    <meta name="domain" content="{{ env("APP_DOMAIN") }}">
    @vite(['resources/css/config/dashboard.scss'])
    <title>{{ config("app.name") }} - Dashboard</title>
</head>

<body
    v-component="{{ $context->component }}"
    @isset($context->user) v-user="{!! $context->user !!}" @endif
    @isset($context->data) v-data="{{ json_encode($context->data) }}" @endif
>
    <main id="app"></main>
</body>

@vite(['resources/js/dashboard.js'])
<script async src="https://analytics.ahon.dev/js/embed.host.js"></script>

</html>
