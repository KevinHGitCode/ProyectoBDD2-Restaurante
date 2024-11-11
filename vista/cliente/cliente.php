<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<!-- Vista para un usuario de tipo "cliente" -->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cliente</title>
                
        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        
    </head>
    <body>
        <?php
        if (!isset($_SESSION['id_usuario']) || $_SESSION['id_rol']!=1) {
            header("Location: login.php"); // Redirige si no hay sesión
            exit();
        }
        
        include './cliente-navbar.php';
        echo '<h1>Bienvenido cliente con id: '.$_SESSION['id_usuario'].'</h1>';
        ?>
    </body>
</html>
