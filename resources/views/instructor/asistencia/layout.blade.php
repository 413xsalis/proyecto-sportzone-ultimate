<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Enlaza a la biblioteca de estilos de Bootstrap para el diseño de la página --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Enlaza a la biblioteca de iconos de Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    {{-- Enlaza a un archivo CSS de tu proyecto, que probablemente contiene estilos personalizados. `asset()` es una función de Laravel que genera la URL correcta. --}}
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    {{-- Muestra el título de la página. `@yield` es un marcador de posición para un título personalizado, con 'SportZone' como valor por defecto. --}}
    <title>@yield('title', 'SportZone')</title>
</head>

<body class="app sidebar-mini">
    {{-- Incluye la cabecera específica para el módulo de asistencia. Este archivo (`header.blade.php`) probablemente contiene la barra de navegación y otros elementos de la parte superior. --}}
    @include('instructor.asistencia.partials.header')

    {{-- `@hasSection` es una directiva de Blade que verifica si una sección ha sido definida por la vista hija (la que usa este layout). Si 'page-header' existe, se muestra este bloque de código. --}}
    @hasSection('page-header')
    <div class="page-header bg-white border-bottom">
        <div class="container-fluid d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center py-3">
            <div>
                {{-- Muestra el título y el subtítulo de la página si existen. --}}
                @hasSection('page-title')
                <h1 class="h4 mb-1">@yield('page-title')</h1>
                @endif
                @hasSection('page-subtitle')
                <p class="text-muted mb-0">@yield('page-subtitle')</p>
                @endif
            </div>
            {{-- Muestra la navegación tipo "breadcrumb" si existe. --}}
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
        {{-- Aquí es donde se insertará el contenido principal (`@section('content')`) de la página específica, como la lista de grupos que vimos en el código anterior. --}}
        @yield('content')
    </div>

    {{-- Incluye el pie de página para el módulo de asistencia. Similar al header, este archivo (`footer.blade.php`) contiene la información de contacto y derechos de autor. --}}
    @include('instructor.asistencia.partials.footer')
</body>

</html>