<?php
require_once '../../config/db.php';

class Cliente {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Obtener productos por categoría
    public function obtenerMenuPorCategoria($categoria) {
        // agrege descripcion y link_img
        $stmt = $this->conn->prepare("SELECT id_producto, nom_producto, precio, descripcion, link_img 
                                        FROM Productos p join Categorias c on p.id_categoria = c.id_categoria
                                        WHERE c.nom_categoria = ?");
        $stmt->bind_param("s", $categoria);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $productos = [];
            while ($row = $result->fetch_assoc()) {
                $productos[] = $row;
            }
            $stmt->close();
            return $productos;
        }

        $stmt->close();
        return false; // No se encontraron productos
    }


    // Realizar un pedido
    public function realizarOrden($id_cliente, $productos, $id_mesa = null) {
        $this->conn->begin_transaction();
        try {
            // Insertar en la tabla Pedidos
            $stmt = $this->conn->prepare("INSERT INTO Pedidos (id_cliente, id_mesa, fecha_hora, estado) 
                                        VALUES (?, ?, NOW(), 'En Cola')");
            $stmt->bind_param("ii", $id_cliente, $id_mesa); // Ajusta los tipos según corresponda
            $stmt->execute();
            $id_pedido = $this->conn->insert_id; // Obtener el ID del nuevo pedido

            // Insertar los detalles del pedido
            foreach ($productos as $producto) {
                $stmtDetalle = $this->conn->prepare("INSERT INTO Personalizaciones_pedidos (id_pedido, id_producto, accion) 
                                                    VALUES (?, ?, ?)");
                $stmtDetalle->bind_param("iis", $id_pedido, $producto['id_producto'], $producto['accion']);
                $stmtDetalle->execute();
                $stmtDetalle->close();
            }

            $this->conn->commit();
            return $id_pedido; // Retorna el ID del pedido creado
        } catch (Exception $e) {
            // Mostrar mensaje de error con detalles
            error_log("Error al realizar el pedido: " . $e->getMessage()); // Loguea el error
            echo "Error al realizar el pedido. Detalles: " . $e->getMessage(); // Muestra el error al usuario

            $this->conn->rollback();
            return false;
        }
    }


    // Consultar estado de la orden
    public function estadoDeLaOrden($id_orden) {
        $stmt = $this->conn->prepare("SELECT estado FROM Pedidos WHERE id_pedido = ?");
        $stmt->bind_param("i", $id_orden);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                return $result->fetch_assoc()['estado'];
            }
        }

        $stmt->close();
        return false; // Orden no encontrada
    }

    // Modificar un pedido si está en cola
    public function modificarOrden($id_orden, $nuevosProductos) {
        $stmt = $this->conn->prepare("SELECT estado FROM Pedidos WHERE id_pedido = ?");
        $stmt->bind_param("i", $id_orden);
        $stmt->execute();
        $stmt->bind_result($estado);
        $stmt->fetch();
        $stmt->close();

        if ($estado === 'En Cola') {
            $this->conn->begin_transaction();
            try {
                // Eliminar detalles existentes del pedido
                $stmtDelete = $this->conn->prepare("DELETE FROM Personalizaciones_pedidos WHERE id_pedido = ?");
                $stmtDelete->bind_param("i", $id_orden);
                $stmtDelete->execute();
                $stmtDelete->close();

                // Insertar los nuevos productos con sus acciones personalizadas
                foreach ($nuevosProductos as $producto) {
                    $stmtDetalle = $this->conn->prepare("INSERT INTO Personalizaciones_pedidos (id_pedido, id_producto, accion) VALUES (?, ?, ?)");
                    $stmtDetalle->bind_param("iis", $id_orden, $producto['id_producto'], $producto['accion']);
                    $stmtDetalle->execute();
                    $stmtDetalle->close();
                }

                $this->conn->commit();
                return true;
            } catch (Exception $e) {
                $this->conn->rollback();
                return false;
            }
        }

        return false; // No se puede modificar si no está en cola
    }


    // Cancelar un pedido si está en cola
    public function cancelarOrden($id_orden) {
        $stmt = $this->conn->prepare("UPDATE Pedidos SET estado = 'Cancelado' WHERE id_pedido = ? AND estado = 'En Cola'");
        $stmt->bind_param("i", $id_orden);

        if ($stmt->execute()) {
            return $stmt->affected_rows > 0; // Verificar si se actualizó la orden
        }

        $stmt->close();
        return false;
    }

