<?php
require_once 'patrones.php';

/**
 * Método que cierra la conexión con la base de datos mediante PDO
 * @param string $codigo codigo del cliente a comprobar
 * @param object $conexionBD Objeto de conexión a la base de datos
 * @return boolean Devuelve el objeto con la conexión cerrada
 */
function noExisteCodigoCliente($codigo, $conexionBD)
{
    $codigoNoExiste = false;
    $consultaCodigosExistentes = $conexionBD->query('SELECT codigo FROM cliente');
    $codigos = $consultaCodigosExistentes->fetch_all(MYSQLI_ASSOC);
    foreach ($codigos as $codigoExistente) {
        if ($codigoExistente['codigo'] != $codigo) {
            $codigoNoExiste = true;
        }
    }
    return $codigoNoExiste ? true : false;
}
/**
 * Método que verifica que no existe un usuario en la base de datos
 * @param string $dni DNI del usuario
 * @param object $conexionBD Objeto de conexión a la base de datos
 * @return boolean Devuelve true si el usuario no existe, false si existe
 */
function noExisteUsuario($dni, $conexionBD)
{
    $usuarioNoExiste = false;

    $consultaUsuariosExistentes = $conexionBD->query("SELECT DNI FROM usuario");
    $usuarios = $consultaUsuariosExistentes->fetch_all(MYSQLI_ASSOC);
    foreach ($usuarios as $usuarioExistente) {
        if ($usuarioExistente['DNI'] != $dni) {
            $usuarioNoExiste = true;
        }
    }
    return $usuarioNoExiste ? true : false;
}
/**
 * Metodo que verifica si no existe una contraseña en la base de datos
 * @param string $contraseña Contraseña del usuario
 * @param object $conexionBD Objeto de conexión a la base de datos
 * @return boolean Devuelve true si la contraseña no existe, false si existe
 */
function noExisteContraseña($contraseña, $conexionBD)
{
    $contraseñaNoExiste = false;
    $consultaContraseñasExistentes = $conexionBD->query("SELECT contraseña FROM usuario");
    $contraseñas = $consultaContraseñasExistentes->fetch_all(MYSQLI_ASSOC);
    foreach ($contraseñas as $constraseñasExistentes) {
        if ($constraseñasExistentes['contraseña'] != $contraseña) {
            $contraseñaNoExiste = true;
        }
    }
    return $contraseñaNoExiste ? true : false;
}
/**
 * Método que verifica que no existe un correo en la base de datos
 * @param mixed $correo correo del usuario
 * @param mixed $conexionBD Objeto de conexión a la base de datos
 * @return bool Devuelve true si el correo no existe, false si existe
 */
function noExisteCorreo($correo, $conexionBD)
{
    $correoNoExiste = false;
    $consultaCorreosExistentes = $conexionBD->query('SELECT correo FROM usuario');
    $correos = $consultaCorreosExistentes->fetch_all(MYSQLI_ASSOC);
    foreach ($correos as $correoExistente) {
        if ($correoExistente['correo'] != $correo) {
            $correoNoExiste = true;
        }
    }
    return $correoNoExiste ? true : false;
}
/**
 * Método que verifica que no existe una dirección en la base de datos
 * @param mixed $direccion direccion del usuario
 * @param mixed $conexionBD Objeto de conexión a la base de datos
 * @return bool Devuelve true si la dirección no existe, false si existe
 */
function noExisteDireccion($direccion, $conexionBD)
{
    $direccionNoExiste = false;
    $consultaDireccionesExistentes = $conexionBD->query('SELECT direccion FROM usuario');
    $direcciones = $consultaDireccionesExistentes->fetch_all(MYSQLI_ASSOC);
    foreach ($direcciones as $direccionExistente) {
        if ($direccionExistente['direccion'] != $direccion) {
            $direccionNoExiste = true;
        }
    }
    return $direccionNoExiste ? true : false;
}
/**
 * Método que verifica que no existe una fecha de nacimiento en la base de datos
 * @param mixed $fecha fecha de nacimiento del usuario
 * @param mixed $conexionBD Objeto de conexión a la base de datos
 * @return bool Devuelve true si la fecha no existe, false si existe
 */
function noExisteFechaNacimiento($fecha, $conexionBD)
{
    $fechaNoExiste = false;
    $consultaFechasExistentes = $conexionBD->query('SELECT fec_nac FROM usuario');
    $fechas = $consultaFechasExistentes->fetch_all(MYSQLI_ASSOC);
    foreach ($fechas as $fechaExistente) {
        if ($fechaExistente['fec_nac'] != $fecha) {
            $fechaNoExiste = true;
        }
    }
    return $fechaNoExiste ? true : false;
}
/**
 * Método que verifica si existe un usuario en la base de datos
 * @param string $usuario Nombre de usuario
 * @param object $conexionBD Objeto de conexión a la base de datos
 * @return boolean Devuelve true si el usuario existe, false si no existe
 */
