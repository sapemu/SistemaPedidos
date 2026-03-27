<?php

require_once __DIR__ . '/../config/database.php';

class Usuario {

    private $conexion;

    public function __construct() {
        $db = new Database();
        $this->conexion = $db->conectar();
    }

    public function login($login, $password, $rol) {

        $sql = "SELECT * FROM usuarios 
                WHERE (email = :login OR nombre_usuario = :login)
                AND id_rol = :rol
                AND estado = 1";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':rol', $rol);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        
        if ($usuario && $usuario['password'] === $password) {
            return $usuario;
        }

        return false;
    }
}