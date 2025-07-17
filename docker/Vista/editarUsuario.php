<?php
session_start();
if ($_SESSION['rol'] != "administrador") {
    header("location: ../Vista/index.php");
}
require_once '../Modelo/Usuario.php';
require_once '../Modelo/Algrano.php';
$usuarioSinEditar = Usuario::buscarUsuario(filter_input(INPUT_GET, 'id'));

if (filter_has_var(INPUT_POST, 'modificarUsuario')) {
    $nombreUsuario = filter_input(INPUT_POST, 'usuarioEditado');
    $nombreUsuario = filter_input(INPUT_POST, 'usuarioEditado') ?: $usuarioSinEditar[0]['usuario'];
    $direccionUsuario = filter_input(INPUT_POST, 'direccionEditada') ?: $usuarioSinEditar[0]['direccion'];
    $correoUsuario = filter_input(INPUT_POST, 'correoEditado') ?: $usuarioSinEditar[0]['correo'];
    $rolUsuario = filter_input(INPUT_POST, 'rolEditado') ?: $usuarioSinEditar[0]['id_rol_usuario'];
    $dniUsuario = filter_input(INPUT_GET, 'id');
    $fechaNacimientoUsuario = $usuarioSinEditar[0]['fec_nac'];
    $usuario = new Usuario($dniUsuario, $nombreUsuario, '', $direccionUsuario, $correoUsuario, $fechaNacimientoUsuario, $rolUsuario);
    $usuario->guardarUsuario();
    header("location: ../Vista/areaAdmin.php");
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

    <!-- Hoja de estilos personalizada para Bootstrap-->
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
        <h1 class="display-4 mb-3 mt-0 text-white text-uppercase">FORMULARIO DE EDICIÓN DE USUARIOS</h1>
    </div>
    <!-- Fin de la cabecera -->

    <!-- Formulario de edición de usuario -->
    <div class="contact-form">
        <div class="section-title">
            <h4 class="text-primary text-uppercase">USUARIO CON DNI <?php echo filter_input(INPUT_GET, 'id') ?></h4>
        </div>
        <?php foreach ($usuarioSinEditar as $usuario) { ?>
            <form name="sentMessage" id="contactForm" novalidate="novalidate" method="POST">
                <h6 class="text-primary font-weight-bold mb-2">Nombre de usuario</h6>
                <div class="control-group">
                    <input type="text" class="form-control" name="usuarioEditado"
                        placeholder="<?php echo $usuario['usuario'] ?>" />
                    <p class="help-block text-danger"></p>
                </div>
                <h6 class="text-primary font-weight-bold mb-2">Dirección</h6>
                <div class="control-group">
                    <input type="text" class="form-control" name="direccionEditada"
                        placeholder="<?php echo $usuario['direccion'] ?>" />
                    <p class="help-block text-danger"></p>
                </div>
                <h6 class="text-primary font-weight-bold mb-2">Correo</h6>
                <div class="control-group">
                    <input type="text" class="form-control" name="correoEditado"
                        placeholder="<?php echo $usuario['correo'] ?>" />
                    <p class="help-block text-danger"></p>
                </div>
                <h6 class="text-primary font-weight-bold mb-2">Rol</h6>
                <div class="control-group">
                    <input type="text" class="form-control" name="rolEditado"
                        placeholder="<?php echo $usuario['id_rol_usuario'] ?>" />
                    <p class="help-block text-danger"></p>
                </div>
                <div>
                    <button class="btn btn-primary font-weight-bold py-3 px-5" type="submit" id="entrar"
                        name="modificarUsuario">Modificar usuario</button>
                </div>
                <a href="../Vista/areaAdmin.php" class="btn btn-secondary font-weight-bold py-2 px-4 mt-2">Volver al panel
                    de administración</a>
            </form>
        <?php } ?>
    </div>
    <!-- Fin del formulario de edición de usuarios -->
</body>

</html>