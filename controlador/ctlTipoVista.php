<?php

class ctlTipoVista {
    // Método para mostrar la vista correcta según la sesión
    public function mostrarVista() {
        
        echo var_dump($_SESSION['id_rol']);
        // Determinar la vista según el rol de usuario
        switch ($_SESSION['id_rol']) {
            case 1:  // cliente
                header("Location: ../vista/cliente/cliente.php");
                break;
            case 2:  // chef
                header("Location: ../vista/chef/chef.php");
                break;
            case 3:  // administrador
                header("Location: ../vista/admin/admin.php");
                break;
            default:
                // Si el rol no coincide, cargar una vista de error o redirigir a principal
                $this->cargarError("Acceso denegado. Rol no reconocido.");
                break;
        }
        
    }


    // Método para manejar errores
    private function cargarError($mensaje) {
        echo "<h1 class='alert alert-danger'>$mensaje</h1>";
    }
}
