<?php
require_once '../../modelo/Cliente.php';

function obtenerMenuOrganizadoPorCategoria() {
    $cliente = new Cliente();

    // Definir las categorías esperadas
    $categorias = ['Entradas', 'Platos Principales', 'Postres', 'Bebidas'];

    $menu = [];
    foreach ($categorias as $categoria) {
        $menu[$categoria] = $cliente->obtenerMenuPorCategoria($categoria);
    }

    return $menu;
}


// Nueva función para añadir un producto a la orden
function añadirAOrden($id_producto, $cantidad) {
    // Verificar si la sesión ya está iniciada
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Si la orden no está iniciada, iniciarla
    if (!isset($_SESSION['orden'])) {
        $_SESSION['orden'] = [];
    }

    // Comprobar si el producto ya está en la orden
    $productoExiste = false;
    foreach ($_SESSION['orden'] as &$producto) {
        if ($producto['id_producto'] == $id_producto) {
            $producto['cantidad'] += $cantidad;  // Incrementar cantidad
            $productoExiste = true;
            break;
        }
    }

    // Si el producto no está en la orden, agregarlo
    if (!$productoExiste) {
        $cliente = new Cliente();
        $producto = $cliente->obtenerProductoPorId($id_producto);
        $producto['cantidad'] = $cantidad;  // Agregar la cantidad
        $_SESSION['orden'][] = $producto;
    }
}

// Función para obtener los productos en la orden (para mostrar en la vista)
function obtenerOrden() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    return isset($_SESSION['orden']) ? $_SESSION['orden'] : [];
}
