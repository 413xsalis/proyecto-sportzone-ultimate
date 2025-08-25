<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="assets/css/main.css">
  <!-- Font-icon css-->
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <!-- Tu CSS personalizado -->
  <link rel="stylesheet" href="assets/css/main.css"> <!-- Usa ruta absoluta con "/" -->
  <title>Proyecto sportzone</title>
</head>

<!-- Navbar-->

<body class="app sidebar-mini">
  <!-- Navbar-->
  <header class="app-header"><a class="app-header__logo" href="index.html">
      <img src="{{ asset('assets/images/logo_sf.png') }}" alt="Logo" style="height: 65px; vertical-align: middle;">
      <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <li class="dropdown"><a class="app-nav__item" href="#" data-bs-toggle="dropdown"
            aria-label="Open Profile Menu"><i class="bi bi-person fs-4"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
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

  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="" src="" alt="">
      <div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="app-sidebar__user-designation breadcrumb-item"><a href="{{ route('admin.principal') }}">Inicio</a>
          </li>

      </div>
    </div>
    <a class="app-menu__item" href="{{ route('admin.Gestion_usuarios') }}"></i><span class="app-menu__label">Gestion de
        usuarios</span></a>

    <a class="app-menu__item" href="{{ route('admin.Formulario_empleados') }}"></i><span
        class="app-menu__label">Formulario de
        empleados</span></a>
    <a class="app-menu__item" href="index.php?accion=reportes_admin"></i><span
        class="app-menu__label">Reportes</span></a>
  </aside>