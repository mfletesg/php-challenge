<?php

require_once './app/models/User.php';
require_once './app/functions.php'; // Funciones genericas

class UserController {

    public function index()
    {
        $posts = Auth::get();
        require VIEWS_PATH . '/registerUser.php';
    }

    public function create()
    {
        unset($_SESSION['message']);
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $userName           = isset($_POST['inputUserName']) ? $_POST['inputUserName'] : null;
            $password           = isset($_POST['inputPassword']) ? $_POST['inputPassword'] : null;
            $confirmPassword    = isset($_POST['inputConfirmPassword']) ? $_POST['inputConfirmPassword'] : null;

            if($userName === null || $password === null || $confirmPassword === null) {
                header('Location:' . BASE_URL . '/'); exit();
            }

            if($password !== $confirmPassword){
                $_SESSION['message'] = "La constraseña no coincide";
                require VIEWS_PATH . '/registerUser.php';  exit();
                // header('Location:' . BASE_URL . '/user'); exit();
            }

            $post = User::create($userName, encrypt($password));

            header('Location:' . BASE_URL . '/'); exit();

        }
        else{
            echo "La solicitud no es de tipo POST.";
        }
    }

    

}