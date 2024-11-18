<?php
// Cargar contenido dinámico según la página
$page = $_GET['page'] ?? 'dashboard';

switch ($page) {
    case 'dashboard':
        include './dashboard.php';
        break;
    case 'usuarios':
        include './administrarUsuario/usuarios.php';
        break;
    case 'productos':
        include './productos.php';
        break;
    case 'categorias':
        include './categorias.php';
        break;
    case 'ingredientes':
        include './ingredientes.php';
        break;
    case 'reportes_facturas':
        include './reportes_facturas.php';
        break;
    case 'reportes_productos':
        include './reportes_productos.php';
        break;
    case 'reportes_clientes':
        include './reportes_clientes.php';
        break;
    default:
        echo '<h1 class="h2">Bienvenido, Administrador</h1>';
        echo '<p>Seleccione una de las opciones del menú para comenzar.</p>';
        break;
}
?>