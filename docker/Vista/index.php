<?php
session_start();
if (empty($_SESSION['rol'])) {
    $_SESSION['rol'] = 0;
}
if ($_SESSION['rol'] != "empleado" && $_SESSION['rol'] != "administrador" && $_SESSION['rol'] != "cliente") {
    $_SESSION['rol'] = 'invitado';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ALGRANO S.L.</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free Website Template" name="keywords">
    <meta content="Free Website Template" name="description">

    <!-- Favicon -->
    <link href="../img/LogoFavicon.png" rel="icon">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!--  Hojas de estilos de Librerias -->
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Hojas de estilos de Bootstrap -->
    <link href="../css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/loader.css">
    <style>
        .carousel-item {
            transition: transform 1.2s ease-in-out;
        }

        .carousel-fade .carousel-item {
            opacity: 0;
            transition: opacity .5s ease-in-out;
        }

        .carousel-fade .carousel-item.active {
            opacity: 1;
        }
    </style>
</head>

<body>
    <?php
    //Comprobamos si el usuario es invitado y mostrar un mensaje
    if ($_SESSION['rol'] == "invitado") { ?>
        <div style="background-color: #DA9F5B;" class="text-center py-2">
            <h4 class="text-black m-0"><i class="fas fa-user-clock mr-2"></i>MODO INVITADO</h4>
        </div>
    <?php } else { ?>
        <div style="background-color: #DA9F5B;" class="text-center py-2">
            <h4 class="text-black m-0"><i class="fas fa-coffee mr-2"></i>Bienvenido <?php echo $_SESSION['usuario'] ?></h4>
        </div>
    <?php } ?>
    <!-- Barra de navegación -->
    <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
            <a href="index.php" class="navbar-brand px-lg-4 m-0">
                <h1 class="m-0 display-4 text-uppercase text-white">
                    <img src="../img/ALGRANO.png" alt="Logo" height="80" width="80">
                </h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav ml-auto p-4">
                    <a href="sobreNosotros.php" class="nav-item nav-link">Sobre nosotros</a>
                    <a href="servicios.php" class="nav-item nav-link">Servicios</a>
                    <a href="menu.php" class="nav-item nav-link">Cátalogo</a>
                    <a href="comentarios.php" class="nav-item nav-link">Testimonio</a>
                    <a href="contacto.php" class="nav-item nav-link">Contacto</a>
                </div>
                <?php if ($_SESSION['rol'] == "invitado") { ?>
                    <a href="login.html" class="nav-item nav-link btn btn-primary font-weight-bold">Iniciar Sesión</a>
                    <a href="registro.html" class="nav-item nav-link btn btn-secondary font-weight-bold">Regístrate</a>
                <?php } ?>
                <?php if ($_SESSION['rol'] == "cliente") { ?>
                    <a href="carrito.php" class="nav-item nav-link">
                        <i class="fas fa-shopping-cart" style="color: #DA9F5B; font-size: 24px;"></i>
                    </a>
                <?php }
                ?>
                <?php if ($_SESSION['rol'] == "administrador" || $_SESSION['rol'] == "empleado" || $_SESSION['rol'] == "cliente"): ?>
                    <div class="nav-item dropdown">
                        <img src="../img/profilePic.png" class="nav-link dropdown-toggle" data-toggle="dropdown"
                            alt="Mi Cuenta" style="width: 100px; height: 80px; border-radius: 50%; margin-right: 20px;">
                        <div class="dropdown-menu text-capitalize"
                            style="background-color: rgba(27, 18, 15, 0.8); backdrop-filter: blur(8px); border-radius: 10px; left: -30px;">

                            <a href="perfil.php" class="dropdown-item" style="color: #DA9F5B;">Perfil</a>
                            <?php if ($_SESSION['rol'] == "administrador") { ?>
                                <a href="areaAdmin.php" class="dropdown-item" style="color: #DA9F5B" ;>Administrar</a>
                            <?php } elseif ($_SESSION['rol'] == "empleado") { ?>
                                <a href="areaEmpleado.php" class="dropdown-item" style="color: #DA9F5B" ;>Área Empleado</a>
                            <?php } elseif ($_SESSION['rol'] == "cliente") { ?>
                                <a href="pedidos.php" class="dropdown-item" style="color: #DA9F5B" ;>Mis pedidos</a>
                            <?php } ?>
                            <a href="../Controlador/cerrarSesion_proceso.php" class="dropdown-item"
                                style="color: #DA9F5B;">Cerrar sesión</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </nav>
    </div>
    <!-- Comienzo del carrousel -->
    <div class="container-fluid p-0 mb-5">
        <div id="blog-carousel" class="carousel slide" data-ride="carousel" data-interval="4000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="../img/carousel-1.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <h2 class="text-primary font-weight-medium m-0">Llevamos sirviendo</h2>
                        <h1 class="display-1 text-white m-0">CAFÉ</h1>
                        <h2 class="text-white m-0">* DESDE 2025 *</h2>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="../img/carousel-2.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <h2 class="text-primary font-weight-medium m-0">Servimos</h2>
                        <h1 class="display-1 text-white m-0">CAFÉ</h1>
                        <h2 class="text-white m-0">* 100% ORGÁNICO *</h2>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#blog-carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#blog-carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            <ol class="carousel-indicators">
                <li data-target="#blog-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#blog-carousel" data-slide-to="1"></li>
            </ol>
        </div>
    </div>
    <!-- Fin del carrousel -->
    <!-- Sobre nosotros -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="section-title">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Sobre nosotros</h4>
                <h1 class="display-4">Llevamos sirviendo café desde 2025</h1>
            </div>
            <div class="row">
                <div class="col-lg-4 py-0 py-lg-5">
                    <h1 class="mb-3">Sobre nosotros</h1>
                    <h5 class="mb-3">Nuestra pasión por el café nos impulsa a brindar la mejor experiencia en cada taza.
                        Somos una empresa dedicada a la venta de café de alta calidad, cuidadosamente seleccionado de
                        las mejores regiones cafetaleras del mundo. Nuestro objetivo es llevar a nuestros clientes un
                        producto excepcional, con un sabor auténtico y una historia detrás de cada grano.</h5>
                    <p>Es todo</p>
                    <a href="" class="btn btn-secondary font-weight-bold py-2 px-4 mt-2">Para saber más</a>
                </div>
                <div class="col-lg-4 py-5 py-lg-0" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="../img/about.png" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-4 py-0 py-lg-5">
                    <h1 class="mb-3">Nuestra visión de mercado</h1>
                    <p>Convertirnos en una marca reconocida por la calidad de nuestro café y nuestro compromiso con la
                        sostenibilidad, siendo el punto de referencia para los amantes del buen café.</p>
                    <h5 class="mb-3"><i class="fa fa-check text-primary mr-3"></i>Calidad: Nos enfocamos en ofrecer
                        productos de la más alta calidad.</h5>
                    <h5 class="mb-3"><i class="fa fa-check text-primary mr-3"></i>Transparencia: Promovemos prácticas
                        éticas y transparentes en cada paso.
                    </h5>
                    <h5 class="mb-3"><i class="fa fa-check text-primary mr-3"></i>Sostenibilidad: Apoyamos el cultivo
                        responsable y respetuoso con el medio ambiente.
                    </h5>
                    <a href="" class="btn btn-primary font-weight-bold py-2 px-4 mt-2">Más sobre nosotros</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin del apartado Sobre nosotros -->


    <!-- Servicios -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="section-title">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Nuestros servicios</h4>
                <h1 class="display-4">Grano fresco y totalmente orgánico</h1>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-5">
                    <div class="row align-items-center">
                        <div class="col-sm-5">
                            <img class="img-fluid mb-3 mb-sm-0" src="../img/service-1.jpg" alt="">
                        </div>
                        <div class="col-sm-7">
                            <h4><i class="fa fa-truck service-icon"></i>Reparto rápido e inmediato a su hogar</h4>
                            <p class="m-0">Llegamos a su hogar en un periquete</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-5">
                    <div class="row align-items-center">
                        <div class="col-sm-5">
                            <img class="img-fluid mb-3 mb-sm-0" src="../img/service-2.jpg" alt="">
                        </div>
                        <div class="col-sm-7">
                            <h4><i class="fa fa-coffee service-icon"></i>Granos de café frescos</h4>
                            <p class="m-0">Granos de café totalmente frescos y orgánicos</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-5">
                    <div class="row align-items-center">
                        <div class="col-sm-5">
                            <img class="img-fluid mb-3 mb-sm-0" src="../img/service-3.jpg" alt="">
                        </div>
                        <div class="col-sm-7">
                            <h4><i class="fa fa-award service-icon"></i>El café con la mejor calidad</h4>
                            <p class="m-0">Café rico en sabor y olor</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-5">
                    <div class="row align-items-center">
                        <div class="col-sm-5">
                            <img class="img-fluid mb-3 mb-sm-0" src="../img/service-4.jpg" alt="">
                        </div>
                        <div class="col-sm-7">
                            <h4><i class="fa fa-table service-icon"></i>Carta de servicios</h4>
                            <p class="m-0"> Ofrecemos una experiencia completa para amantes del café, desde la venta de
                                café de especialidad hasta suscripciones personalizadas, asesoría para empresas, y
                                talleres de cata. Nos enfocamos en la calidad, sostenibilidad y el comercio justo,
                                trabajando directamente con productores para brindar el mejor café en cada taza y
                                garantizar un impacto positivo en la comunidad cafetalera.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin del apartado de Servicios -->


    <!-- Oferta -->
    <div class="offer container-fluid my-5 py-5 text-center position-relative overlay-top overlay-bottom">
        <div class="container py-5">
            <h1 class="display-3 text-primary mt-3">25% de descuento</h1>
            <h1 class="text-white mb-3">Oferta especial</h1>
            <h4 class="text-white font-weight-normal mb-4 pb-3">A partir del domingo dia 1 de junio hasta el 30 de junio
                de 2025</h4>
            <form class="form-inline justify-content-center mb-4">
                <div class="input-group">
                    <input type="text" class="form-control p-4" placeholder="Correo" style="height: 60px;">
                    <div class="input-group-append">
                        <button class="btn btn-primary font-weight-bold px-4" type="submit">Suscribirse</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Fin de la oferta -->

    <!-- Comentarios -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="section-title">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Comentarios</h4>
                <h1 class="display-4">Nuestros clientes quedaron satisfechos</h1>
            </div>
            <div class="owl-carousel testimonial-carousel">
                <div class="testimonial-item">
                    <div class="d-flex align-items-center mb-3">
                        <img class="img-fluid" src="../img/testimonial-1.jpg" alt="">
                        <div class="ml-3">
                            <h4>Ana Belén</h4>
                            <i>Abogada</i>
                        </div>
                    </div>
                    <p class="m-0">El mejor café que he probado en años</p>
                </div>
                <div class="testimonial-item">
                    <div class="d-flex align-items-center mb-3">
                        <img class="img-fluid" src="../img/testimonial-2.jpg" alt="">
                        <div class="ml-3">
                            <h4>Pablo</h4>
                            <i>Oficinista</i>
                        </div>
                    </div>
                    <p class="m-0">Este café sin duda es de los mejores del mercado</p>
                </div>
                <div class="testimonial-item">
                    <div class="d-flex align-items-center mb-3">
                        <img class="img-fluid" src="../img/testimonial-3.jpg" alt="">
                        <div class="ml-3">
                            <h4>Minerva</h4>
                            <i>Psicóloga</i>
                        </div>
                    </div>
                    <p class="m-0">Realmente muy bueno y fresco</p>
                </div>
                <div class="testimonial-item">
                    <div class="d-flex align-items-center mb-3">
                        <img class="img-fluid" src="../img/testimonial-4.jpg" alt="">
                        <div class="ml-3">
                            <h4>Lorenzo</h4>
                            <i>Asesor financiero</i>
                        </div>
                    </div>
                    <p class="m-0">Es un café espléndido con un sabor único y autentico</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin del apartado de comentarios -->


    <!-- Footer -->
    <div class="container-fluid footer text-white mt-5 pt-5 px-0 position-relative overlay-top">
        <div class="row mx-0 pt-5 px-sm-3 px-lg-5 mt-4">
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Localización</h4>
                <p><i class="fa fa-map-marker-alt mr-2"></i>45 calle del grano de café, Almería, ES</p>
                <p><i class="fa fa-phone-alt mr-2"></i>+64 6328982134</p>
                <p class="m-0"><i class="fa fa-envelope mr-2"></i>algranosl@hotcoffe.com</p>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">siguenos</h4>
                <p>En nuestras redes sociales nos promocionamos y mostramos los últimos productos antes de que salgan en
                    la web</p>
                <div class="d-flex justify-content-start">
                    <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="https://www.linkedin.com/in/jos%C3%A9-mart%C3%ADnez-estrada-997b77208/?trk=people-guest_people_search-card&originalSubdomain=es"><i
                            class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-lg btn-outline-light btn-lg-square" href="https://www.instagram.com/coffe.algrano_sl/"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Horario de apertura</h4>
                <div>
                    <h6 class="text-white text-uppercase">Lunes - Sábado</h6>
                    <p>10.00 AM - 20.00 PM</p>
                    <h6 class="text-white text-uppercase">Domingo</h6>
                    <p>8.00 AM - 14.00 PM</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Boletín de noticias</h4>
                <p>Suscríbete a nuestro boletín para obtener las últimas noticias de nuestros productos</p>
                <div class="w-100">
                    <div class="input-group">
                        <input type="text" class="form-control border-light" style="padding: 25px;"
                            placeholder="Correo">
                        <div class="input-group-append">
                            <button class="btn btn-primary font-weight-bold px-3">Suscribirse</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid text-center text-white border-top mt-4 py-4 px-sm-3 px-md-5"
            style="border-color: rgba(256, 256, 256, .1) !important;">
            <p class="mb-2 text-white">Copyright &copy; <a class="font-weight-bold" href="#">Domain</a>. All Rights
                Reserved.</a></p>
            <p class="m-0 text-white">Designed by <a class="font-weight-bold"
                    href="https://github.com/Jxse111">Jxse111</a></p>
        </div>
    </div>
    <!-- Fin del Footer -->


    <!-- Flecha de vuelta a la parte superior -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- Librerias de Javascript -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/tempusdominus/js/moment.min.js"></script>
    <script src="../lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Archivo de datos de contacto de Javascript -->
    <script src="../mail/jqBootstrapValidation.min.js"></script>
    <script src="../mail/contact.js"></script>

    <!-- Plantilla de Javascript -->
    <script src="../js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <!-- Loader -->
    <div class="loader-wrapper" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(27, 18, 15, 0.95); display: flex; justify-content: center; align-items: center; z-index: 9999;">
        <div class="coffee-loader">
            <div class="coffee-cup"></div>
            <div class="coffee-steam">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <style>
        .coffee-loader {
            position: relative;
            width: 120px;
            height: 120px;
        }

        .coffee-cup {
            position: absolute;
            bottom: 0;
            width: 100px;
            height: 80px;
            border: 6px solid #DA9F5B;
            border-radius: 0 0 45px 45px;
            background: transparent;
        }

        .coffee-cup::before {
            content: '';
            position: absolute;
            right: -25px;
            top: 15px;
            width: 40px;
            height: 30px;
            border: 6px solid #DA9F5B;
            border-radius: 40px 0;
        }

        .coffee-steam span {
            position: absolute;
            background: #DA9F5B;
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .coffee-steam span:nth-child(1) {
            animation: steam 2s infinite ease-in-out;
            left: 20px;
        }

        .coffee-steam span:nth-child(2) {
            animation: steam 2s infinite ease-in-out .4s;
            left: 50px;
        }

        .coffee-steam span:nth-child(3) {
            animation: steam 2s infinite ease-in-out .8s;
            left: 80px;
        }

        @keyframes steam {
            0% {
                transform: translateY(80px) scale(0.1);
                opacity: 0;
            }

            50% {
                transform: translateY(40px) scale(1);
                opacity: 1;
            }

            100% {
                transform: translateY(0px) scale(1.5);
                opacity: 0;
            }
        }
    </style>

    <script>
        $(window).on("load", function() {
            $(".loader-wrapper").fadeOut("slow");
        });
    </script>
</body>

</html>