<?php
require_once __DIR__ . '/../config/db.php';

class Admin {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    /** CRUD Usuarios **/
    public function crearUsuario($nombre_usuario, $email, $contrasena, $id_rol) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM Usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
    
        if ($count > 0) {
            return "El email ya está registrado.";
        }
    
        $hashedPassword = password_hash($contrasena, PASSWORD_BCRYPT);
        $stmt = $this->conn->prepare("INSERT INTO Usuarios (nombre_usuario, email, contrasena, id_rol) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $nombre_usuario, $email, $hashedPassword, $id_rol);
        return $stmt->execute();
    }

    public function obtenerUsuarios() {
        $result = $this->conn->query("SELECT id_usuario, nombre_usuario, email, r.id_rol, r.nombre_rol
                                        FROM Usuarios u JOIN Roles r ON u.id_rol = r.id_rol;");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerUsuarioPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM Usuarios WHERE id_usuario = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return "Usuario no encontrado.";
        }
    }

    public function actualizarUsuario($id_usuario, $nombre_usuario, $email, $id_rol) {
        $stmt = $this->conn->prepare("UPDATE Usuarios SET nombre_usuario = ?, email = ?, id_rol = ? WHERE id_usuario = ?");
        $stmt->bind_param("ssii", $nombre_usuario, $email, $id_rol, $id_usuario);
        return $stmt->execute();
    }

    public function eliminarUsuario($id_usuario) {
        $stmt = $this->conn->prepare("DELETE FROM Usuarios WHERE id_usuario = ?");
        $stmt->bind_param("i", $id_usuario);
        return $stmt->execute();
    }

    public function buscarUsuarios($termino) {
        $termino = "%$termino%";
        $stmt = $this->conn->prepare("SELECT id_usuario, nombre_usuario, email, r.id_rol, r.nombre_rol
                                       FROM Usuarios u
                                       JOIN Roles r ON u.id_rol = r.id_rol
                                       WHERE nombre_usuario LIKE ? OR email LIKE ?");
        $stmt->bind_param("ss", $termino, $termino);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    /** CRUD Ingredientes **/
    public function crearIngrediente($nom_ingrediente, $disponibilidad) {
        $stmt = $this->conn->prepare("INSERT INTO Ingredientes (nom_ingrediente, disponibilidad) VALUES (?, ?)");
        $stmt->bind_param("si", $nom_ingrediente, $disponibilidad);
        return $stmt->execute();
    }

    public function obtenerIngredientes() {
        $result = $this->conn->query("SELECT id_ingrediente, nom_ingrediente, disponibilidad FROM Ingredientes");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function actualizarIngrediente($id_ingrediente, $nombre, $disponibilidad) {
        $stmt = $this->conn->prepare("UPDATE Ingredientes SET nom_ingrediente = ?, disponibilidad = ? WHERE id_ingrediente = ?");
        $stmt->bind_param("sii", $nombre, $disponibilidad, $id_ingrediente);
        return $stmt->execute();
    }

    public function eliminarIngrediente($id_ingrediente) {
        $stmt = $this->conn->prepare("DELETE FROM Ingredientes WHERE id_ingrediente = ?");
        $stmt->bind_param("i", $id_ingrediente);
        return $stmt->execute();
    }

    /** CRUD Categoría **/
    public function crearCategoria($nombre_categoria) {
        $stmt = $this->conn->prepare("INSERT INTO Categorias (nom_categoria) VALUES (?)");
        $stmt->bind_param("s", $nombre_categoria);
        return $stmt->execute();
    }

    public function obtenerCategorias() {
        $result = $this->conn->query("SELECT * FROM Categorias");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function actualizarCategoria($id_categoria, $nombre_categoria) {
        $stmt = $this->conn->prepare("UPDATE Categorias SET nom_categoria = ? WHERE id_categoria = ?");
        $stmt->bind_param("si", $nombre_categoria, $id_categoria);
        return $stmt->execute();
    }

    public function eliminarCategoria($id_categoria) {
        $stmt = $this->conn->prepare("DELETE FROM Categorias WHERE id_categoria = ?");
        $stmt->bind_param("i", $id_categoria);
        return $stmt->execute();
    }

    /** CRUD Productos **/
    public function crearProducto($nombre_producto, $precio, $id_categoria, $img) {
        $stmt = $this->conn->prepare("INSERT INTO Productos (nom_producto, precio, id_categoria, link_img) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sdis", $nombre_producto, $precio, $id_categoria, $img);
        return $stmt->execute();
    }

    public function obtenerProductos() {
        $result = $this->conn->query("SELECT * FROM Productos");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function actualizarProducto($id_producto, $nombre_producto, $descripcion, $precio, $img, $id_categoria) {
        $stmt = $this->conn->prepare("UPDATE Productos SET nom_producto = ?, 
                                        descripcion = ?, precio = ?, link_img = ?, id_categoria = ? 
                                        WHERE id_producto = ?");
        // Corrigiendo el orden de los tipos y valores en bind_param
        $stmt->bind_param("ssdsii", $nombre_producto, $descripcion, $precio, $img, $id_categoria, $id_producto);
        return $stmt->execute();
    }    

    public function eliminarProducto($id_producto) {
        $stmt = $this->conn->prepare("DELETE FROM Productos WHERE id_producto = ?");
        $stmt->bind_param("i", $id_producto);
        return $stmt->execute();
    }

    /** Reportes **/
    public function generarReporteFacturas() {
        $result = $this->conn->query("
            SELECT f.id_factura, f.fecha, c.nombre_cliente, f.total 
            FROM Facturas f
            JOIN Clientes c ON f.id_cliente = c.id_cliente
        ");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function generarReporteProductos() {
        $result = $this->conn->query("
            SELECT p.nom_producto, SUM(d.cantidad) as total_vendido
            FROM DetallesOrden d
            JOIN Productos p ON d.id_producto = p.id_producto
            GROUP BY p.nom_producto
        ");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function generarReporteClientes() {
        $result = $this->conn->query("
            SELECT c.nombre_cliente, COUNT(o.id_orden) as total_ordenes, SUM(f.total) as total_gastado
            FROM Clientes c
            LEFT JOIN Ordenes o ON c.id_cliente = o.id_cliente
            LEFT JOIN Facturas f ON o.id_orden = f.id_orden
            GROUP BY c.nombre_cliente
        ");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}