    // Generar factura de lo consumido
    public function generarFactura($id_orden) {
        // Verificar si el pedido ya tiene una factura
        $stmtCheck = $this->conn->prepare("SELECT id_factura FROM Facturas WHERE id_pedido = ?");
        $stmtCheck->bind_param("i", $id_orden);
        $stmtCheck->execute();
        $stmtCheck->store_result();
    
        // Si no existe la factura, generar los detalles y la factura
        if ($stmtCheck->num_rows === 0) {
            // Obtener los detalles de los productos y calcular el total
            $stmt = $this->conn->prepare("SELECT p.nom_producto, p.precio, pp.accion, p.precio AS total
                                          FROM Personalizaciones_pedidos pp
                                          JOIN Productos p ON pp.id_producto = p.id_producto
                                          WHERE pp.id_pedido = ?");
            $stmt->bind_param("i", $id_orden);
    
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $factura = [];
                $totalFactura = 0;
    
                // Recopilar detalles de la factura y calcular el total
                while ($row = $result->fetch_assoc()) {
                    $factura[] = $row;
                    $totalFactura += $row['total'];  // Sumar al total de la factura
                }
                $stmt->close();
    
                // Insertar la factura con el total calculado
                $stmtInsert = $this->conn->prepare("INSERT INTO Facturas (id_pedido, total, met_pago) VALUES (?, ?, ?)");
                $stmtInsert->bind_param("ids", $id_orden, $totalFactura, $met_pago);
                $stmtInsert->execute();
                $stmtInsert->close();
    
                return $factura;
            }
            $stmt->close();
        }
    
        $stmtCheck->close();
        return false; // No se pudo generar factura
    }
    

    // Método para pagar la factura
    public function pagarFactura($id_orden, $metodoPago) {
        // Verificar primero si el estado del pedido es 'Completado'
        $stmtVerificarEstado = $this->conn->prepare("SELECT estado FROM Pedidos WHERE id_pedido = ?");
        $stmtVerificarEstado->bind_param("i", $id_orden);
        $stmtVerificarEstado->execute();
        $stmtVerificarEstado->bind_result($estado);
        $stmtVerificarEstado->fetch();
        $stmtVerificarEstado->close();
    
        // Si el estado no es 'Completado', no proceder con el pago
        if ($estado !== 'Completado') {
            return false;
        }
    
        // Si el estado es 'Completado', proceder con el pago
        $this->conn->begin_transaction();
        try {
            // Actualizar el estado del pedido a "Pagado"
            $stmtPedido = $this->conn->prepare("UPDATE Pedidos SET estado = 'Pagado' WHERE id_pedido = ?");
            $stmtPedido->bind_param("i", $id_orden);
            $stmtPedido->execute();
    
            // Actualizar el método de pago en la tabla Facturas
            $stmtFactura = $this->conn->prepare("UPDATE Facturas SET met_pago = ? WHERE id_pedido = ?");
            $stmtFactura->bind_param("si", $metodoPago, $id_orden);
            $stmtFactura->execute();
    
            // Confirmar la transacción
            $this->conn->commit();
    
            $stmtPedido->close();
            $stmtFactura->close();
            return true;  // El pago fue procesado correctamente
        } catch (Exception $e) {
            // Si ocurre algún error, deshacer los cambios
            $this->conn->rollback();
            return false;  // No se pudo procesar el pago
        }
    }

    // Consultar los detalles de una orden específica
    public function obtenerDetallesOrden($id_pedido) {
        $stmt = $this->conn->prepare(
            "SELECT p.id_producto, p.nom_producto, pp.cantidad, p.precio, 
                    (pp.cantidad * p.precio) AS subtotal
            FROM Personalizaciones_pedidos pp
            JOIN Productos p ON pp.id_producto = p.id_producto
            WHERE pp.id_pedido = ?"
        );
        $stmt->bind_param("i", $id_pedido);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $detallesOrden = [];
            $total = 0;

            while ($row = $result->fetch_assoc()) {
                $detallesOrden[] = $row;
                $total += $row['subtotal']; // Calcular el total general
            }

            $stmt->close();

            // Agregar el total general al resultado
            return [
                'productos' => $detallesOrden,
                'total' => $total
            ];
        }

        $stmt->close();
        return false; // Si la consulta falla
    }




}

