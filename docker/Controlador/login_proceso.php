<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once './funcionesValidacion.php';
require_once '../Modelo/funcionesBaseDeDatos.php';
require_once '../Modelo/Algrano.php';
require_once '../Modelo/Usuario.php';
//Comprobamos que el usuario no está logueado
if (filter_has_var(INPUT_POST, "entrar") || filter_has_var(INPUT_POST, "entrar")) {
    if (isset($_SESSION['cliente'])) {
        header("Location: ../Vista/index.php");
        exit();
    } else {
        $conexionBD = Algrano::conectarAlgranoMySQLi();
        if (!$conexionBD) {
            header("Location: ../ERRORES/ERROR_CONEXION.html");
            exit();
        } else {
            try {
                $usuarioLogin = filter_input(INPUT_POST, "usuarioExistente");
                if (empty($usuarioLogin)) {
                    header("Location: ../ERRORES/ERROR_DATOS_INCORRECTOS.html");
                    exit();
                } else {
                    //Validamos el usuario existente con la base de datos
                    $usuarioLogin = validarUsuarioExistente($usuarioLogin, $conexionBD);
                    if ($usuarioLogin) {
                        $conexionBD->autocommit(false);
                        // Comprobamos si el usuario existe y extraemos su contraseña
                        $consultaSesiones = $conexionBD->query("SELECT contraseña FROM usuario WHERE usuario='$usuarioLogin'");
                        if ($consultaSesiones && $consultaSesiones->num_rows > 0) {
                            $contraseña = $consultaSesiones->fetch_all(MYSQLI_ASSOC);
                            foreach ($contraseña as $contraseñaExistente) {
                                // Comprobamos si la contraseña es correcta
                                $contraseñaEncriptada = hash("sha512", filter_input(INPUT_POST, "contraseñaExistente"));
                                $esValida = $contraseñaEncriptada === $contraseñaExistente['contraseña'];
                                if ($esValida) {
                                    //Si la contraseña es correcta, creamos la sesion con el nombre de usuario
                                    $_SESSION['usuario'] = $usuarioLogin;
                                    //Extraemos el rol del usuario
                                    $buscarRolUsuarioRegistrado = $conexionBD->query("SELECT id_rol_usuario FROM usuario WHERE usuario='$usuarioLogin'");
                                    if ($buscarRolUsuarioRegistrado) {
                                        $rolUsuarioRegistrado = $buscarRolUsuarioRegistrado->fetch_column();
                                        $buscarTipoRolUsuarioRegistrado = $conexionBD->query("SELECT rol FROM rol WHERE id_rol='$rolUsuarioRegistrado'");
                                        if ($buscarTipoRolUsuarioRegistrado) {
                                            $rol = $buscarTipoRolUsuarioRegistrado->fetch_column();
                                            //Agregamos el rol a la sesion
                                            $_SESSION['rol'] = $rol;
                                            header("Location: ../Vista/index.php?success=Bienvenido a Algrano, " . $_SESSION['usuario'] . ".");
                                            exit();
                                        } else {
                                            header("Location: ../ERRORES/ERROR_LOGIN.html");
                                            exit();
                                        }
                                    } else {
                                        header("Location: ../ERRORES/ERROR_LOGIN.html");
                                        exit();
                                    }
                                } else {
                                    header("Location: ../ERRORES/ERROR_LOGIN.html");
                                    exit();
                                }
                            }
                        } else {
                            header("Location: ../ERRORES/ERROR_LOGIN.html");
                            exit();
                        }
                    } else {
                        header("Location: ../ERRORES/ERROR_DATOS_INCORRECTOS.html");
                        exit();
                    }
                }
            } catch (Exception $ex) {
                header("Location: ../ERRORES/ERROR_CONEXION.html");
                exit();
            }
            Algrano::desconectar();
        }
    }
}
