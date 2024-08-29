<?php

require_once 'loadEnv.php'; //Obtiene las variables .env para la conexion a la db
require 'app/controller/AuthController.php'; // Controladores del proyecto
require 'app/controller/UserController.php'; // Controladores de Usuario
require 'app/controller/TaskController.php'; // Controlador de Tareas
require 'app/controller/StatusController.php'; // Controlador de Tareas

define('VIEWS_PATH', __DIR__ . '/app/resources/views');
$uri = str_replace('/' . $_ENV['BASE_URL'], '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$method = $_SERVER['REQUEST_METHOD'];
// Detectar si la solicitud es por JSON
$isJson = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

switch ($uri) {
    case $url = '/':
        checkSession($url); //Funcion para validar la session
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
        checkSession($url); //Funcion para validar la session
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
        checkSession($url); //Funcion para validar la session
        $controller = new TaskController();
        if ($method === 'GET') {
            $id = $_GET['id'] ?? null;
            if($id !== null){
                echo $controller->getById($id);
            }
            else if($isJson){
                echo $controller->get();
            }
            else{
                $controller->index();
            }
        } elseif ($method === 'POST') {  // Pasamos $isJSON para manejar la respuesta
            echo $controller->create();
        } elseif ($method === 'PATCH') {
            echo $controller->update();
        } elseif ($method === 'DELETE') {
            $id = $_GET['id'] ?? null;
            if($id){
                echo $controller->delete($id);
            }
            else{
                http_response_code(405);
                echo json_encode(['error' => 'Método no permitido']);
            }
            ;
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Método no permitido']);
        }
        break;

    case $url = '/logout':
        checkSession($url); //Funcion para validar la session
        $controller = new AuthController();
        if ($method === 'POST') {
            $controller->logout();
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Método no permitido']);
        }
        break;

    case $url = '/status':
        checkSession($url); //Funcion para validar la session
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
        echo "Página no encontrada";
        break;
}