<?php
require_once '../Modelo/Producto.php';
session_start();
//Si el usuario no es cliente, lo redirigimos a la página de inicio
if ($_SESSION['rol'] != 'cliente') {
    header('Location: /ALGRANO_SL_PROCESO_MVC/index.php?error=No tienes permisos para acceder a esta página.');
    exit;
} else {
    $codigoProducto = filter_input(INPUT_POST, 'producto_id');
    if (isset($codigoProducto)) {
        // Agregamos el producto a la cesta con su cantidad correspondiente
        $_SESSION['cesta'] = $codigoProducto;
        $_SESSION['cantidad'] = filter_input(INPUT_POST, 'cantidad', FILTER_VALIDATE_INT);
        header('Location: ../Vista/carrito.php?success=Producto añadido al carrito con éxito.');
    } else {
        header('Location: ../Vista/menu.php?error=Error al añadir un producto al carrito de la compra.');
    }
}
