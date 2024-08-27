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
  <form class="form-signin" id="formSignin" action="<?= BASE_URL ?>/" method="post">
    <div class="text-center mb-4">
      <!-- <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> -->
      <h1 class="h3 mb-3 font-weight-normal">Please Sign In</h1>
    </div>

    <div class="form-label-group">
      <input type="text" id="inputUserName" name="inputUserName" class="form-control" placeholder="User Name" required
        autofocus>
      <label for="inputUserName">👤 User Name</label>
    </div>

    <div class="form-label-group">
      <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password"
        required>
      <label for="inputPassword">🔑 Password</label>
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>

    <br>
    <div class="text-center">
      <a href="<?= BASE_URL ?>/user">Register new user</a>
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