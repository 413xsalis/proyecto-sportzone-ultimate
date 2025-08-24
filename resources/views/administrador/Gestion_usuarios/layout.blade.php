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
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #6f42c1;
            --success-color: #1cc88a;
            --danger-color: #e74a3b;
            --warning-color: #f6c23e;
            --light-bg: #f8f9fc;
        }
        
        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }
        
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
        
        /* Estilos para la gestión de usuarios */
        .app-title {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            margin-bottom: 1.5rem;
        }
        
        .stats-card {
            text-align: center;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            color: white;
        }
        
        .stats-card-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        }
        
        .stats-card-danger {
            background: linear-gradient(135deg, var(--danger-color), #fd7e14);
        }
        
        .stats-card-success {
            background: linear-gradient(135deg, var(--success-color), #20c9a2);
        }
        
        .role-badge {
            display: inline-block;
            padding: 0.35em 0.65em;
            font-size: 0.75em;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.375rem;
            color: white;
            margin-right: 0.3rem;
            margin-bottom: 0.3rem;
        }
        
        .role-admin {
            background-color: var(--primary-color);
        }
        
        .role-colab {
            background-color: var(--secondary-color);
        }
        
        .role-user {
            background-color: var(--success-color);
        }
        
        .role-other {
            background-color: #6c757d;
        }
    </style>
</head>
<body class="app sidebar-mini">
    @include('administrador.Gestion_usuarios.partials.header')
    
    <div class="app-content">
        @yield('content')
    </div>

    <div class="loader-wrapper" id="loader" style="display: none;">
        <div class="loader"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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