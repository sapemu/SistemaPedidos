<?php

require_once __DIR__ . '/../controllers/AuthController.php';

$accion = $_GET['accion'] ?? '';

$controller = new AuthController();

if ($accion === 'login') {
    $controller->login();
}
