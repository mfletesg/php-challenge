<?php

/*
    Prueba de PHP sin Framework: Miguel Fletes García.
    // Puedes encontrar más detalles en mi GitHub: https://github.com/tu_usuario
    
    Este proyecto se realizó sin el uso de frameworks en PHP. Se utilizó una arquitectura MVC para gestionar mejor el proyecto
    y mantener buenas prácticas de desarrollo. Además, se empleó la programación orientada a objetos (POO) para las clases relacionadas
    con bases de datos, emulando un tipo de ORM.
    
    También se crearon rutas para seguir buenas prácticas en el desarrollo de APIs.
*/

require_once 'loadEnv.php'; //Obtiene las variables .env para la conexion a la db
require 'app/controller/AuthController.php'; // Controlador para getionar las sesiones
require 'app/controller/UserController.php'; // Controladores de Usuario
require 'app/controller/TaskController.php'; // Controlador de Tareas
require 'app/controller/StatusController.php'; // Controlador de Status


define('VIEWS_PATH', __DIR__ . '/app/resources/views');
$uri = str_replace('/' . $_ENV['BASE_URL'], '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$method = $_SERVER['REQUEST_METHOD'];

// Detectar si la solicitud es por JSON
$isJson = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

switch ($uri) {
    case $url = '/':
        checkSession($url);
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

    case $url = '/user':
        checkSession($url);
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

    case $url = '/task':
        checkSession($url);
        $controller = new TaskController();
        if ($method === 'GET') {
            $id = $_GET['id'] ?? null;
            if ($id !== null) {
                echo $controller->getById($id);
            } else if ($isJson) {
                echo $controller->get();
            } else {
                $controller->index();
            }
        } elseif ($method === 'POST') {
            echo $controller->create();
        } elseif ($method === 'PATCH') {
            echo $controller->update();
        } elseif ($method === 'DELETE') {
            $id = $_GET['id'] ?? null;
            if ($id) {
                echo $controller->delete($id);
            }
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Método no permitido']);
        }
        break;

    case $url = '/logout':
        checkSession($url);
        $controller = new AuthController();
        if ($method === 'POST') {
            $controller->logout();
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Método no permitido']);
        }
        break;

    case $url = '/status':
        checkSession($url);
        $controller = new StatusController();
        if ($method === 'GET') {
            echo $controller->get();
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Método no permitido']);
        }
        break;

    default:
        http_response_code(404);
        require VIEWS_PATH . '/notfound.php';
        break;
}