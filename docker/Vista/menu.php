<?php
session_start();
require_once '../Modelo/Producto.php';
$productos = Producto::listarProductos(); // Obtiene los productos  
$productosDetallados = Producto::listarProductosDetallados(); // Obtiene los productos detallados
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

    <!-- Hojas de estilo de las librerias -->
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Hoja de estilo Bootstrap personalizada -->
    <link href="../css/style.min.css" rel="stylesheet">
</head>

<body>
    <!-- Barra de navegación -->
    <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
            <a href="index.php" class="navbar-brand px-lg-4 m-0">
                <h1 class="m-0 display-4 text-uppercase text-white"><img src="../img/ALGRANO.png" alt="" height="80"
                        width="80"></h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav ml-auto p-4">
                    <a href="index.php" class="nav-item nav-link active">Inicio</a>
                    <a href="sobreNosotros.php" class="nav-item nav-link">Sobre nosotros</a>
                    <a href="servicios.php" class="nav-item nav-link">Servicios</a>
                    <a href="contacto.php" class="nav-item nav-link">Contacto</a>
                    <a href="comentarios.php" class="nav-item nav-link">Testimonio</a>

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
                <?php if ($_SESSION['rol'] == "administrador" || $_SESSION['rol'] == "empleado" || $_SESSION['rol'] == "cliente") { ?>
                    <div class="nav-item dropdown">
                        <img src="../img/profilePic.png" class="nav-link dropdown-toggle" data-toggle="dropdown"
                            alt="Mi Cuenta" style="width: 100px; height: 80px; border-radius: 50%; margin-right: 20px;">
                        <div class="dropdown-menu text-capitalize"
                            style="background-color:rgba(27, 18, 15, 0.8); backdrop-filter: blur(8px); border-radius: 10px; left: -30px;">

                            <a href="perfil.php" class="dropdown-item" style="color: #DA9F5B;">Perfil</a>
                            <?php if ($_SESSION['rol'] == "administrador") { ?>
                                <a href="areaAdmin.php" class="dropdown-item" style="color: #DA9F5B" ;>Administrar</a>
                                <a href="../Controlador/cerrarSesion_proceso.php" class="dropdown-item"
                                    style="color: #DA9F5B;">Cerrar sesión</a>
                            <?php } elseif ($_SESSION['rol'] == "empleado") { ?>
                                <a href="areaEmpleado.php" class="dropdown-item" style="color: #DA9F5B" ;>Área Empleado</a>
                                <a href="../Controlador/cerrarSesion_proceso.php" class="dropdown-item"
                                    style="color: #DA9F5B;">Cerrar sesión</a>
                            <?php } elseif ($_SESSION['rol'] == "cliente") { ?>
                                <a href="pedidos.php" class="dropdown-item" style="color: #DA9F5B" ;>Mis pedidos</a>
                                <a href="../Controlador/cerrarSesion_proceso.php" class="dropdown-item"
                                    style="color: #DA9F5B;">Cerrar sesión</a>
                        </div>
                    </div>
            <?php }
                        } ?>
            </div>
        </nav>
    </div>
    <!-- Fin de la barra de navegación -->


    <!-- Cabecera -->
    <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5"
            style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Cátalogo</h1>
            <div class="d-inline-flex mb-lg-5">
                <p class="m-0 text-white"><a class="text-white" href="index.php">Inicio</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white">Cátalogo de productos</p>
            </div>
        </div>
    </div>
    <!-- Fin de la cabecera -->


    <!-- Catálogo de Productos -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Catálogo de Productos</h2>
        <div class="row">
            <?php foreach ($productos as $producto) { ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <?php $imagenProducto = !empty($producto['imagen']) ? $producto['imagen'] : "../img/Productos/default.jpg";
                        ?>
                        <img src="<?php echo $imagenProducto; ?>"
                            class="card-img-top" alt="<?php echo ($producto['nombre']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo ($producto['nombre']); ?></h5>
                            <?php
                            // Buscar la descripción correspondiente al producto actual
                            $descripcion = '';
                            foreach ($productosDetallados as $productoDetallado) {
                                if ($productoDetallado['id_producto_detalle'] == $producto['id_producto']) {
                                    $descripcion = $productoDetallado['descripcion'];
                                    break;
                                }
                            }
                            ?>
                            <p class="card-text"><?php echo ($descripcion); ?></p>
                            <?php if ($_SESSION['rol'] == "cliente") { ?>
                                <p class="card-text"><strong>Precio:
                                        €<?php echo number_format($producto['precio_ud'], 2); ?></strong></p>
                                <a href="detalleProducto.php?id=<?php echo $producto['id_producto']; ?>"
                                    class="btn btn-secondary">Ver
                                    Detalles</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <!-- Fin del Catálogo de Productos -->


    <!-- Footer -->
    <div class="container-fluid footer text-white mt-5 pt-5 px-0 position-relative overlay-top">
        <div class="row mx-0 pt-5 px-sm-3 px-lg-5 mt-4">
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Localización</h4>
                <p><i class="fa fa-map-marker-alt mr-2"></i>45 calle del grano de café, Almería, ES</p>
                <p><i class="fa fa-phone-alt mr-2"></i>+64 8988982134</p>
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


    <!-- Flecha para volver a la parte superior -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- Librerias de Javascript-->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/tempusdominus/js/moment.min.js"></script>
    <script src="../lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Archivo de contacto de Javascript-->
    <script src="../mail/jqBootstrapValidation.min.js"></script>
    <script src="../mail/contact.js"></script>

    <!-- Plantilla de Javascript -->
    <script src="../js/main.js"></script>
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