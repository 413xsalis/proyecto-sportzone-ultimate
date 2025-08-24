<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Proyecto sportzone</title>
    <style>
      .profile-image-nav {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #fff;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      }
      .profile-image-sidebar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #fff;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
              <a class="dropdown-item" href="{{ route('profile.edit') }}">
                <i class="bi bi-person me-2"></i> Perfil
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user">
        @if(Auth::user()->foto_perfil && Storage::disk('public')->exists(Auth::user()->foto_perfil))
          <img src="{{ asset('storage/' . Auth::user()->foto_perfil) }}" alt="Foto de perfil" class="profile-image-sidebar">
        @else
          <div class="default-avatar default-avatar-sidebar">
            <i class="bi bi-person fs-4"></i>
          </div>
        @endif      
      <div>
        <p class="mb-0">Administrador</p>
        <small>Bienvenido al sistema</small>
      </div>
    </div>

    <ul class="app-menu">
      <li>
        <a class="app-menu__item" href="{{ route('admin.principal') }}">
          <i class="bi bi-house-door"></i>
          <span class="app-menu__label">Inicio</span>
        </a>
      </li>
      
      <li>
        <a class="app-menu__item" href="{{ route('admin.Gestion_usuarios') }}">
          <i class="bi bi-people"></i>
          <span class="app-menu__label">Gestión de usuarios</span>
        </a>
      </li>
      
      
      <li>
        <a class="app-menu__item" href="#">
          <i class="bi bi-clipboard-data"></i>
          <span class="app-menu__label">Reportes</span>
        </a>
      </li>
    </ul>
  </aside>