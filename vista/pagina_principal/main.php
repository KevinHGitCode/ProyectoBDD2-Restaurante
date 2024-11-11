<!DOCTYPE html>
<!-- Vista cuando no existe seccion -->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inicio</title>
        
        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        
    </head>
    <body>
        <?php
        
        include './mainNavbar.php';
        
        // Incluir el archivo del controlador
        require_once '../../controlador/ctlAutenticacion.php';

        // Crear una instancia del controlador
        $ctlAutenticacion = new ctlAutenticacion();

        // Llamar al método para mostrar la vista
        $ctlAutenticacion->mostrarVista();
   
        ?>
        <!-- jQuery, Popper.js, Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
