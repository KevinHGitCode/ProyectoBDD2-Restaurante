<?php
require_once __DIR__ . '/../../modelo/Admin.php';

// Verificar si se recibe un ID válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Instanciar el modelo y buscar el usuario
    $admin = new Admin();
    $usuario = $admin->obtenerUsuarioPorId($id);

    if ($usuario) {
        // Configurar encabezado y devolver el JSON
        header('Content-Type: application/json');
        echo json_encode($usuario);
    } else {
        // Usuario no encontrado
        http_response_code(404);
        echo json_encode(["error" => "Usuario no encontrado"]);
    }
} else {
    // ID no válido
    http_response_code(400);
    echo json_encode(["error" => "ID de usuario no válido"]);
}