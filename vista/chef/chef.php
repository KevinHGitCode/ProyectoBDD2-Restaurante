<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../../controlador/ctlChef.php';
$ordenes = obtenerOrdenesPendientes();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Chef</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="estilo.css">
    </head>
    <body>


        <?php 
        if (!isset($_SESSION['id_usuario']) || $_SESSION['id_rol'] != 2) {
            header("Location: ../pagina_principal/main.php"); // Redirige si no hay sesión
            exit();
        }

        include 'chef-navbar.php';
        include 'ordenes.php';
        ?>

    </body>
</html>
