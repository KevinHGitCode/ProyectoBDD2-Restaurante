<?php

include_once "../modelo/User.php";
require_once __DIR__.'/../modelo/Cliente.php'; // Incluir modelo Cliente

$user = new User();
$cliente = new Cliente();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Intentar autenticar al usuario
    $result = $user->authenticate($_POST['username'], $_POST['password']);

    if (is_array($result)) {
        // Iniciar sesión (si aún no está iniciada)
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Almacenar información del usuario en la sesión
        $_SESSION['id_usuario'] = $result['id_usuario'];
        $_SESSION['id_rol'] = $result['id_rol'];
        $_SESSION['nombre_usuario'] = $result['nombre_usuario'];

        // Si el rol del usuario es 1, obtener el id_cliente
        if ($_SESSION['id_rol'] == 1) {
            // Consultar el id_cliente asociado al usuario
            $clienteId = $cliente->obtenerIdCliente($_SESSION['id_usuario']); 

            if ($clienteId !== false) {
                $_SESSION['id_cliente'] = $clienteId; // Almacenar el id_cliente en la sesión
            } else {
                // Si no se encuentra el id_cliente, mostrar error
                echo "Error al obtener el id_cliente";
            }
        }

        // Redirigir al controlador de vistas según el rol del usuario
        require './ctlRolVista.php';
        $ctv = new ctlRolVista();
        $ctv->mostrarVista();
    } else {
        // Si el usuario no existe o la contraseña es incorrecta
        echo $result;
    }
}
?>
