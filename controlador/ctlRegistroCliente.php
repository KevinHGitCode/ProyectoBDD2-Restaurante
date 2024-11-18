<?php
require_once '../modelo/User.php';
require_once '../modelo/Admin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Verificar si las contraseñas coinciden
    if ($password !== $confirmPassword) {
        echo "<script>alert('Las contraseñas no coinciden.');</script>";
        exit;
    }

    // Crear una instancia de la clase User para registrar al usuario
    $user = new User();

    // Registrar el usuario
    $registroUsuario = $user->register($username, $email, $password);

    if ($registroUsuario) {
        // Si el registro del usuario fue exitoso, se crea el cliente (con el rol de cliente)
        $admin = new Admin();
        $id_rol = 1; // ID del rol de cliente

        // El método crearUsuario de Admin es el encargado de crear al cliente
        $registroCliente = $admin->crearUsuario($username, $email, $password, $id_rol);

        if ($registroCliente) {
            
            $result = $user->authenticate($_POST['username'], $_POST['password']);

            if (is_array($result)) {
                

                // Iniciar sesión (si aún no está iniciada)
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }

                $_SESSION['id_usuario'] = $result['id_usuario'];
                $_SESSION['id_rol'] = $result['id_rol'];
                $_SESSION['nombre_usuario'] = $result['nombre_usuario'];

                // Redirigir al controlador de vistas
                require './ctlRolVista.php';
                $ctv = new ctlRolVista();
                $ctv->mostrarVista();
            } else {
                // Mostrar mensaje de error (usuario no encontrado o contraseña incorrecta)
                echo $result;
            }

        } else {
            echo "<script>alert('Error al registrar el cliente.');</script>";
        }
    } else {
        echo "<script>alert('Error al registrar el usuario.');</script>";
    }
} else {
    echo "<script>alert('Acceso no permitido.');</script>";
}
?>
