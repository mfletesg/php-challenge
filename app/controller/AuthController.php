<?php

require_once './app/models/Auth.php';
require_once './app/models/User.php';
require_once './app/functions.php'; // Funciones genericas

class AuthController
{

  /**
   * Esta función carga la vista principal del login desde el archivo `login.php`.
   * 
   * No recibe parámetros ni devuelve datos; simplemente incluye un archivo de vista.
   */
  public function index()
  {
    require VIEWS_PATH . '/login.php';
  }


  /**
   * Valida el inicio de sesion.
   * Esta función espera recibir una solicitud HTTP POST y contiene los siguientes parámetros:
   * - `inputUserName` (string): Nombre de usuario.
   * - `inputPassword` (string): Contraseña.
   * Verifica los datos del usuario y si es correcta crea la sesión y redirecciona a la vista de `task.php`
   */
  public function login()
  {

    $userName = isset($_POST['inputUserName']) ? $_POST['inputUserName'] : null;
    $password = isset($_POST['inputPassword']) ? $_POST['inputPassword'] : null;

    if ($userName === null || $password === null) {
      require VIEWS_PATH . '/login.php';
      exit();
    }
    $response = User::getUserByUserName($userName);
    if ($response === null) {
      $_SESSION['message'] = "El usuario o la constraseña son incorrectos1";
      require VIEWS_PATH . '/login.php';
      exit();
    }
    $passwordDecript = decrypt($response->password);
    if ($passwordDecript !== $password) {
      $_SESSION['message'] = "El usuario o la constraseña son incorrectos2";
      require VIEWS_PATH . '/login.php';
      exit();
    }

    session_start();
    session_regenerate_id();
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $response->username;
    $_SESSION['userId'] = $response->id;

    header('Location:' . BASE_URL . '/task');
    exit();
  }


  /**
   * Cerrar Sesion.
   * Cierra la sesion y envia al `login.php`
   */
  public function logout()
  {
    session_start();
    session_destroy();
    header('Location:' . BASE_URL . '/');
  }


}