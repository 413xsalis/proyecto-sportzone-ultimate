@extends('colaborador.inicio_colab.layout')

@section('title', 'Perfil de Usuario')

@section('content')
  <main class="content" >
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-12">
                    <h1 class="h3 mb-0"><i class="bi bi-person-circle me-2"></i> Perfil de Usuario</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('colab.principal') }}">Inicio</a></li>
                            <li class="breadcrumb-item active">Perfil</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- Header con información del usuario -->
            <div class="profile-header">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-2 text-center">
                            <div class="avatar-container">
                                <img src="{{ Auth::user()->foto_perfil ? asset('storage/' . Auth::user()->foto_perfil) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&size=150&background=random' }}" 
                                    class="avatar rounded-circle" id="profileAvatar">
                                <div class="avatar-edit" data-bs-toggle="modal" data-bs-target="#uploadLogoModal">
                                    <i class="bi bi-camera"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <h2>{{ Auth::user()->name }}</h2>
                            <p class="mb-1"><i class="bi bi-envelope me-2"></i> {{ Auth::user()->email }}</p>
                            <p class="mb-0"><i class="bi bi-tag me-2"></i> {{ Auth::user()->rol }}</p>
                        </div>
                        <div class="col-md-3 text-md-end">
                            @if(Auth::user()->logo_personalizado)
                                <img src="{{ asset('storage/' . Auth::user()->logo_personalizado) }}" 
                                    alt="Logo Personalizado" height="40" class="mb-2">
                            @endif
                            <br>
                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#uploadLogoModal">
                                <i class="bi bi-pencil me-1"></i> Cambiar Imagen
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist">
                                <a class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" href="#v-pills-home" role="tab">
                                    <i class="bi bi-person-circle me-2"></i> Información Personal
                                </a>
                                <a class="nav-link" id="v-pills-documentos-tab" data-bs-toggle="pill" href="#v-pills-documentos" role="tab">
                                    <i class="bi bi-id-card me-2"></i> Documentos
                                </a>
                                <a class="nav-link" id="v-pills-security-tab" data-bs-toggle="pill" href="#v-pills-security" role="tab">
                                    <i class="bi bi-lock me-2"></i> Seguridad
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-9">
                    <div class="tab-content" id="v-pills-tabContent">
                        <!-- Pestaña de Información Personal -->
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="bi bi-person-circle me-2"></i> Información Personal</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('perfilcolab.update') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="name" class="form-label required-field">Nombre completo</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email" class="form-label required-field">Correo electrónico</label>
                                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="documento_identidad" class="form-label required-field">Documento de identidad</label>
                                                <input type="text" class="form-control" id="documento_identidad" name="documento_identidad" 
                                                    value="{{ old('documento_identidad', Auth::user()->documento_identidad) }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                                                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" 
                                                    value="{{ old('fecha_nacimiento', Auth::user()->fecha_nacimiento) }}">
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="telefono" class="form-label">Número de teléfono</label>
                                                <input type="tel" class="form-control" id="telefono" name="telefono" 
                                                    value="{{ old('telefono', Auth::user()->telefono) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="eps" class="form-label">EPS</label>
                                                <select class="form-select" id="eps" name="eps">
                                                    <option value="">Seleccione su EPS</option>
                                                    <option value="Sura" {{ old('eps', Auth::user()->eps) == 'Sura' ? 'selected' : '' }}>Sura</option>
                                                    <option value="Nueva EPS" {{ old('eps', Auth::user()->eps) == 'Nueva EPS' ? 'selected' : '' }}>Nueva EPS</option>
                                                    <option value="Sanitas" {{ old('eps', Auth::user()->eps) == 'Sanitas' ? 'selected' : '' }}>Sanitas</option>
                                                    <option value="Coomeva" {{ old('eps', Auth::user()->eps) == 'Coomeva' ? 'selected' : '' }}>Coomeva</option>
                                                    <option value="Famisanar" {{ old('eps', Auth::user()->eps) == 'Famisanar' ? 'selected' : '' }}>Famisanar</option>
                                                    <option value="Otro" {{ old('eps', Auth::user()->eps) == 'Otro' ? 'selected' : '' }}>Otra</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="direccion_hogar" class="form-label">Dirección de hogar</label>
                                            <textarea class="form-control" id="direccion_hogar" name="direccion_hogar" rows="3">{{ old('direccion_hogar', Auth::user()->direccion_hogar) }}</textarea>
                                        </div>
                                        
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Actualizar información</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Pestaña de Documentos -->
                        <div class="tab-pane fade" id="v-pills-documentos" role="tabpanel">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="bi bi-id-card me-2"></i> Documentos</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('perfilcolab.uploadDocument') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        
                                        <div class="mb-4">
                                            <label for="foto_documento" class="form-label required-field">Foto del documento de identidad</label>
                                            <input type="file" class="form-control" id="foto_documento" name="foto_documento" accept="image/*">
                                            <div class="form-text">Suba una imagen clara de ambos lados de su documento de identidad.</div>
                                            
                                            @if(Auth::user()->foto_documento)
                                            <div class="mt-3">
                                                <p>Documento actual:</p>
                                                <img src="{{ asset('storage/' . Auth::user()->foto_documento) }}" alt="Documento de identidad" class="img-thumbnail" style="max-height: 200px;">
                                            </div>
                                            @endif
                                        </div>
                                        
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Subir documento</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Pestaña de Seguridad -->
                        <div class="tab-pane fade" id="v-pills-security" role="tabpanel">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="bi bi-lock me-2"></i> Seguridad</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('perfilcolab.changePassword') }}" method="POST">
                                        @csrf
                                        
                                        <div class="mb-3">
                                            <label for="current_password" class="form-label">Contraseña actual</label>
                                            <input type="password" class="form-control" id="current_password" name="current_password">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="new_password" class="form-label">Nueva contraseña</label>
                                            <input type="password" class="form-control" id="new_password" name="new_password">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="new_password_confirmation" class="form-label">Confirmar nueva contraseña</label>
                                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                                        </div>
                                        
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Cambiar contraseña</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal para subir logo/foto -->
    <div class="modal fade" id="uploadLogoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cambiar foto de perfil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('perfilcolab.uploadLogo') }}" method="POST" enctype="multipart/form-data" id="logoForm">
                        @csrf
                        <div class="mb-3">
                            <label for="logo" class="form-label">Seleccionar imagen</label>
                            <input class="form-control" type="file" id="logo" name="logo" accept="image/*">
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="useAsProfile" name="use_as_profile" checked>
                            <label class="form-check-label" for="useAsProfile">
                                Usar como foto de perfil
                            </label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" form="logoForm">Subir imagen</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Preview de imagen antes de subirla
        document.getElementById('logo').addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profileAvatar').src = e.target.result;
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });
        
        // Activar pestañas
        document.addEventListener('DOMContentLoaded', function() {
            const triggerTabList = [].slice.call(document.querySelectorAll('#v-pills-tab a'));
            triggerTabList.forEach(function(triggerEl) {
                new bootstrap.Tab(triggerEl);
            });
        });
    </script>
</body>
</html>
@endsection