function existeUsuario($usuario, $conexionBD)
{
    $usuarioNoExiste = false;
    $consultaUsuariosExistentes = $conexionBD->query("SELECT usuario FROM usuario");
    $usuarios = $consultaUsuariosExistentes->fetch_all(MYSQLI_ASSOC);
    foreach ($usuarios as $usuarioExistente) {
        if ($usuarioExistente['usuario'] == $usuario) {
            $usuarioNoExiste = true;
        }
    }
    return $usuarioNoExiste ? true : false;
}
/**
 * Método que verifica si existe un DNI en la base de datos
 * @param string $dni DNI del usuario a verificar
 * @param object $conexionBD Objeto de conexión a la base de datos
 * @return bool Devuelve true si el DNI existe, false si no existe
 */
function existeDni($dni, $conexionBD)
{
    $usuarioNoExiste = false;
    $consultaUsuariosExistentes = $conexionBD->query("SELECT DNI FROM usuario");
    $usuarios = $consultaUsuariosExistentes->fetch_all(MYSQLI_ASSOC);
    foreach ($usuarios as $usuarioExistente) {
        if ($usuarioExistente['DNI'] == $dni) {
            $usuarioNoExiste = true;
        }
    }
    return $usuarioNoExiste ? true : false;
}
/**
 * Método que verifica si existe una contraseña en la base de datos
 * @param string $contraseña Contraseña del usuario
 * @param object $conexionBD Objeto de conexión a la base de datos
 * @return bool Devuelve true si la contraseña existe, false si no existe
 */
function existeContraseña($contraseña, $conexionBD)
{
    $contraseñaNoExiste = false;
    $consultaContraseñasExistentes = $conexionBD->query("SELECT contraseña FROM usuario");
    $contraseñas = $consultaContraseñasExistentes->fetch_all(MYSQLI_ASSOC);
    foreach ($contraseñas as $constraseñasExistentes) {
        if ($constraseñasExistentes['contraseña'] == $contraseña) {
            $contraseñaNoExiste = true;
        }
    }
    return $contraseñaNoExiste ? true : false;
}
/**
 * Método que verifica que no existe un producto en la base de datos
 * @param mixed $idProducto ID del producto
 * @param mixed $conexionBD Objeto de conexión a la base de datos
 * @return bool Devuelve true si el producto no existe, false si existe
 */
function noExisteProducto($idProducto, $conexionBD)
{
    $productoNoExiste = false;
    $consultaProductosExistentes = $conexionBD->query("SELECT id_producto FROM producto");
    $productos = $consultaProductosExistentes->fetch_all(MYSQLI_ASSOC);
    foreach ($productos as $productoExistente) {
        if ($productoExistente['id_producto'] != $idProducto) {
            $productoNoExiste = true;
        }
    }
    return $productoNoExiste ? true : false;
}
/**
 * Método que verifica que existe un producto en la base de datos
 * @param mixed $idProducto ID del producto
 * @param mixed $conexionBD Objeto de conexión a la base de datos
 * @return bool Devuelve true si el producto existe, false si no existe
 */
function existeProducto($idProducto, $conexionBD)
{
    $productoExiste = false;
    $consultaProductosExistentes = $conexionBD->query("SELECT id_producto FROM producto");
    $productos = $consultaProductosExistentes->fetch_all(MYSQLI_ASSOC);
    foreach ($productos as $producto) {
        if ($producto['id_producto'] == $idProducto) {
            $productoExiste = true;
        }
    }
    return $productoExiste ? true : false;
}
/**
 * Método que verifica que existe un pedido en la base de datos
 * @param mixed $codigoPedido Código del pedido
 * @param mixed $conexionBD Objeto de conexión a la base de datos
 * @return bool Devuelve true si el pedido existe, false si no existe
 */
function existePedido($codigoPedido, $conexionBD)
{
    $pedidoExiste = false;
    $consultaPedidosExistentes = $conexionBD->query("SELECT codigo_pedido FROM pedido");
    $pedidos = $consultaPedidosExistentes->fetch_all(MYSQLI_ASSOC);
    foreach ($pedidos as $pedido) {
        if ($pedido['codigo_pedido'] == $codigoPedido) {
            $pedidoExiste = true;
        }
    }
    return $pedidoExiste ? true : false;
}
/**
 * Método que verifica que existe un producto detalle en la base de datos
 * @param mixed $idProducto ID del producto detalle
 * @param mixed $conexionBD Objeto de conexión a la base de datos
 * @return bool Devuelve true si el producto detalle existe, false si no existe
 */
function existeProductoDetalle($idProducto, $conexionBD)
{
    $productoExiste = false;
    $consultaProductosExistentes = $conexionBD->query("SELECT id_productos_detalle FROM producto");
    $productos = $consultaProductosExistentes->fetch_all(MYSQLI_ASSOC);
    foreach ($productos as $producto) {
        if ($producto['id_producto_detalle'] == $idProducto) {
            $productoExiste = true;
        }
    }
    return $productoExiste ? true : false;
}
