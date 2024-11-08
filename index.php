<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Resturante</title>
        
        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        
    </head>
    <body 
        class="bg-dark text-light"
        >
        
        <?php
        
        require_once './controlador/ctlTipoVista.php';
        $ctv = new ctlTipoVista();
        $ctv->mostrarVista();
        
        ?>
    </body>
</html>
