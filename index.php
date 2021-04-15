<?php
// start a session
session_start();

if (isset($_SESSION['loggedin'])) {
} else {
  echo "<div class='alert alert-danger mt-4' role='alert'>
    <h4>Necesitas iniciar sesion para acceder a esta pagina</h4>
    <p><a href='signin.php'>Inicia sesión acá</a></p></div>";
  exit;
}
// checking the time now when check-login.php page starts
$now = time();
if ($now > $_SESSION['expire']) {
  session_destroy();
  echo "<div class='alert alert-danger mt-4' role='alert'>
    <h4>Tu sesión a expirado!</h4>
    <p><a href='signin.php'>Inicia sesión acá</a></p></div>";
  exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC Galicia NYP</title>
</head>
<body class="scrollarea">
<?php include('header.php'); ?>
<div class="container mt-4">

<div class="jumbotron">
  <h1 class="display-4">Hello, @USUARIO!</h1>
<img class="img-fluid" src="/public/img/galicia-1.png" alt="">
  <hr class="my-4">
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="#" role="button">Cargá tus clientes!</a>
  </p>
</div>


</div>
    
    
</body>
</html>