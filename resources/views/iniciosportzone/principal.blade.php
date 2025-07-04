    @extends('iniciosportzone.layout')

    @section('content')

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
    @endsection