<!DOCTYPE html>
<!-- Vista cuando no existe seccion -->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inicio</title>
        
        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

        <style>
        /* Cambiar el tamaño y estilo de los enlaces en la barra de navegación */
        .navbar-nav .nav-link {
            font-size: 1.2rem; /* Tamaño del texto */
            color: #FAE3D9; /* Color del texto */
            font-weight: bold; /* Texto en negrita */
            font-family: 'Times New Roman', serif;
            text-decoration: none; /* Sin subrayado */
        }

        /* Estilo adicional para el enlace activo */
        .navbar-nav .nav-item.active .nav-link {
            color: #D4A59A; /* Color específico para el enlace activo */
        }

        /* Estilo para el hover (al pasar el cursor) */
        .navbar-nav .nav-link:hover {
            color: #D4A59A; /* Cambia el color al pasar el cursor */
            text-decoration: underline; /* Opcional: subrayado al pasar el cursor */
        }
        </style>

    </head>
    <body class='bg-light'>

        <?php
        
        include './mainNavbar.php';
        
        // Incluir el archivo del controlador
        require_once '../../controlador/ctlPaginaPrincipal.php';

        // Crear una instancia del controlador
        $ctlAutenticacion = new ctlPaginaPrincipal();

        // Llamar al método para mostrar la vista
        $ctlAutenticacion->mostrarVista();
   
        ?>
        
        <!-- jQuery, Popper.js, Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
