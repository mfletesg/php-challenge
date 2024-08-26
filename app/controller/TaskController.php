<?php

require_once './app/functions.php'; // Funciones genericas

class TaskController
{
    public function index()
    {
        checkSession(); //Funcion para validar la session
        require VIEWS_PATH . '/task.php';
    }

    public function create()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $json = file_get_contents('php://input');
            $data = json_decode($json, true);

            print_r($data);
        }
        else{

        }
    }
}