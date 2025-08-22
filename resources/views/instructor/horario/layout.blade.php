<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Enlaza la hoja de estilos principal de Bootstrap 5. --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Enlaza la biblioteca de iconos de Bootstrap, que se usa para los iconos visuales. --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    {{-- Enlaza un archivo CSS local que contiene estilos personalizados. --}}
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <title>@yield('title', 'SportZone')</title>
</head>

<body class="app sidebar-mini">
    @include('instructor.horario.partials.header')

    @hasSection('page-header')
    <div class="page-header bg-white border-bottom">
        <div class="container-fluid d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center py-3">
            <div>
                @hasSection('page-title')
                <h1 class="h4 mb-1">@yield('page-title')</h1>
                @endif
                @hasSection('page-subtitle')
                <p class="text-muted mb-0">@yield('page-subtitle')</p>
                @endif
            </div>
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
        @yield('content')
    </div>

    @include('instructor.horario.partials.footer')
</body>
</html>