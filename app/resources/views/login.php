<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        include './app/resources/template.php';
    ?>
    <link rel="stylesheet" href="<?=BASE_URL?>/public/css/login.css"  crossorigin="anonymous">
    <title>Login</title>
</head>

<body>
<body class="text-center">
  
    <form class="form-signin" action="/<?=$url?>/login" method="post">
      <h1 class="h3 mb-3 font-weight-normal">Please Sign In</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>

      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <br>
      <a href="<?=BASE_URL?>/user">Register new user</a>

      <p class="mt-5 mb-3 text-muted">Miguel Fletes</p>
    </form>
  </body>
</body>

</html>