<?php

require_once 'loadEnv.php'; //Obtiene las variables .env para la conexion a la db
require 'app/controller/AuthController.php'; // Controladores del proyecto
require 'app/controller/UserController.php'; // Controladores del proyecto
// require 'app/core/ConnectionDb.php'; //Conexion a la base de datos

define('VIEWS_PATH', __DIR__ . '/app/resources/views');
$uri = str_replace('/'.$_ENV['BASE_URL'], '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

switch ($uri) {
    case '/':
        $controller = new AuthController();
        $controller->index();
        break;
    case '/user':
        $controller = new UserController();
        $controller->index();
        break;
    case '/user/create':
        $controller = new UserController();
        $controller->create();
        break;
    default:
        http_response_code(404);
        echo "Página no encontrada";
        break;
}