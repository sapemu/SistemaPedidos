<?php

require_once __DIR__ . '/../models/Usuario.php';

class AuthController {

    public function login() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            session_start();

            $login = $_POST['login'];
            $password = $_POST['password'];
            $rol = $_POST['rol'];

            $usuarioModel = new Usuario();
            $usuario = $usuarioModel->login($login, $password, $rol);

            if ($usuario) {

                $_SESSION['usuario'] = [
                    'id' => $usuario['id_usuario'],
                    'nombre' => $usuario['nombre_completo'],
                    'rol' => $usuario['id_rol']
                ];

                // 🔥 REDIRECCIÓN
                switch ($usuario['id_rol']) {

                    case 1:
                        header("Location: /backend/views/admin/dashboard.php");
                        break;

                    case 2:
                        header("Location: /backend/views/restaurante/dashboard.php");
                        break;

                    case 3:
                        header("Location: /backend/views/mesero/dashboard.php");
                        break;

                    case 4:
                        header("Location: /backend/views/cocina/dashboard.php");
                        break;

                    case 5:
                        header("Location: /backend/views/cliente/dashboard.php");
                        break;
                }

                exit;

            } else {
                echo "Credenciales incorrectas";
            }
        }
    }
}