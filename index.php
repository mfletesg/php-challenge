<?php


require_once 'loadEnv.php'; //Obtiene las variables .env para la conexion a la db
require 'app/controller/AuthController.php'; // Controladores del proyecto
require 'app/core/ConnectionDb.php'; //Conexion a la base de datos

define('VIEWS_PATH', __DIR__ . '/app/resources/views');
$uri = str_replace('/prueba', '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

switch ($uri) {
    case '/':
        $controller = new AuthController();
        $controller->index();
        break;
    case '/show':
        break;
    default:
        http_response_code(404);
        echo "Página no encontrada";
        break;
}