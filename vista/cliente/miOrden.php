<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifica si hay un pedido activo, en este caso lo obtenemos de la sesión o parámetro GET
$id_pedido = $_GET['id_pedido'] ?? $_SESSION['id_pedido'] ?? 19; // Cambiar lógica de acuerdo a tu implementación

// Incluye el controlador
require_once __DIR__ . '/../../controlador/Cliente/OrdenControlador.php';

// Instancia el controlador de la orden
$controlador = new OrdenControlador();

// Obtiene los detalles de la orden usando el ID del pedido
$orden = $controlador->obtenerDetallesOrden($id_pedido);

// Si la orden no existe
if (!$orden) {
    echo "<div class='alert alert-warning text-center'>No se encontraron detalles para esta orden.</div>";
    exit;
}

// Obtiene el estado de la orden
$estadoOrden = $controlador->obtenerEstadoOrden($id_pedido);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Orden</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Detalles de Mi Orden</h2>

        <!-- Mostrar el estado de la orden -->
        <div class="alert alert-info text-center">
            Orden # <?= $id_pedido ?> | Estado de la orden: <?= htmlspecialchars($estadoOrden) ?> 
        </div>

        <!-- Si hay productos en la orden, mostrarlos en una tabla -->
        <table class="table table-bordered mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orden['productos'] as $producto): ?>
                    <tr>
                        <td><?= htmlspecialchars($producto['nom_producto']) ?></td>
                        <td><?= $producto['cantidad'] ?></td>
                        <td>$<?= number_format($producto['precio'], 2) ?></td>
                        <td>$<?= number_format($producto['subtotal'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-right">Total:</th>
                    <th>$<?= number_format($orden['total'], 2) ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>
