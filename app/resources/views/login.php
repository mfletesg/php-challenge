<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  include './app/resources/template.php';
  ?>
  <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/login.css" crossorigin="anonymous">
  <title>Login</title>
</head>

<body>
  <form class="form-signin" id="formSignin" action="<?= BASE_URL ?>/" method="post" autocomplete="off">
    <div class="text-center mb-4">
      <h1 class="h3 mb-3 font-weight-normal">Iniciar Sesion</h1>
    </div>

    <div class="form-label-group">
      <input type="text" id="inputUserName" name="inputUserName" class="form-control" placeholder="User Name" required
        autofocus maxlength="60">
      <label for="inputUserName">👤 Nombre de Usuario</label>
    </div>

    <div class="form-label-group">
      <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" autocomplete="new-password"
        required maxlength="100">
      <label for="inputPassword">🔑 Contraseña</label>
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar Sesion</button>

    <br>
    <div class="text-center">
      <a href="<?= BASE_URL ?>/user">Registrar nuevo usuario</a>
      <p class="mt-5 mb-3 text-muted">Miguel Fletes</b>
    </div>


    <?php
    // Mostrar el mensaje si existe en la sesión
    if (isset($_SESSION['message'])) {
      echo '<div class="alert alert-warning" role="alert">' . $_SESSION["message"] . '</div>';
    }
    ?>

  </form>

</body>

</html>