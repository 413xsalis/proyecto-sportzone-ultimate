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
    @include('instructor.reporte.partials.header')

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

    @include('instructor.reporte.partials.footer')
</body>
</html>