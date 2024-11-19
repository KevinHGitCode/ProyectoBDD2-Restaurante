<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="./estilosAdmin.css">
</head>

<body>
    
    <?php
    if (!isset($_SESSION['id_usuario']) || $_SESSION['id_rol']!=3) {
        header("Location: ../pagina_principal/main.php"); // Redirige si no hay sesión
        exit();
    }

    include './admin-sidebar.php';?>

    <!-- Main content -->
    <main role="main" class="content col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
        <?php include '../../controlador/ctlAdminSidebar.php';?>
    </main>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
