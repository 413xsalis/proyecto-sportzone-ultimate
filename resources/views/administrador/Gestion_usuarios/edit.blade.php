@extends('administrador.Gestion_usuarios.layout')

@section('title', 'Editar Usuario')

@section('content')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario - Sistema de Gestión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #6f42c1;
            --success-color: #1cc88a;
            --light-bg: #f8f9fc;
        }
        
        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            margin-bottom: 1.5rem;
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 1rem 1.35rem;
            border: none;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: #3a5fc8;
            border-color: #3a5fc8;
        }
        
        .btn-secondary {
            background-color: #858796;
            border-color: #858796;
        }
        
        .profile-header {
            display: flex;
            align-items: center;
            padding: 1.5rem;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            margin-bottom: 1.5rem;
        }
        
        .profile-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            margin-right: 1.5rem;
        }
        
        .profile-info h2 {
            margin-bottom: 0.25rem;
            color: #333;
        }
        
        .profile-info p {
            color: #666;
            margin-bottom: 0;
        }
        
        .required-field::after {
            content: " *";
            color: #e74a3b;
        }
        
        .section-title {
            font-size: 1.1rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--primary-color);
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
            background-color: var(--primary-color);
            color: white;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }
        
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #d1d3e2;
            border-radius: 0.35rem;
            padding: 0.375rem 0.75rem;
        }
        
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        }
        
        .footer-actions {
            background-color: white;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0 -0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            position: sticky;
            bottom: 0;
            z-index: 100;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="text-decoration-none"><i class="bi bi-house-door"></i> Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('usuario.index') }}" class="text-decoration-none">Gestión de Usuarios</a></li>
                        <li class="breadcrumb-item active">Editar Usuario</li>
                    </ol>
                </nav>
                
                <div class="profile-header">
                    <div class="profile-avatar">
                        <i class="bi bi-person"></i>
                    </div>
                    <div class="profile-info">
                        <h2>{{ $usuario->name }}</h2>
                        <p>{{ $usuario->email }}</p>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i> Editar Información del Usuario</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('usuario.update', $usuario->id) }}" method="POST" id="userForm">
                            @csrf
                            @method('PUT')
                            
                            <div class="section-title">
                                <i class="bi bi-info-circle me-2"></i> Información Básica
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="form-label required-field">Nombre completo</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $usuario->name }}" required>
                                        <div class="form-text">Nombre completo del usuario</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-label required-field">Correo electrónico</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $usuario->email }}" required>
                                        <div class="form-text">Dirección de correo electrónico</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="section-title">
                                <i class="bi bi-shield-lock me-2"></i> Gestión de Roles
                            </div>
                            
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle me-2"></i> Seleccione uno o varios roles para asignar al usuario. 
                                Los roles actuales del usuario están resaltados.
                            </div>
                            
                            <div class="form-group mb-4">
                                <label for="roles" class="form-label required-field">Roles del usuario</label>
                                <select name="roles[]" id="roles" class="form-control" multiple="multiple" required>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}" {{ $usuario->hasRole($role->name) ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('roles')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                                
                                <div class="mt-3">
                                    <p class="mb-2">Roles actualmente asignados:</p>
                                    @foreach($usuario->roles as $role)
                                        <span class="role-badge">{{ $role->name }}</span>
                                    @endforeach
                                    @if($usuario->roles->count() == 0)
                                        <span class="text-muted">Este usuario no tiene roles asignados</span>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-actions mt-4">
            <div class="d-flex justify-content-between">
                <a href="{{ route('usuario.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i> Volver al listado
                </a>
                <div>
                    <button type="reset" form="userForm" class="btn btn-outline-secondary me-2">
                        <i class="bi bi-arrow-clockwise me-2"></i> Restablecer
                    </button>
                    <button type="submit" form="userForm" class="btn btn-primary">
                        <i class="bi bi-check2-circle me-2"></i> Actualizar Usuario
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inicializar Select2 para el select múltiple de roles
            $('#roles').select2({
                placeholder: "Seleccione uno o varios roles",
                allowClear: true,
                width: '100%'
            });
            
            // Validación básica del formulario
            $('#userForm').on('submit', function(e) {
                let isValid = true;
                
                // Validar campos requeridos
                $('#name, #email').each(function() {
                    if ($.trim($(this).val()) === '') {
                        isValid = false;
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });
                
                // Validar que se haya seleccionado al menos un rol
                if ($('#roles').val() === null || $('#roles').val().length === 0) {
                    isValid = false;
                    $('#roles').next('.select2-container').addClass('is-invalid');
                } else {
                    $('#roles').next('.select2-container').removeClass('is-invalid');
                }
                
                if (!isValid) {
                    e.preventDefault();
                    // Mostrar mensaje de error
                    alert('Por favor, complete todos los campos requeridos.');
                }
            });
        });
@endsection