<?php
require_once '../Modelo/funcionesBaseDeDatos.php';
require_once '../Modelo/Algrano.php';
require_once '../Modelo/Producto.php';
session_start();
// Si el usuario no es empleado, lo redirigimos a la página de inicio
if ($_SESSION['rol'] != "empleado") {
    header("location: ../Vista/index.php");
}
// Comprobamos si se ha pasado el id del producto a eliminar
if (filter_has_var(INPUT_GET, "id")) {
    $conexionBD = Algrano::conectarAlgranoMySQLi();
    $codigoProducto = filter_input(INPUT_GET, 'id');
    //Si el producto se ha podido eliminar, se eliminan los detalles del producto
    if (Producto::eliminarProducto($codigoProducto) && Producto::eliminarProductoDetallado($codigoProducto)) {
        header("location: ../Vista/areaEmpleado.php?success=Producto eliminado con éxito.");
        exit;
    } else {
        header(header: "location: ../Vista/areaEmpleado.php?error=ERROR:El producto no se ha podido eliminar.");
    }
} else {
    header(header: "location: ../Vista/areaEmpleado.php?error=ERROR:Producto no encontrado en el sistema.");
}
