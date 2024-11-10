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
        // Iniciar sesión (si aún no está iniciada)
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        include './cliente-navbar.php';
        echo '<h1>Bienvenido cliente con id: '.$_SESSION['id_usuario'].'</h1>';
        ?>
    </body>
</html>
