<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPORT_ZONE</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Estilos personalizados -->
    <style>
        :root {
            --verde: #0c443a;
            --limon: #25d1b2;
            --degradado: linear-gradient(90deg, var(--limon), var(--verde));
        }

        .bg-custom-gradient {
            background: var(--degradado);
        }

        .text-custom-green {
            color: var(--verde);
        }

        .text-custom-limon {
            color: var(--limon);
        }

        .btn-custom {
            background: var(--degradado);
            color: white;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            transform: scale(1.05);
            color: white;
        }

        .heading {
            background: var(--verde);
            color: transparent;
            -webkit-background-clip: text;
            background-clip: text;
            text-transform: uppercase;
        }

        .navbar {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }

        .float-animation {
            animation: float 3s linear infinite;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0rem);
            }
            50% {
                transform: translateY(-1.5rem);
            }
        }

        .contact-form label {
            transition: all 0.2s linear;
        }

        .contact-form input:focus ~ label,
        .contact-form input:valid ~ label,
        .contact-form textarea:focus ~ label,
        .contact-form textarea:valid ~ label {
            top: -0.5rem !important;
            font-size: 1.2rem !important;
            color: var(--limon) !important;
        }

        section {
            padding: 5rem 0;
        }
        
        /* Estilos para los botones de auth */
        .auth-nav .nav-link {
            padding: 0.5rem 1rem;
            margin-left: 0.5rem;
            border-radius: 0.375rem;
            transition: all 0.2s ease;
        }
        
        .auth-nav .nav-link:hover {
            background-color: rgba(37, 209, 178, 0.1);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top py-3 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <span class="text-custom-green">JARD</span>
                <span class="text-custom-limon">developers</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link text-custom-green" href="#inicio">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-custom-green" href="#detalles">Nosotros</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link text-custom-green" href="#servicios">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-custom-green" href="#contactos">Contactos</a>
                    </li>
                </ul>
                
                <!-- Botones de autenticación -->
                @if (Route::has('login'))
                <ul class="navbar-nav auth-nav">
                    @auth
                        <li class="nav-item">
                            <a href="{{ route('admin.principal') }}" class="nav-link text-custom-green">
                                Dashboard
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link text-custom-green">
                                Log in
                            </a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link text-custom-green">
                                Register
                            </a>
                        </li>
                        @endif
                    @endauth
                </ul>
                @endif
            </div>
        </div>
    </nav>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>