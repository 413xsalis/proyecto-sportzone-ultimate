<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->

    <!-- Assets locales -->
    <link href="{{ asset('assets/cssinicio/styles.css') }}" rel="stylesheet">
    <title>@yield('title', 'SportZone')</title>
</head>
<body class="app sidebar-mini">
    @include('iniciosportzone.partials.header')
    
    <div class="app-content">
        @yield('content')
    </div>

    @include('iniciosportzone.partials.footer')
</body>
</html>