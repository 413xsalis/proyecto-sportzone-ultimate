@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">

                    {{-- Ícono grande y título --}}
                    <div class="text-center mb-4">
                        <i class="bi bi-lock-fill display-1 text-primary"></i>
                        <h3 class="mt-3">{{ __('Reestablecer contraseña') }}</h3>
                        <p class="text-muted">Ingrese su dirección de correo electrónico y le enviaremos un enlace para restablecer su contraseña.</p>
                    </div>

                    {{-- Mensaje de éxito --}}
                    @if (session('status'))
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            <span>¡Listo! Te hemos enviado un enlace para restablecer tu contraseña. Revisa tu correo 📬</span>
                        </div>
                    @endif

                    {{-- Formulario --}}
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Correo Eletrónico') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                <input id="email" type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-send-fill me-1"></i> {{ __('Enviar link de reestablecimiento de contraseña') }}
                            </button>
                        </div>
                    </form>

                    {{-- Enlace de regreso --}}
                    <div class="text-center mt-4">
                        <a href="{{ route('login') }}" class="text-decoration-none">
                            <i class="bi bi-arrow-left-circle me-1"></i> Volver al inicio de sesión
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection