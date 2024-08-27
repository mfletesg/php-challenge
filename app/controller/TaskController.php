<?php

require_once './app/models/Task.php';
require_once './app/functions.php'; // Funciones genericas

class TaskController
{
    public function index($isAjax = false)
    {
        if ($isAjax) {

        } else {
            checkSession(); //Funcion para validar la session
            require VIEWS_PATH . '/task.php';
        }
    }

    public function create()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (!$data || !isset($data) || !isset($data)) {
            http_response_code(400);
            return json_encode(['error' => 'La peticion debe ser de tipo JSON']);
        }

        $title = $data['title'];
        $description = $data['description'];
        $statusId = $data['statusId'];

        if ($title === '' || $description === '' || $statusId === '') {
            http_response_code(400);
            return json_encode(['error' => 'Faltan campos obligatorios: title, description, statusId']);

        }

        $responseDb = Task::create($title, $description, $statusId);

        $response = ['message' => 'Tarea creada correctamente', 'data' => $responseDb];
        http_response_code(201);
        return json_encode($response);

    }

    public function update()
    {

    }

    public function delete()
    {

    }
}