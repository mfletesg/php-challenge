<?php

require_once './app/models/Task.php';
require_once './app/functions.php'; // Funciones genericas

class TaskController
{

    /**
     * Muestra la vista de listado de tareas.
     *
     * Esta función carga la vista principal de tareas desde el archivo `task.php`.
     * 
     * No recibe parámetros ni devuelve datos; simplemente incluye un archivo de vista.
     */
    public function index()
    {
        require VIEWS_PATH . '/task.php';
    }
    

    /**
     * Obtiene todas tareas
     *
     * @return {json} - Regresa la informacion de las tareas en formato JSON
     * 
     */
    public function get()
    {
        $userId = $_SESSION['userId'];
        $responseDb = Task::getAll($userId);
        $response = ['message' => 'ok', 'data' => $responseDb];
        http_response_code(200);
        return json_encode($response);
    }

    /**
     * Crea una nueva tarea
     *
     * @return {json} - Regresa la informacion de la tarea en formato JSON
     * 
     */
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


    /**
     * Obtiene la tarea por su Id
     *
     * @param {$id} - Identificador de la tarea
     * @return {json} - Regresa la informacion de la tarea en formato JSON
     * 
     */
    public function getById(int $id)
    {
        $responseDb = Task::getById($id);
        $response = ['message' => 'ok', 'data' => $responseDb];
        http_response_code(200);
        return json_encode($response);
    }


    /**
     * Actualiza la tarea por su Id.
     *
     * Esta función espera recibir una solicitud HTTP con un cuerpo en formato JSON que contenga los siguientes parámetros:
     * - `taskId` (int): Identificador de la tarea que se desea actualizar.
     * - `title` (string): El nuevo título de la tarea.
     * - `description` (string): La nueva descripción de la tarea.
     * - `statusId` (int): El nuevo identificador de estado de la tarea.
     *
     * La función utiliza el ID del usuario de la sesión actual para realizar la actualización.
     *
     * @return {json} - Regresa un objeto JSON con la información actualizada de la tarea o un mensaje de error si la solicitud no es válida.
     */
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


    /**
     * Elimina la tarea por su Id.
     *
     * @param {$id} - La función utiliza el ID del la tarea para eliminarla
     *
     * @return {json} - Regresa un status HTTP 204
     */
    public function delete(int $id)
    {
        $responseDb = Task::delete($id);
        http_response_code(204);
        return null;
    }
}