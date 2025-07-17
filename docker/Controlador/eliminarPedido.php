<?php
require_once '../Modelo/funcionesBaseDeDatos.php';
require_once '../Modelo/Algrano.php';
require_once '../Modelo/Pedido.php';
session_start();
//Si el usuario no es empleado, lo redirigimos a la página de inicio
if ($_SESSION['rol'] != "empleado") {
    header("location: ../Vista/index.php");
}
//Comprobamos si se ha pasado el id del pedido a eliminar
if (filter_has_var(INPUT_GET, "id")) {
    $conexionBD = Algrano::conectarAlgranoMySQLi();
    $codigoPedido = filter_input(INPUT_GET, 'id');
    //Si el pedido se ha podido eliminar, se eliminan los detalles del pedido
    if (Pedido::eliminarPedido($codigoPedido) && Pedido::eliminarPedidoDetallado($codigoPedido)) {
        header("location: ../Vista/areaEmpleado.php?success=Pedido eliminado con éxito.");
        exit;
    } else {
        header('Location: ../Vista/areaEmpleado.php?error=ERROR:No se ha podido eliminar el pedido.');
    }
} else {
    header('Location: ../Vista/areaEmpleado.php?error=ERROR:Pedido no encontrado en el sistema.');
}
