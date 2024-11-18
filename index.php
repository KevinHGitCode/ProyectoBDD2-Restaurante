<?php
session_start();

// Guarda el tipo de mensaje y texto en la sesión
$_SESSION['mensaje'] = [
    'exito' => true, // true para éxito, false para error
    'texto' => 'La acción se realizó correctamente.'
];

// Redirige a la página principal
header("Location: vista/pagina_principal/main.php");
exit();
?>
