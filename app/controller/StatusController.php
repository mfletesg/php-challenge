<?php

require_once './app/models/Status.php';

class StatusController
{
    public function get()
    {
        $responseDb = Status::getAll();
        $response = ['message' => 'ok', 'data' => $responseDb];
        http_response_code(200);
        return json_encode($response);
    }
}