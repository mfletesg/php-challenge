<?php

require_once './app/models/Status.php';

class StatusController
{

    /**
     * Obtiene todos los estados de la tarea
     *
     * @return {json} - Regresa la informacion de los estados de la tarea en formato JSON
     * 
     */
    public function get()
    {
        $responseDb = Status::getAll();
        $response = ['message' => 'ok', 'data' => $responseDb];
        http_response_code(200);
        return json_encode($response);
    }
}