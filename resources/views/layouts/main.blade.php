<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <!-- CSRF Token -->
    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Fonts -->
    <link
        rel="dns-prefetch"
        href="//fonts.gstatic.com"
    >
    <link
        href="https://fonts.bunny.net/css?family=Nunito"
        rel="stylesheet"
    >

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <main-layout
            menu-header="{{ \App\Models\Menu::getHeader() }}"
            :menu="{{ json_encode(\App\Models\Menu::getData()) }}"
            v-model="formData"
        >
            @yield('content')
        </main-layout>
    </div>
</body>

</html>
