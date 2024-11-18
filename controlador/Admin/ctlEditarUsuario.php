<?php
require_once __DIR__ . '/../../modelo/Admin.php';

// Crear instancia del modelo
$admin = new Admin();

// Verificar si la solicitud es GET (para obtener datos del usuario)
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $usuario = $admin->obtenerUsuarioPorId($_GET['id']);

    if ($usuario) {
        header('Content-Type: application/json');
        echo json_encode($usuario);
    } else {
        http_response_code(404);
        echo json_encode(["error" => "Usuario no encontrado"]);
    }
    exit;
}

// Verificar si la solicitud es POST (para actualizar el usuario)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['nombre_usuario'], $_POST['email'], $_POST['id_rol'])) {
    $id = intval($_POST['id']);
    $nombre_usuario = htmlspecialchars(strip_tags($_POST['nombre_usuario']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $id_rol = intval($_POST['id_rol']);

    // Validar formato del correo electrónico
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Error: Formato de correo electrónico no válido.";
        exit;
    }

    // Actualizar el usuario
    $resultado = $admin->actualizarUsuario($id, $nombre_usuario, $email, $id_rol);

    if ($resultado) {
        header("Location: ../../vista/admin/administrarUsuario/usuarios.php?mensaje=Usuario actualizado con éxito");
    } else {
        echo "Error: No se pudo actualizar el usuario.";
    }
    exit;
}

// Redirigir si no se cumplen las condiciones
header("Location: ../../vista/admin/administrarUsuario/usuarios.php?error=Solicitud no válida");
exit;
?>
