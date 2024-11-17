<?php
require_once '../../modelo/Chef.php';

function obtenerOrdenesPendientes() {
    $chef = new Chef();
    return $chef->obtenerPedidos();
}

function actualizarEstadoOrden($id_pedido, $nuevoEstado) {
    $chef = new Chef();
    return $chef->cambiarEstadoOrdenes($id_pedido, $nuevoEstado);
}

// Lógica para manejar las solicitudes de la vista
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_pedido']) && isset($_POST['estado'])) {
        $id_pedido = intval($_POST['id_pedido']);
        $estado = $_POST['estado'];
        if (actualizarEstadoOrden($id_pedido, $estado)) {
            echo "Estado de la orden actualizado correctamente.";
        } else {
            echo "Error al actualizar el estado de la orden.";
        }
        exit;
    }
}
