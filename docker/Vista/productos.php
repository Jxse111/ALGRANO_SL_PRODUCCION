<?php
session_start();
require_once '../Modelo/Algrano.php';
require_once '../Modelo/Producto.php';

// Inicializa la cesta si no existe
if (!isset($_SESSION['cesta'])) {
    $_SESSION['cesta'] = []; // Inicializa la cesta como un array vacío
}

$conexionBD = Algrano::conectarAlgranoMySQLi();

// Maneja el cierre de sesión
if (isset($_POST['logoff'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}

// Maneja la adición de productos a la cesta
if (isset($_POST['enviar']) && isset($_POST['producto'])) {
    $_SESSION['cesta'][] = $_POST['producto'];
}

// Maneja la compra
if (isset($_POST['comprar'])) {
    header('Location: comprar.php');
    exit();
}

$productos = Producto::listarProductos(); // Obtiene los productos
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Productos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        #productos {
            margin: 20px;
        }

        .producto-item {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
        }

        .producto-item label {
            font-weight: bold;
        }

        .botones {
            margin-top: 10px;
        }

        footer {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Lista de Productos</h1>
    <div id='productos'>
        <ul>
            <?php foreach ($productos as $producto) { ?>
                <li class="producto-item">
                    <label>Nombre:</label> <?php echo $producto['nombre']; ?><br>
                    <label>Precio:</label> <?php echo $producto['precioUnitario']; ?> €<br>
                    <form action="" method="post" class="botones">
                        <input type="hidden" name="producto" value="<?php echo $producto['idProducto']; ?>">
                        <button type="submit" name="enviar">Añadir</button>
                    </form>
                </li>
            <?php } ?>
        </ul>
    </div>
    <form method="post">
        <button type='submit' name='comprar'>Comprar</button>
    </form>
    <footer>
        <form method='post' action=''>
            <div class='desconexion'>
                <input type='submit' name='logoff' value='Cerrar Sesión'>
            </div>
        </form>
    </footer>
    <!-- Loader -->
    <div class="loader-wrapper" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(27, 18, 15, 0.95); display: flex; justify-content: center; align-items: center; z-index: 9999;">
        <div class="coffee-loader">
            <div class="coffee-cup"></div>
            <div class="coffee-steam">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <style>
        .coffee-loader {
            position: relative;
            width: 120px;
            height: 120px;
        }

        .coffee-cup {
            position: absolute;
            bottom: 0;
            width: 100px;
            height: 80px;
            border: 6px solid #DA9F5B;
            border-radius: 0 0 45px 45px;
            background: transparent;
        }

        .coffee-cup::before {
            content: '';
            position: absolute;
            right: -25px;
            top: 15px;
            width: 40px;
            height: 30px;
            border: 6px solid #DA9F5B;
            border-radius: 40px 0;
        }

        .coffee-steam span {
            position: absolute;
            background: #DA9F5B;
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .coffee-steam span:nth-child(1) {
            animation: steam 2s infinite ease-in-out;
            left: 20px;
        }

        .coffee-steam span:nth-child(2) {
            animation: steam 2s infinite ease-in-out .4s;
            left: 50px;
        }

        .coffee-steam span:nth-child(3) {
            animation: steam 2s infinite ease-in-out .8s;
            left: 80px;
        }

        @keyframes steam {
            0% {
                transform: translateY(80px) scale(0.1);
                opacity: 0;
            }

            50% {
                transform: translateY(40px) scale(1);
                opacity: 1;
            }

            100% {
                transform: translateY(0px) scale(1.5);
                opacity: 0;
            }
        }
    </style>

    <script>
        $(window).on("load", function() {
            $(".loader-wrapper").fadeOut("slow");
        });
    </script>
</body>

</html>