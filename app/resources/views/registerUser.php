<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        include './app/resources/template.php';
    ?>
    <link rel="stylesheet" href="<?=BASE_URL?>/public/css/login.css"  crossorigin="anonymous">
    <script src="<?=BASE_URL?>/public/js/registerUser.js"></script>
    <title>Create User</title>
</head>

<body>

    <form class="form-signin" id="registrationForm" action="<?=BASE_URL?>/user" method="post" onsubmit="registerUser.formValidate(event)" autocomplete="off">
      <div class="text-center mb-4">
        <h1 class="h3 mb-3 font-weight-normal">Crear Usuario</h1>
      </div>

      <div class="form-label-group">
        <input type="text" id="inputUserName" name="inputUserName" class="form-control" placeholder="User Name" required autofocus>
        <label for="inputUserName">👤 Nombre de Usuario</label>
      </div>

      <div class="form-label-group">
        <input type="password" id="inputPassword" name="inputPassword"  class="form-control" placeholder="Password" required autocomplete="new-password">
        <label for="inputPassword">🔑 Contraseña</label>
      </div>

      <div class="form-label-group">
        <input type="password" id="inputConfirmPassword" name="inputConfirmPassword" class="form-control" placeholder="Password" required autocomplete="new-password">
        <label for="inputConfirmPassword">🔑 Confirmar Contraseña</label>
      </div>

      <button class="btn btn-lg btn-primary btn-block" type="submit">Crear cuenta</button>

      <div class="text-center">
        <br>
          <a href="<?=BASE_URL?>">Return to login</a>
      </div>

      <p class="mt-5 mb-3 text-muted text-center">&copy; 2017-2018</p>

      <span id="passwordError" class="error"></span><br><br>

      <?php
        // Mostrar el mensaje si existe en la sesión
        if (isset($_SESSION['message'])) {
          echo '<div class="alert alert-warning" role="alert">'.$_SESSION["message"].'</div>';
        }
      ?>
    </form>

</body>

</html>