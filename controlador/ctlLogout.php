<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Destruir la sesión
session_unset();
session_destroy();

// Redirigir al usuario a la página principal o de inicio de sesión
header("Location: ../vista/pagina_principal/main.php");
exit();
?>
