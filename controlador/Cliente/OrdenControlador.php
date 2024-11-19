<?php
require_once __DIR__ . '/../../modelo/Cliente.php';

class OrdenControlador {
    // Función para obtener los detalles de la orden
    public function obtenerDetallesOrden($id_pedido) {
        // Instancia el modelo Cliente
        $cliente = new Cliente();

        // Llama la función que obtiene los detalles de la orden
        $detalles = $cliente->obtenerDetallesOrden($id_pedido);

        if ($detalles) {
            // Si hay detalles de la orden, los devuelve
            return $detalles;
        }

        return false; // Si no se encuentran detalles
    }

    // Función para obtener el estado de la orden
    public function obtenerEstadoOrden($id_pedido) {
        $cliente = new Cliente();
        return $cliente->estadoDeLaOrden($id_pedido);
    }
}
?>
