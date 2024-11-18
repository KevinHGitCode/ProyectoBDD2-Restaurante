<?php

include "../modelo/User.php";

$user = new User();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

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
}
