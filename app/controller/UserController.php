<?php

require './app/models/User.php';
require './app/functions.php'; // Funciones genericas

class UserController {

    public function index()
    {
      $posts = Auth::get();
      $encript = encrypt('123', 'sss');
      echo decrypt($encript, 'sss');
      require VIEWS_PATH . '/registerUser.php';
    }

    public function create()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userName = isset($_POST['inputUserName']) ? $_POST['inputUserName'] : null;
            $password = isset($_POST['inputPassword']) ? $_POST['inputPassword'] : null;
            $confirmPassword = isset($_POST['inputConfirmPassword']) ? $_POST['inputConfirmPassword'] : null;

            $post = User::create($userName, $password);

        }
        else{
            echo "La solicitud no es de tipo POST.";
        }
    }

}