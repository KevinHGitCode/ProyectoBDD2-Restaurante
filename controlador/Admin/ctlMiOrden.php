<?php
require_once __DIR__ . '/../../modelo/OrdenModelo.php';

class OrdenControlador {
    private $modelo;

    public function __construct() {
        $this->modelo = new OrdenModelo();
    }

    public function obtenerOrdenPorCliente($id_cliente) {
        try {
            return $this->modelo->obtenerOrdenPorCliente($id_cliente);
        } catch (Exception $e) {
            error_log("Error al obtener la orden: " . $e->getMessage());
            return [];
        }
    }
}
