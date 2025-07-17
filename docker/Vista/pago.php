<?php
require_once("../Modelo/Pedido.php");
session_start();
$precioTotal = filter_input(INPUT_POST, "total");
$_SESSION['total'] = $precioTotal;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago con Tarjeta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-custom {
            background-color: #DA9F5B;
            border-color: #DA9F5B;
            color: white;
        }

        .btn-custom:hover {
            background-color: rgb(187, 136, 78);
            border-color: #31201C;
            color: white;
        }

        .card-header {
            background-color: #DA9F5B;
            color: #31201C;
        }

        body {
            background-color: #31201C;
        }

        .card-body {
            color: #DA9F5B;
        }

        .form-label {
            color: #DA9F5B;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"></div>
                    <h3 class="text-center">Pago con Tarjeta</h3>
                </div>
                <div class="card-body">
                    <form action="../Controlador/pagoProceso.php" method="POST">
                    <div class="mb-3">
                        <label for="titular" class="form-label">Titular de la tarjeta</label>
                        <input type="text" class="form-control" id="titular" name="titular" required>
                    </div>
                    <div class="mb-3">
                        <label for="numero_tarjeta" class="form-label">Número de tarjeta</label>
                        <input type="text" class="form-control" id="numero_tarjeta" name="numero_tarjeta"
                            pattern="[0-9]{16}" required placeholder="1234 5678 9012 3456">
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="fecha_caducidad" class="form-label">Fecha de caducidad</label>
                            <input type="text" class="form-control" id="fecha_caducidad" name="fecha_caducidad"
                                pattern="(0[1-9]|1[0-2])\/[0-9]{2}" required placeholder="MM/YY">
                        </div>
                        <div class="col-md-6">
                            <label for="cvv" class="form-label">CVV</label>
                            <input type="text" class="form-control" id="cvv" name="cvv" pattern="[0-9]{3,4}" required
                                placeholder="123">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Número de teléfono</label>
                        <input type="tel" class="form-control" id="telefono" name="telefono" pattern="[0-9]{9}" required
                            placeholder="666777888">
                    </div>
                    <div class="mb-3">
                        <label for="importe" class="form-label">Importe a pagar</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="importe" name="importe" step="0.01" required
                                readonly
                                value="<?php echo isset($precioTotal) ? htmlspecialchars($precioTotal) : '0.00'; ?>">
                            <span class="input-group-text">€</span>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-custom" name="pagar">Realizar
                            Pago</button>
                        <a href="carrito.php" class="btn btn-secondary">Volver al carrito</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
</div>