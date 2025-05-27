<?php
session_start();
if ($_SESSION['rol'] != "empleado") {
    header("location: ../Vista/index.php");
}
require_once '../Modelo/Pedido.php';
require_once '../Modelo/Algrano.php';
$pedidoSinEditar = Pedido::obtenerPedidosPorCodigo(filter_input(INPUT_GET, 'id'));
$pedidoDetalladoSinEditar = Pedido::obtenerPedidosDetalle(filter_input(INPUT_GET, 'id'));

if (filter_has_var(INPUT_POST, 'modificarPedido')) {
    $codigoPedido = $pedidoSinEditar[0]['codigo_pedido'];
    $codigoPedidoDetalle = $pedidoDetalladoSinEditar[0]['codigo_detalle'];
    $dniCliente = $pedidoSinEditar[0]['DNI_cliente'];
    $idProducto = $pedidoDetalladoSinEditar[0]['id_producto_pedido'];
    $tipoPedido = $pedidoDetalladoSinEditar[0]['tipo'];
    $precioPedido = filter_input(INPUT_POST, 'precioEditado') ?: $pedidoSinEditar[0]['precio_total'];
    $fechaPedido = filter_input(INPUT_POST, 'fechaEditada') ?: $pedidoSinEditar[0]['fecha_pedido'];
    $estadoPedido = filter_input(INPUT_POST, 'estadoEditado') ?: $pedidoSinEditar[0]['estado'];
    $subtotalPedido = filter_input(INPUT_POST, 'subtotalEditado') ?: $pedidoDetalladoSinEditar[0]['subtotal'];
    $cantidadPedido = filter_input(INPUT_GET, 'cantidadEditada') ?: $pedidoDetalladoSinEditar[0]['cantidad_descrita'];
    $pedidoRealizado = new Pedido($codigoPedido, $dniCliente, $idProducto, $tipoPedido, $precioPedido, $fechaPedido, $estadoPedido, $codigoPedidoDetalle, $subtotalPedido, $cantidadPedido);
    $pedidoRealizado->crearPedido();
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
        <h1 class="display-4 mb-3 mt-0 text-white text-uppercase">FORMULARIO DE EDICIÓN DE PEDIDOS</h1>
    </div>
    <!-- Fin de la cabecera -->

    <!-- Formulario de edición de pedidos -->
    <div class="contact-form">
        <div class="section-title">
            <h4 class="text-primary text-uppercase">PEDIDO CON CÓDIGO <?php echo filter_input(INPUT_GET, 'id') ?></h4>
        </div>
        <?php
        foreach ($pedidoSinEditar as $pedido) {
            foreach ($pedidoDetalladoSinEditar as $pedidoDetallado) ?>
            <form name="sentMessage" id="contactForm" novalidate="novalidate" method="POST">
                <h6 class="text-primary font-weight-bold mb-2">Fecha del pedido</h6>
                <div class="control-group">
                    <input type="text" class="form-control" name="fechaEditada"
                        placeholder="<?php echo $pedido['fecha_pedido'] ?>" />
                    <p class="help-block text-danger"></p>
                </div>
                <h6 class="text-primary font-weight-bold mb-2">Estado del pedido</h6>
                <div class="control-group">
                    <select class="form-control" name="estadoEditado">
                        <option value="<?php echo $pedido['estado'] ?>"><?php echo $pedido['estado'] ?></option>
                        <option value="Pendiente">Pendiente</option>
                        <option value="Pagado">Pagado</option>
                        <option value="Enviado">Enviado</option>
                        <option value="Entregado">Entregado</option>
                        <option value="Cancelado">Cancelado</option>
                    </select>
                    <p class="help-block text-danger"></p>
                </div>
                <h6 class="text-primary font-weight-bold mb-2">Cantidad</h6>
                <div class="control-group">
                    <input type="text" class="form-control" name="cantidadEditada"
                        placeholder="<?php echo $pedidoDetallado['cantidad_descrita'] ?>" />
                    <p class="help-block text-danger"></p>
                </div>
                <h6 class="text-primary font-weight-bold mb-2">Subtotal</h6>
                <div class="control-group">
                    <input type="number" class="form-control" name="subtotalEditado"
                        placeholder="<?php echo $pedidoDetallado['subtotal'] ?> €" />
                    <p class="help-block text-danger"></p>
                </div>
                <h6 class="text-primary font-weight-bold mb-2">Precio Total del pedido</h6>
                <div class="control-group">
                    <input type="number" class="form-control" name="precioEditado"
                        placeholder="<?php echo $pedido['precio_total'] ?> €" />
                    <p class="help-block text-danger"></p>
                </div>
                <div>
                    <button class="btn btn-primary font-weight-bold py-3 px-5" type="submit" id="entrar"
                        name="modificarPedido">Modificar pedido</button>
                </div>
                <a href="../Vista/areaEmpleado.php" class="btn btn-secondary font-weight-bold py-2 px-4 mt-2">Volver al
                    panel
                    de administración de pedidos</a>
            </form>
        <?php } ?>
    </div>
    <!-- Fin del Formulario de edición de pedidos -->
</body>

</html>