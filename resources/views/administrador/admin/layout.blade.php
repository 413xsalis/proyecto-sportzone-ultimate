<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Assets locales -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <title>@yield('title', 'SportZone')</title>

</head>
<body class="app sidebar-mini">
    @include('administrador.admin.partials.header')
    

    
    <div class="app-content">
        @yield('content')
        
    </div>

    

    @include('administrador.admin.partials.footer')
</body>
</html>