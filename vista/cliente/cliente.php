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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cliente</title>
                
        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="estilo.css">

        <style>
        .custom-card-body {
            text-align: center;
        }
    </style>
    </head>
    <body>
        <?php
        if (!isset($_SESSION['id_usuario']) || $_SESSION['id_rol']!=1) {
            header("Location: ../pagina_principal/main.php"); // Redirige si no hay sesión
            exit();
        }
        
        include './cliente-navbar.php';
        include './menu.php';
        ?>
    
        <!-- jQuery, Popper.js, Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    </body>
</html>
