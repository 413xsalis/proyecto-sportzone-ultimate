<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{-- Enlaza a los estilos CSS principales de tu aplicación --}}
  <link rel="stylesheet" type="text/css" href="assets/css/main.css">
  {{-- Enlaza a los íconos de Bootstrap Icons --}}
  <link rel="stylesheet" type="text/css"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  {{-- Define el título de la página --}}
  <title>Proyecto sportzone</title>
</head>

<body class="app sidebar-mini">
  {{-- Encabezado de la página. Contiene el logo, el botón para colapsar la barra lateral y el menú de usuario. --}}
  <header class="app-header"><a class="app-header__logo" href="index.html">
      <img src="{{ asset('assets/images/logo_sf.png') }}" alt="Logo" style="height: 65px; vertical-align: middle;">

      <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <li class="dropdown"><a class="app-nav__item" href="#" data-bs-toggle="dropdown"
            aria-label="Open Profile Menu"><i class="bi bi-person fs-4"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="{{ route('perfilinst.edit') }}"><i class="bi bi-person me-2"></i> Perfil</a>
            </li>
            <a class="dropdown-item dropdown-item bi bi-box-arrow-right me-2 fs-5" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
              {{ __(' Cerrar sesion') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </ul>
        </li>
      </ul>
  </header>

  {{-- Overlay de la barra lateral. Se muestra al abrir el menú en dispositivos pequeños. --}}
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  {{-- Barra lateral de navegación --}}
  <aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="" src="" alt="">
      <div>
        {{-- Estructura de "breadcrumbs" (migas de pan) para mostrar la ruta de navegación --}}
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="app-sidebar__user-designation breadcrumb-item"><a href="#">Inicio</a></li>
        </ul>
      </div>
    </div>

    {{-- Lista de enlaces del menú principal --}}
    <ul class="app-menu">
      {{-- Enlace al módulo de horarios. `route()` es una función de Laravel para generar URL. --}}
      <a class="app-menu__item" href="{{ route('inst.horarios') }}"><i class="app-menu__icon bi bi-calendar2-week"></i><span class="app-menu__label">Horarios</span></a>

      {{-- Enlace al módulo de asistencia --}}
      <a class="app-menu__item" href="{{ route('inst.asistencia') }}"><i class="app-menu__icon bi bi-person-check"></i><span class="app-menu__label">Asistencia</span></a>

      {{-- Enlace al módulo de reportes --}}
      <a class="app-menu__item" href="{{ route('inst.reporte.asistencias') }}"><i class="app-menu__icon bi bi-file-earmark-bar-graph"></i><span
          class="app-menu__label">Reportes</span></a>
    </ul>
  </aside>