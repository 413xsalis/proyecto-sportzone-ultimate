<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Enlaza la hoja de estilos principal de Bootstrap 5. --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Enlaza la biblioteca de iconos de Bootstrap, que se usa para los iconos visuales. --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    {{-- Enlaza un archivo CSS local que contiene estilos personalizados. La función `asset()` de Laravel genera la ruta correcta. --}}
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    {{-- Define el título de la página. `@yield('title', 'SportZone')` es un marcador de posición de Blade; si una vista hija no define su propio título, se usará 'SportZone' por defecto. --}}
    <title>@yield('title', 'SportZone')</title>
</head>

<body class="app sidebar-mini">
    {{-- Incluye un fragmento de código (partial) para el encabezado de la página. Este archivo probablemente contiene la barra de navegación. --}}
    @include('instructor.horario.partials.header')

    {{-- `@hasSection('page-header')` verifica si la vista que extiende este layout ha definido una sección llamada 'page-header'. Si lo ha hecho, el siguiente bloque de código se mostrará. --}}
    @hasSection('page-header')
    <div class="page-header bg-white border-bottom">
        <div class="container-fluid d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center py-3">
            <div>
                {{-- Muestra el título y subtítulo de la página si han sido definidos. --}}
                @hasSection('page-title')
                <h1 class="h4 mb-1">@yield('page-title')</h1>
                @endif
                @hasSection('page-subtitle')
                <p class="text-muted mb-0">@yield('page-subtitle')</p>
                @endif
            </div>
            {{-- Muestra la ruta de navegación (breadcrumb) si ha sido definida. --}}
            @hasSection('breadcrumb')
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    @yield('breadcrumb')
                </ol>
            </nav>
            @endif
        </div>
    </div>
    @endif

    <div class="app-content">
        {{-- Aquí es donde se inyecta el contenido específico de cada página (la sección `content`). Por ejemplo, la tabla de horarios que vimos en el código anterior. --}}
        @yield('content')
    </div>

    {{-- Incluye el fragmento de código (partial) para el pie de página. --}}
    @include('instructor.horario.partials.footer')
</body>

</html>