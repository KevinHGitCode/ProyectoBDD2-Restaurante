<?php
require_once __DIR__.'/../../modelo/Admin.php';

// Crear instancia del modelo
$admin = new Admin();

// Obtener el ID del usuario a eliminar
$id = $_POST['id'] ?? null;

// Verificar si el ID es válido
if (!$id || !is_numeric($id)) {
    header("Location: ../../vista/admin/administrarUsuario/usuarios.php?error=ID de usuario no válido");
    
    exit;
}
    echo var_dump($id); 
// Intentar eliminar el usuario
$resultado = $admin->eliminarUsuario(intval($id));

if ($resultado) {
    header("Location: ../../vista/admin/administrarUsuario/usuarios.php?mensaje=Usuario eliminado con éxito");
} else {
    header("Location: ../../vista/admin/administrarUsuario/usuarios.php?error=Error al eliminar el usuario");
}
exit;