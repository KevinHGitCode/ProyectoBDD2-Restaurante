<?php
require_once __DIR__.'/../../modelo/Admin.php';

// Crear instancia del modelo
$admin = new Admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar si todos los campos están presentes
    if (
        isset($_POST['nombre_usuario'], $_POST['email'], $_POST['contrasena'], $_POST['id_rol']) &&
        !empty($_POST['nombre_usuario']) && !empty($_POST['email']) &&
        !empty($_POST['contrasena']) && !empty($_POST['id_rol'])
    ) {
        // Sanitizar los datos
        $nombre_usuario = htmlspecialchars(strip_tags($_POST['nombre_usuario']));
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $contrasena = htmlspecialchars(strip_tags($_POST['contrasena']));
        $id_rol = intval($_POST['id_rol']);

        // Validar formato del email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Error: El formato del correo electrónico no es válido.";
            exit;
        }

        // Crear usuario
        $resultado = $admin->crearUsuario($nombre_usuario, $email, $contrasena, $id_rol);

        if ($resultado === true) {
            echo "Usuario añadido correctamente.";
        } else {
            echo "Error: " . htmlspecialchars($resultado);
        }
    }
}