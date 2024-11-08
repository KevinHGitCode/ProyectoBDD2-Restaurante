<?php

class ctlTipoVista {
    // Método para mostrar la vista correcta según la sesión
    public function mostrarVista() {
        // Iniciar sesión (si aún no está iniciada)
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Verificar si hay sesión y el tipo de usuario
        if (!isset($_SESSION['rol'])) {
            // Si no hay sesión, cargar la vista principal
            header("Location: vista/pagina_principal/main.php");
            exit();
        } else {
            // Determinar la vista según el rol de usuario
            switch ($_SESSION['rol']) {
                case 'cliente':
                    header("Location: vista/cliente/cliente.php");
                    break;
                case 'chef':
                    header("Location: vista/chef/chef.php");
                    break;
                case 'administrador':
                    header("Location: vista/admin/admin.php");
                    break;
                default:
                    // Si el rol no coincide, cargar una vista de error o redirigir a principal
                    $this->cargarError("Acceso denegado. Rol no reconocido.");
                    break;
            }
        }
    }


    // Método para manejar errores
    private function cargarError($mensaje) {
        echo "<h1 class='alert alert-danger'>$mensaje</h1>";
    }
}
