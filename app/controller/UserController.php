<?php

require_once './app/models/User.php';
require_once './app/functions.php'; // Funciones genericas

class UserController
{

    /**
     * Esta función carga la vista para crear un nuevo usuario `registerUser.php`.
     * 
     * No recibe parámetros ni devuelve datos; simplemente incluye un archivo de vista.
     */
    public function index()
    {
        $posts = Auth::get();
        require VIEWS_PATH . '/registerUser.php';
    }


    /**
     * Crea un nuevo usuario
     * Esta función espera recibir una solicitud HTTP POST y contiene los siguientes parámetros:
     * - `inputUserName` (string): Nombre de usuario.
     * - `inputPassword` (string): Contraseña.
     * - `inputConfirmPassword` (string): Contraseña de confirmación.
     * Verifica los datos del usuario y si es correcta crea la sesión y redirecciona a la vista de `task.php`
     */
    public function create()
    {
        unset($_SESSION['message']);

        $userName = $_POST['inputUserName'] ?? null;
        $password = $_POST['inputPassword'] ?? null;
        $confirmPassword = $_POST['inputConfirmPassword'] ?? null;

        if ($userName === null || $password === null || $confirmPassword === null) {
            header('Location:' . BASE_URL . '/');
            exit();
        }

        if ($password !== $confirmPassword) {
            $_SESSION['message'] = "La constraseña no coincide";
            require VIEWS_PATH . '/registerUser.php';
            exit();
        }

        $user = User::getUserByUserName($userName);

        if ($user !== null) {
            $_SESSION['message'] = "El nombre de usuario '{$user->username}' ya existe en el sistema";
            require VIEWS_PATH . '/registerUser.php';
            exit();
        }

        $responseDb = User::create($userName, encrypt($password));

        header('Location:' . BASE_URL . '/');
        exit();

    }

}