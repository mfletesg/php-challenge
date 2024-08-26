<?php

require_once './app/models/Auth.php';
require_once './app/models/User.php';
require_once './app/functions.php'; // Funciones genericas

class AuthController
{

  public function index()
  {
    require VIEWS_PATH . '/login.php';
  }

  public function login()
  {
    // unset($_SESSION['message']);
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $userName = isset($_POST['inputUserName']) ? $_POST['inputUserName'] : null;
      $password = isset($_POST['inputPassword']) ? $_POST['inputPassword'] : null;

      if ($userName === null || $password === null) {
        require VIEWS_PATH . '/login.php';  exit();
      }

      $response = User::getUserByUserName($userName);

      if ($response === null) {
        $_SESSION['message'] = "El usuario o la constraseña son incorrectos1";
        require VIEWS_PATH . '/login.php';  exit();
      }

      $passwordDecript = decrypt($response->password);

      print_r($passwordDecript);

      if($passwordDecript !== $password){
        $_SESSION['message'] = "El usuario o la constraseña son incorrectos2";
        require VIEWS_PATH . '/login.php';  exit();
      }

      session_start();
      session_regenerate_id();
      $_SESSION['loggedin'] = true;
      $_SESSION['username'] = $response->username;
      $_SESSION['id'] = $response->id;

      header('Location:' . BASE_URL . '/task'); exit();
    }

    else{
      header('Location:' . BASE_URL . '/'); exit();
    }

  }


}