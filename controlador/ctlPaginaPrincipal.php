<?php

class ctlPaginaPrincipal {
    // Método principal para controlar las vistas
    public function mostrarVista() {
        // Verificar si el parámetro 'view' está definido en la URL
        if (isset($_GET['view'])) {
            $view = $_GET['view'];

            // Determinar la vista a mostrar según el valor de 'view'
            switch ($view) {
                case 'home':
                    $this->cargarVista('home');
                    break;
                case 'contact':
                    $this->cargarVista('contact');
                    break;
                case 'about':
                    $this->cargarVista('about');
                    break;
                case 'login':
                    $this->cargarVista('login');
                    break;
                case 'register':
                    $this->cargarVista('register');
                    break;
                default:
                    $this->cargarError(); // Si no se encuentra la vista, mostrar error 404
                    break;
            }
        } else {
            // Si no se define ninguna vista, cargar una vista por defecto
            $this->cargarVista('home'); // Vista predeterminada si no se pasa ningún parámetro 'view'
        }
    }

    // Método para cargar una vista específica
    private function cargarVista($vista) {
        // Verifica si el archivo de la vista existe
        $rutaVista = $vista . ".php";
        if (file_exists($rutaVista)) {
            require_once $rutaVista;
        } else {
            $this->cargarError(); // Si no existe el archivo, mostrar error
        }
    }

    // Método para manejar errores y mostrar página 404
    private function cargarError() {
        echo "<p>404: Página no encontrada.</p>"; // Mensaje de error cuando la vista no está definida
    }
}
