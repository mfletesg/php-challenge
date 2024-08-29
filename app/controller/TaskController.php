<?php

require_once './app/models/Task.php';
require_once './app/functions.php'; // Funciones genericas

class TaskController
{
    public function index()
    {
        require VIEWS_PATH . '/task.php';
    }

    public function get()
    {
        $userId = $_SESSION['userId'];
        $responseDb = Task::getAll($userId);
        $response = ['message' => 'ok', 'data' => $responseDb];
        http_response_code(200);
        return json_encode($response);
    }

    public function create()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $userId = $_SESSION['userId'];

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

        $responseDb = Task::create($userId, $title, $description, $statusId);

        $response = ['message' => 'Tarea creada correctamente', 'data' => $responseDb];
        http_response_code(201);
        return json_encode($response);

    }

    public function getById(int $id)
    {
        $responseDb = Task::getById($id);
        $response = ['message' => 'ok', 'data' => $responseDb];
        http_response_code(200);
        return json_encode($response);
    }


    public function update()
    {

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $userId = $_SESSION['userId'];

        if (!$data || !isset($data) || !isset($data)) {
            http_response_code(400);
            return json_encode(['error' => 'La peticion debe ser de tipo JSON']);
        }
        

        $taskId = $data['taskId'];
        $title = $data['title'];
        $description = $data['description'];
        $statusId = $data['statusId'];

        if ($title === '' || $description === '' || $statusId === '') {
            http_response_code(400);
            return json_encode(['error' => 'Faltan campos obligatorios: title, description, statusId']);

        }


        $responseDb = Task::update($userId, $taskId, $title, $description, $statusId);
        $response = ['message' => 'ok', 'data' => $responseDb];
        http_response_code(200);
        return json_encode($response);
    }

    public function delete(int $id)
    {
        $responseDb = Task::delete($id);
        http_response_code(204);
        return null;
    }
}