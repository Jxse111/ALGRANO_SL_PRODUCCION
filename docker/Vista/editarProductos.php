<?php
session_start();
if ($_SESSION['rol'] != "empleado") {
    header("location: ../Vista/index.php");
}
require_once '../Modelo/Producto.php';
require_once '../Modelo/Algrano.php';
$productoSinEditar = Producto::buscarProducto(filter_input(INPUT_GET, 'id'));
$productoDetalladoSinEditar = Producto::buscarProductoDetallado(filter_input(INPUT_GET, 'id'));

if (filter_has_var(INPUT_POST, 'modificarProducto')) {
    $nombreProducto = filter_input(INPUT_POST, 'nombreEditado') ?: $productoSinEditar[0]['nombre'];
    $precioProducto = filter_input(INPUT_POST, 'precioEditado') ?: $productoSinEditar[0]['precio_ud'];
    $tipoProducto = filter_input(INPUT_POST, 'tipoEditado') ?: $productoDetalladoSinEditar[0]['tipo'];
    $descripcionProducto = filter_input(INPUT_POST, 'descripcionEditada') ?: $productoDetalladoSinEditar[0]['descripcion'];
    $stockProducto = filter_input(INPUT_POST, 'stockEditado') ?: $productoDetalladoSinEditar[0]['stock'];
    $idProductoDetallado = filter_input(INPUT_GET, 'id');
    $fechaCreacionProducto = filter_input(INPUT_POST, 'fechaEditada') ?: $productoDetalladoSinEditar[0]['fecha_creacion'];
    $origenProducto = filter_input(INPUT_POST, 'origenEditado') ?: $productoDetalladoSinEditar[0]['origen'];
    $imagenProducto = filter_input(INPUT_POST, 'imagenEditada') ?: $productoSinEditar[0]['imagen'];
    $producto = new Producto($idProductoDetallado, $nombreProducto, $descripcionProducto, $fechaCreacionProducto, $origenProducto, $precioProducto, $imagenProducto, $stockProducto, $tipoProducto);
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

    <!-- Hija de estilos para las librerias -->
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Hoja de estilos personalizada para Bootstrap -->
    <link href="../css/style.min.css" rel="stylesheet">

    <style>
        /* Estilos para el formulario*/
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
        <h1 class="display-4 mb-3 mt-0 text-white text-uppercase">FORMULARIO DE EDICIÓN DE PRODUCTOS</h1>
    </div>
    <!-- Fin de la cabecera -->

    <!-- Formulario de edición de productos  -->
    <div class="contact-form">
        <div class="section-title">
            <h4 class="text-primary text-uppercase">PRODUCTO CON CÓDIGO <?php echo filter_input(INPUT_GET, 'id') ?></h4>
        </div>
        <?php
        foreach ($productoSinEditar as $producto) {
            foreach ($productoDetalladoSinEditar as $productoDetallado) ?>
            <form name="sentMessage" id="contactForm" novalidate="novalidate" method="POST">
                <h6 class="text-primary font-weight-bold mb-2">Nombre</h6>
                <div class="control-group">
                    <input type="text" class="form-control" name="nombreEditado"
                        placeholder="<?php echo $producto['nombre'] ?>" />
                    <p class="help-block text-danger"></p>
                </div>
                <h6 class="text-primary font-weight-bold mb-2">Precio unitario</h6>
                <div class="control-group">
                    <input type="number" class="form-control" name="precioEditado"
                        placeholder="<?php echo $producto['precio_ud'] ?> €" />
                    <p class="help-block text-danger"></p>
                </div>
                <h6 class="text-primary font-weight-bold mb-2">Tipo</h6>
                <div class="control-group">
                    <input type="text" class="form-control" name="tipoEditado"
                        placeholder="<?php echo $productoDetallado['tipo'] ?>" />
                    <p class="help-block text-danger"></p>
                </div>
                <h6 class="text-primary font-weight-bold mb-2">Descripción</h6>
                <div class="control-group">
                    <input type="text" class="form-control" name="descripcionEditada"
                        placeholder="<?php echo $productoDetallado['descripcion'] ?>" />
                    <p class="help-block text-danger"></p>
                </div>
                <h6 class="text-primary font-weight-bold mb-2">Stock disponible</h6>
                <div class="control-group">
                    <input type="number" class="form-control" name="stockEditado"
                        placeholder="<?php echo $productoDetallado['stock'] ?>  paquete/s" />
                    <p class="help-block text-danger"></p>
                </div>
                <h6 class="text-primary font-weight-bold mb-2">Fecha de creación</h6>
                <div class="control-group">
                    <input type="text" class="form-control" name="fechaEditada"
                        placeholder="<?php echo $productoDetallado['fecha_creacion'] ?>" />
                    <p class="help-block text-danger"></p>
                </div>
                <h6 class="text-primary font-weight-bold mb-2">Origen</h6>
                <div class="control-group">
                    <input type="text" class="form-control" name="origenEditado"
                        placeholder="<?php echo $productoDetallado['origen'] ?>" />
                    <p class="help-block text-danger"></p>
                </div>
                <h6 class="text-primary font-weight-bold mb-2">Ruta de la imagen</h6>
            <div class="control-group">
                <input type="text" class="form-control" name="imagenEditada"
                    placeholder="Ruta de la imagen (ej: ../img/Productos/cafe-arabica.jpg)" />
                <p class="help-block text-danger"></p>
            </div>
                <div>
                    <button class="btn btn-primary font-weight-bold py-3 px-5" type="submit" id="entrar"
                        name="modificarProducto">Modificar producto</button>
                </div>
                <a href="../Vista/areaEmpleado.php" class="btn btn-secondary font-weight-bold py-2 px-4 mt-2">Volver al
                    panel
                    de administración de productos</a>
            </form>
        <?php } ?>
    </div>
    <!-- Fin del formulario de edición de productos -->
</body>

</html>