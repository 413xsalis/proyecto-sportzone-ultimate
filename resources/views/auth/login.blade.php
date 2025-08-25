<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('assets/estilos_login.css') }}">
</head>

<body>


    <section class="h-100 gradient-form" style="background-image: url('Fondodeporte.jpeg');
                                                background-size: cover;
                                                background-repeat: no-repeat;
                                                background-position: center;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black animated-card">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <img src="{{ asset('assets/logo_sportzone-edit.png') }}" style="width: 150px;
                                        padding: 10px; opacity: 0.4; background: radial-gradient(circle at 20% 30%, rgb(3, 23, 138), transparent), 
                                        radial-gradient(circle at 70% 80%, rgb(5, 92, 24), transparent);
                                        border-radius: 10px; " alt="logo">

                                    </div>

                                    @if (session('error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ session('error') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif


                                    <form action="{{ route('login') }}" method="post">
                                        @csrf
                                        <p>Por favor inicia sesión con tu cuenta</p>




                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="email" name="email" id="email" class="form-control"
                                                placeholder="Digita tu usuario" />
                                            <label class="form-label" for="email">Usuario</label>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="password" name="password" id="password" class="form-control"
                                                placeholder="Digita la contraseña" />
                                            <label class="form-label" for="password">Contraseña</label>
                                        </div>


                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3"
                                                type="submit">Login</button><br>

                                            <a class="text-muted" href="#!">¿Olvidaste tu contraseña?</a>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">No tienes cuenta?</p>
                                            <a href="{{ route('register') }}" data-mdb-button-init
                                                data-mdb-ripple-init>Registrarse</a>
                                        </div>



                                    </form>

                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mt-1 mb-5 pb-1">¡Bienvenidos!</h4>
                                    <p class="small mb-0">Nos alegra tenerte aquí. Inicia sesión para acceder a tu panel
                                        personalizado,
                                        gestionar tus actividades y mantenerte conectado con tu comunidad deportiva. Ya
                                        seas entrenador,
                                        administrador o colaborador.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>