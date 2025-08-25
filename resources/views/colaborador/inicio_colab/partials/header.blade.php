<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="assets/css/main.css">
  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <title>Proyecto sportzone</title>
  <style>
    :root {
      --primary-color: #3b7ddd;
      --secondary-color: #6c757d;
      --success-color: #1cbb8c;
      --warning-color: #fcb92c;
      --danger-color: #dc3545;
      --light-bg: #f8f9fa;
    }

    body {
      background-color: #f5f6f8;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .app-title {
      margin-bottom: 1.5rem;
    }

    .app-title h1 {
      font-weight: 600;
      color: #2c3e50;
    }

    .stats-card {
      background: white;
      border-radius: 10px;
      padding: 1.5rem;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
      text-align: center;
      transition: transform 0.3s;
    }

    .stats-card:hover {
      transform: translateY(-5px);
    }

    .stats-card-primary {
      border-bottom: 4px solid var(--primary-color);
    }

    .stats-card-success {
      border-bottom: 4px solid var(--success-color);
    }

    .stats-card-danger {
      border-bottom: 4px solid var(--danger-color);
    }

    .stats-number {
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
    }

    .stats-card-primary .stats-number {
      color: var(--primary-color);
    }

    .stats-card-success .stats-number {
      color: var(--success-color);
    }

    .stats-card-danger .stats-number {
      color: var(--danger-color);
    }

    .stats-label {
      color: var(--secondary-color);
      font-size: 0.9rem;
      margin-bottom: 0;
    }

    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .card-header {
      background: white;
      border-bottom: 1px solid #edf2f9;
      padding: 1.25rem 1.5rem;
      border-radius: 10px 10px 0 0 !important;
    }

    .search-box {
      position: relative;
    }

    .search-box .bi-search {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: #6c757d;
    }

    .search-box .form-control {
      padding-left: 35px;
      border-radius: 30px;
      border: 1px solid #e2e8f0;
    }

    .table th {
      font-weight: 600;
      color: #2c3e50;
      border-top: none;
      border-bottom: 2px solid #edf2f9;
      padding: 1rem 0.75rem;
    }

    .table td {
      padding: 1rem 0.75rem;
      vertical-align: middle;
    }

    .btn {
      border-radius: 6px;
      font-weight: 500;
      padding: 0.5rem 1rem;
    }

    .btn-sm {
      padding: 0.25rem 0.5rem;
      font-size: 0.875rem;
    }

    .empty-state {
      text-align: center;
      padding: 3rem 1rem;
      color: #6c757d;
    }

    .empty-state i {
      font-size: 4rem;
      margin-bottom: 1rem;
      color: #dee2e6;
    }

    .empty-state h3 {
      font-weight: 600;
      margin-bottom: 0.5rem;
      color: #2c3e50;
    }

    .action-buttons .btn {
      margin-right: 0.4rem;
    }

    .pagination {
      margin-bottom: 0;
    }

    .page-link {
      border-radius: 6px;
      margin: 0 0.15rem;
      border: 1px solid #edf2f9;
      color: #2c3e50;
    }

    .page-item.active .page-link {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
    }

    .profile-image-nav {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #fff;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .profile-image-sidebar {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #fff;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .default-avatar {
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #6c757d;
      color: white;
      border-radius: 50%;
    }

    .default-avatar-nav {
      width: 40px;
      height: 40px;
    }

    .default-avatar-sidebar {
      width: 60px;
      height: 60px;
    }
  </style>
</head>

<body class="app sidebar-mini">
  <!-- Navbar-->
  <header class="app-header">
    <a class="app-header__logo" href="index.html">
      <img src="{{ asset('assets/images/logo_sf.png') }}" alt="Logo" style="height: 65px; vertical-align: middle;">
    </a>
    <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
      <li class="dropdown">
        <a class="app-nav__item" href="#" data-bs-toggle="dropdown" aria-label="Open Profile Menu">
          @if(Auth::user()->foto_perfil && Storage::disk('public')->exists(Auth::user()->foto_perfil))
            <img src="{{ asset('storage/' . Auth::user()->foto_perfil) }}" alt="Foto de perfil" class="profile-image-nav">
          @else
            <div class="default-avatar default-avatar-nav">
              <i class="bi bi-person fs-6"></i>
            </div>
          @endif
        </a>
        <ul class="dropdown-menu settings-menu dropdown-menu-right">
          <li>
            <a class="dropdown-item" href="{{ route('perfilcolab.edit') }}">
              <i class="bi bi-person me-2"></i> Perfil
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="bi bi-box-arrow-right me-2"></i> Cerrar sesión
            </a>
          </li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </ul>
      </li>
    </ul>
  </header>

  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar" id="sidebarOverlay"></div>
  <aside class="app-sidebar" id="sidebar">
    <div class="app-sidebar__user">
      <div class="d-flex align-items-center">
        @if(Auth::user()->foto_perfil && Storage::disk('public')->exists(Auth::user()->foto_perfil))
          <img src="{{ asset('storage/' . Auth::user()->foto_perfil) }}" alt="Foto de perfil"
            class="profile-image-sidebar me-3">
        @else
          <div class="default-avatar default-avatar-sidebar me-3">
            <i class="bi bi-person fs-4"></i>
          </div>
        @endif
        <div>
          <p class="mb-0 text-white fw-bold">{{ Auth::user()->name }}</p>
          <small class="text-white-50">Administrador</small>
        </div>
      </div>
    </div>
    <!-- Sidebar menu-->
    <ul class="app-menu">
      <a class="app-menu__item" href="{{ route('colab.gestion_clases') }}">
        <i class="bi bi-journal-bookmark me-2"></i>
        <span class="app-menu__label">Gestion de clases</span>
      </a>

      <a class="app-menu__item" href="{{route('estudiantes.index')}}">
        <i class="bi bi-person-plus me-2"></i>
        <span class="app-menu__label">Inscripcíon de Estudiantes</span>
      </a>

      <a class="app-menu__item" href="{{ route('pagos.index') }}">
        <i class="bi bi-cash-coin me-2"></i>
        <span class="app-menu__label">Pagos</span>
      </a>

      <a class="app-menu__item" href="{{ route('colab.reportes') }}">
        <i class="bi bi-bar-chart-line me-2"></i>
        <span class="app-menu__label">Reportes</span>
      </a>

    </ul>

  </aside>