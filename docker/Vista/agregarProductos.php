<?php
session_start();
if ($_SESSION['rol'] != "empleado") {
    header("location: ../Vista/index.php");
}
require_once '../Modelo/Producto.php';
require_once '../Modelo/Algrano.php';
if (filter_has_var(INPUT_POST, 'añadirProducto')) {
    $idProducto = filter_input(INPUT_POST, 'idAñadido');
    $nombreProducto = filter_input(INPUT_POST, 'nombreAñadido');
    $precioProducto = filter_input(INPUT_POST, 'precioAñadido');
    $tipoProducto = filter_input(INPUT_POST, 'tipoAñadido');
    $descripcionProducto = filter_input(INPUT_POST, 'descripcionAñadido');
    $stockProducto = filter_input(INPUT_POST, 'stockAñadido');
    $idProductoDetallado = filter_input(INPUT_GET, 'id');
    $fechaCreacionProducto = filter_input(INPUT_POST, 'fechaAñadido') ?: date('Y-m-d');
    $origenProducto = filter_input(INPUT_POST, 'origenAñadido');
    $imagenProducto = filter_input(INPUT_POST, 'imagenAñadido') ?: '../img/Productos/default.jpg';
    $producto = new Producto($idProducto, $nombreProducto, $descripcionProducto, $fechaCreacionProducto, $origenProducto, $precioProducto, $imagenProducto, $stockProducto, $tipoProducto);
    $producto->crearProducto();
    header("location: ../Vista/areaEmpleado.php");
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

    <!-- Hoja de estilos para las librerias -->
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Hoja de estilos personalizada para Bootstrap -->
    <link href="../css/style.min.css" rel="stylesheet">

    <style>
        /* Estilos para el formulario */
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }

        .page-header {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 80px 0;
            margin-bottom: 50px;
        }

        .contact-form {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .section-title h4 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 400;
            color: #007bff;
            letter-spacing: 5px;
        }

        .form-control {
            margin-bottom: 15px;
        }

        .btn-primary {
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <!-- Barra de navegación -->
    <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
            <a href="index.php" class="navbar-brand px-lg-4 m-0">
                <img src="../img/ALGRANO.png" alt="" height="80" width="80">
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>
    </div>
    <!-- Fin de la barra de navegación -->

    <!-- Cabecera -->
    <div class="container-fluid page-header mb-5">
        <h1 class="display-4 mb-3 mt-0 text-white text-uppercase">FORMULARIO PARA AÑADIR PRODUCTOS</h1>
    </div>
    <!-- Fin de la cabecera -->

    <!-- Agregar productos nuevos -->
    <div class="contact-form">
        <div class="section-title">
            <h4 class="text-primary text-uppercase">PRODUCTO NUEVO</h4>
        </div>
        <form name="sentMessage" id="contactForm" novalidate="novalidate" method="POST">
            <h6 class="text-primary font-weight-bold mb-2">Código del Producto</h6>
            <div class="control-group">
                <input type="text" class="form-control" name="idAñadido"
                    placeholder="PROD00X" />
                <p class="help-block text-danger"></p>
            </div>
            <h6 class="text-primary font-weight-bold mb-2">Nombre del producto</h6>
            <div class="control-group">
                <input type="text" class="form-control" name="nombreAñadido"
                    placeholder="Nombre del producto" />
                <p class="help-block text-danger"></p>
            </div>
            <h6 class="text-primary font-weight-bold mb-2">Precio unitario</h6>
            <div class="control-group">
                <input type="number" class="form-control" name="precioAñadido"
                    placeholder="Precio unitario" />
                <p class="help-block text-danger"></p>
            </div>
            <h6 class="text-primary font-weight-bold mb-2">Tipo de producto</h6>
            <div class="control-group">
                <input type="text" class="form-control" name="tipoAñadido"
                    placeholder="tipo" />
                <p class="help-block text-danger"></p>
            </div>
            <h6 class="text-primary font-weight-bold mb-2">Descripción</h6>
            <div class="control-group">
                <input type="text" class="form-control" name="descripcionAñadido"
                    placeholder="Descripcion" />
                <p class="help-block text-danger"></p>
            </div>
            <h6 class="text-primary font-weight-bold mb-2">Stock disponible</h6>
            <div class="control-group">
                <input type="number" class="form-control" name="stockAñadido"
                    placeholder="Cantidad del producto" />
                <p class="help-block text-danger"></p>
            </div>
            <h6 class="text-primary font-weight-bold mb-2">Fecha de creación</h6>
            <div class="control-group">
                <input type="text" class="form-control" name="fechaAñadido"
                    placeholder="Fecha de creación" />
                <p class="help-block text-danger"></p>
            </div>
            <h6 class="text-primary font-weight-bold mb-2">Origen</h6>
            <div class="control-group">
                <input type="text" class="form-control" name="origenAñadido"
                    placeholder="Origen" />
                <p class="help-block text-danger"></p>
            </div>
            <h6 class="text-primary font-weight-bold mb-2">Ruta de la imagen</h6>
            <div class="control-group">
                <input type="text" class="form-control" name="imagenAñadido"
                    placeholder="Ruta de la imagen (ej: ../img/Productos/cafe-arabica.jpg)" />
                <p class="help-block text-danger"></p>
            </div>
            <div>
                <button class="btn btn-primary font-weight-bold py-3 px-5" type="submit" id="entrar"
                    name="añadirProducto">Añadir nuevo producto</button>
            </div>
            <a href="../Vista/areaEmpleado.php" class="btn btn-secondary font-weight-bold py-2 px-4 mt-2">Volver al
                panel
                de administración de productos</a>
        </form>
    </div>
    <!-- Fin del formulario para agregar productos -->
</body>

</html>