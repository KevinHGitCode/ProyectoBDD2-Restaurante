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
    </body>
</html>
