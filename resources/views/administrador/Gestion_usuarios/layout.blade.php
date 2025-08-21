<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Assets locales -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <title>@yield('title', 'SportZone')</title>
</head>
<body class="app sidebar-mini">
    @include('administrador.Gestion_usuarios.partials.header')

    
    
    <div class="app-content">
        @yield('content')
        
    </div>

    <div class="loader-wrapper" id="loader" style="display: none;">
    <div class="loader"></div>
</div>

<style>
.loader-wrapper {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.loader {
    border: 5px solid #f3f3f3;
    border-top: 5px solid #3498db;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

<script>
// Mostrar loader al hacer clic en enlaces
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', function() {
            document.getElementById('loader').style.display = 'flex';
        });
    });
});

// Ocultar loader cuando la página termine de cargar
window.addEventListener('load', function() {
    document.getElementById('loader').style.display = 'none';
});
</script>


    @include('administrador.Gestion_usuarios.partials.footer')
</body>
</html>