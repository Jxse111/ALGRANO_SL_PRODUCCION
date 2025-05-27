<?php
require_once '../Modelo/funcionesBaseDeDatos.php';
require_once '../Modelo/Algrano.php';
require_once '../Modelo/Usuario.php';
session_start();
//Si el usuario no es administrador, lo redirigimos a la página de inicio
if ($_SESSION['rol'] != "administrador") {
    header("location: ../Vista/index.php");
}
//Comprobamos si se ha pasado el id del usuario a eliminar
if (filter_has_var(INPUT_GET, "id")) {
    $conexionBD = Algrano::conectarAlgranoMySQLi();
    $dniUsuario = filter_input(INPUT_GET, 'id');
    if (Usuario::eliminarUsuario($dniUsuario)) {
        header("location: ../Vista/areaAdmin.php");
        exit;
    } else {
        header("location: ../Vista/areaAdmin.php");
    }
} else {
    header("location: ../Vista/areaAdmin.php");
}
