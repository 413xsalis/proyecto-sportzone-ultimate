<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    {{-- Enlaza a un archivo CSS de tu proyecto que está en la carpeta 'public/assets/css' --}}
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    {{-- Muestra el título de la página. Si una página no define su propio título, se usará 'SportZone' como predeterminado. --}}
    <title>@yield('title', 'SportZone')</title>
</head>

<body class="app sidebar-mini">
    {{-- Incluye otro archivo de Blade (un "partial") que contiene el código del encabezado o header. --}}
    @include('instructor.inicio.partials.header')

    {{-- @hasSection es una directiva de Blade que comprueba si la página hija (la que usa este layout) ha definido una sección llamada 'page-header'. Si es así, se renderiza todo el contenido de este bloque. --}}
    @hasSection('page-header')
    <div class="page-header bg-white border-bottom">
        <div class="container-fluid d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center py-3">
            <div>
                {{-- Si existe la sección 'page-title', la muestra. --}}
                @hasSection('page-title')
                <h1 class="h4 mb-1">@yield('page-title')</h1>
                @endif
                {{-- Si existe la sección 'page-subtitle', la muestra. --}}
                @hasSection('page-subtitle')
                <p class="text-muted mb-0">@yield('page-subtitle')</p>
                @endif
            </div>
            {{-- Si existe la sección 'breadcrumb', la muestra dentro de una barra de navegación. --}}
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
        {{-- Aquí se inserta el contenido principal de cada página que use este layout. Es la sección 'content' que vimos en el archivo anterior. --}}
        @yield('content')
    </div>

    {{-- Incluye otro archivo "partial" que contiene el código del pie de página. --}}
    @include('instructor.inicio.partials.footer')
</body>

</html>