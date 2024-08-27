<?php

require_once 'loadEnv.php'; //Obtiene las variables .env para la conexion a la db
require 'app/controller/AuthController.php'; // Controladores del proyecto
require 'app/controller/UserController.php'; // Controladores de Usuario
require 'app/controller/TaskController.php'; // Controlador de Tareas
// require 'app/core/ConnectionDb.php'; //Conexion a la base de datos

define('VIEWS_PATH', __DIR__ . '/app/resources/views');
$uri = str_replace('/' . $_ENV['BASE_URL'], '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$method = $_SERVER['REQUEST_METHOD'];

// Detectar si la solicitud es por JSON
$isJson = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

switch ($uri) {
    case '/':
        $controller = new AuthController();
        if ($method === 'GET') {
            $controller->index();
        } elseif ($method === 'POST') {
            $controller->login();
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Método no permitido']);
        }
        break;
        
    case '/user':
        $controller = new UserController();
        if ($method === 'GET') {
            $controller->index();
        } elseif ($method === 'POST') {
            $controller->create();
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Método no permitido']);
        }
        break;

    case '/task':
        $controller = new TaskController();
        if ($method === 'GET') {
            $controller->index($isJson);
        } elseif ($method === 'POST') {  // Pasamos $isJSON para manejar la respuesta
            echo $controller->create();
        } elseif ($method === 'PATCH') {
            echo $controller->update();
        } elseif ($method === 'DELETE') {
            echo $controller->delete();
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Método no permitido']);
        }
        break;

    default:
        http_response_code(404);
        echo "Página no encontrada";
        break;
}