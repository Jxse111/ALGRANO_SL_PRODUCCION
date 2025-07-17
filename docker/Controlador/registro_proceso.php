<?php
require_once './funcionesValidacion.php';
require_once '../Modelo/funcionesBaseDeDatos.php';
require_once '../Modelo/Algrano.php';
require_once '../Modelo/Usuario.php';
// Creación de la conexión
$conexionBD = Algrano::conectarAlgranoMySQLi();
if (filter_has_var(INPUT_POST, "crearCuenta")) {
    try {
        // Validación de los datos recogidos
        $dniValidado = validarDNI(filter_input(INPUT_POST, "DNI"));
        $usuarioValidado = validarUsuario(filter_input(INPUT_POST, "usuario"), $conexionBD);
        $contraseñaValidada = validarContraseña(filter_input(INPUT_POST, "contraseña"), $conexionBD);
        $direcciónValidada = validarDireccion(filter_input(INPUT_POST, "direccion"), $conexionBD);
        $correoValidado = validarCorreo(filter_input(INPUT_POST, "correo"), $conexionBD);
        $fechaNacimientoValidada = validarFechaNacimiento(filter_input(INPUT_POST, "fec_nac"), $conexionBD);
        $camposValidados = $dniValidado && $usuarioValidado && $contraseñaValidada && $direcciónValidada && $correoValidado && $fechaNacimientoValidada;
        //echo var_dump($dniValidado, $usuarioValidado, $contraseñaValidada, $direcciónValidada, $correoValidado, $fechaNacimientoValidada);

        if ($camposValidados) {
            $usuarioRegistro = new Usuario($dniValidado, $usuarioValidado, $contraseñaValidada, $direcciónValidada, $correoValidado, $fechaNacimientoValidada);
            //print_r($usuarioRegistro);
            if ($usuarioRegistro->guardarUsuario()) {
                header("Location: ../Vista/login.html");
                exit;
            } else {
                header("Location: ../ERRORES/ERROR_REGISTRO.html");
            }
        } else {
            header("Location: ../ERRORES/ERROR_DATOS_INCORRECTOS.html");
        }
    } catch (Exception $ex) {
        header("Location: ../ERRORES/ERROR_CONEXION.html");
        $conexionBD->close();
    }
}
