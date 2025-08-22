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

            0%,
            100% {
                transform: translateY(0rem);
            }

            50% {
                transform: translateY(-1.5rem);
            }
        }

        .contact-form label {
            transition: all 0.2s linear;
        }

        .contact-form input:focus~label,
        .contact-form input:valid~label,
        .contact-form textarea:focus~label,
        .contact-form textarea:valid~label {
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
    <main class="app-content">
        <!-- Sección Inicio -->
        <section id="inicio" class="py-5" style="background: url('{{ asset('assets/imginicio/inicio_fondo.png') }}') no-repeat; background-size: cover; background-position: center;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h1 class="display-4 fw-bold mb-4">
                            JARD TI <span class="text-custom-limon">TECNOLOGIA Y Desarrollo</span>
                        </h1>
                        <p class="lead mb-4">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                            Minima odio possimus rem. Ab, natus ad hic nisi enim ex omnis mollitia dolor,
                            neque laborum saepe debitis eius. Perspiciatis, molestias laudantium.
                        </p>
                        <a href="#" class="btn btn-custom btn-lg px-4">MAS DETALLES</a>
                    </div>
                    <div class="col-lg-6">
                        <img src="{{ asset('assets/imginicio/copa-ganadora-concepto-medalla-oro.png') }}"
                            alt="Imagen inicio"
                            class="img-fluid float-animation">
                    </div>
                </div>
            </div>
        </section>

        <!-- Sección Nosotros -->
        <section id="detalles" class="py-5 bg-light">
            <div class="container">
                <h2 class="heading text-center display-4 fw-bold mb-5">Nosotros</h2>

                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <img src="{{ asset('assets/imginicio/grupo_jard.png') }}"
                                    alt="Empresa JARD"
                                    class="img-fluid mb-4" style="max-width: 50%;">
                                <h3 class="h4 mb-3">Empresa de Desarrollo TI</h3>
                                <p class="mb-4">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Voluptas suscipit illum a repellendus adipisci ullam nesciunt!
                                    Dolores, in! Deleniti omnis amet animi voluptate
                                    quod molestias perspiciatis sint laborum autem id!
                                </p>
                                <a href="#" class="btn btn-custom">VER MAS</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <img src="{{ asset('assets/imginicio/digital-blue-hud-interface-laptop-concept.jpg') }}"
                                    alt="Compromiso TI"
                                    class="img-fluid mb-4" style="max-width: 50%;">
                                <h3 class="h4 mb-3">Compromiso al Desarrollo TI</h3>
                                <p class="mb-4">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Voluptas suscipit illum a repellendus adipisci ullam nesciunt!
                                    Dolores, in! Deleniti omnis amet animi voluptate
                                    quod molestias perspiciatis sint laborum autem id!
                                </p>
                                <a href="#" class="btn btn-custom">VER MAS</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <img src="{{ asset('assets/imginicio/businessman-working-futuristic-office.jpg') }}"
                                    alt="Versatilidad"
                                    class="img-fluid mb-4" style="max-width: 50%;">
                                <h3 class="h4 mb-3">Versatilidad</h3>
                                <p class="mb-4">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Voluptas suscipit illum a repellendus adipisci ullam nesciunt!
                                    Dolores, in! Deleniti omnis amet animi voluptate
                                    quod molestias perspiciatis sint laborum autem id!
                                </p>
                                <a href="#" class="btn btn-custom">VER MAS</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sección Servicios -->
        <section id="servicios" class="py-5" style="background: url('{{ asset('assets/imginicio/fondo_2.png') }}') no-repeat; background-size: contain; background-position: left;">
            <div class="container">
                <h2 class="heading text-center display-4 fw-bold mb-5">Servicios</h2>

                <div class="row align-items-center">
                    <div class="col-lg-6 order-lg-2">
                        <div class="ps-lg-5">
                            <h3 class="h2 mb-4">Empresa de Desarrollo</h3>
                            <p class="lead mb-4">
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                                Quam quod corrupti cupiditate alias quo iure suscipit id ad.
                                Reprehenderit ipsum totam quisquam autem dolore,
                                rem commodi culpa minus beatae minima!
                            </p>
                            <div class="d-flex gap-3">
                                <a href="#" class="btn btn-custom flex-grow-1">
                                    <i class="fab fa-google-play me-2"></i> GOOGLE PLAY
                                </a>
                                <a href="#" class="btn btn-custom flex-grow-1">
                                    <i class="fab fa-facebook-f me-2"></i> FACEBOOK
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <img src="{{ asset('assets/imginicio/logo_sportzone-no fondo.png') }}"
                            alt="Logo SportZone"
                            class="img-fluid">
                    </div>
                </div>
            </div>
        </section>

        <!-- Sección Contactos -->
        <section id="contactos" class="py-5 bg-light">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <img src="{{ asset('assets/imginicio/contactos.jpg') }}"
                            alt="Contactos"
                            class="img-fluid rounded">
                    </div>
                    <div class="col-lg-6">
                        <form class="bg-white p-4 rounded shadow-sm">
                            <h2 class="heading mb-4">Contactos</h2>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="nombre" placeholder="Nombre" required>
                                <label for="nombre">Nombre</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" placeholder="Email" required>
                                <label for="email">Email</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="tel" class="form-control" id="telefono" placeholder="Teléfono" required>
                                <label for="telefono">Teléfono</label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="mensaje" placeholder="Mensaje" style="height: 150px"></textarea>
                                <label for="mensaje">Mensaje</label>
                            </div>

                            <button type="submit" class="btn btn-custom w-100 py-3">ENVIAR</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>