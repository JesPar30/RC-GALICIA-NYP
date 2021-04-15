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

  <link href="/assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/dist/css/sidebars.css" rel="stylesheet">

  <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
</head>

<body class="scrollarea">


<?php include('header.php'); ?>


  <div class="container mt-4" style="display: flex;flex-direction: column;text-align: center;">
    <h1>FR GALICIA</h1>
    <form action="/cargarnuevocliente.php" enctype="multipart/form-data" method="POST" id="contactForm" name="contact-form">
      <div class="row justify-content-center">
        <script>
          function myFunction() {
            var ahorr = document.getElementById("ahorro");
            var paq = document.getElementById("paquet");
            var paquete = document.getElementById("paquete");
            if (paq.checked == true) {
              paquete.style.display = "block";
              window.location.replace("#paquete");
            } else {
              paquete.style.display = "none";
            }
          }
        </script>
        <script>
          function myFunction2() {
            var ahorr = document.getElementById("ahorro");
            var paq = document.getElementById("paquet");
            var paquete = document.getElementById("paquete");
            if (ahorr.checked == true) {
              paquete.style.display = "none";
              window.location.replace("#ahorr");
            } else {
              paquete.style.display = "block";
            }
          }
        </script>

        <div class="col-sm" id="ahorr">
          <div class="form-group label-floating mt-4">
            <input type="text" class="form-control mb-3" id="razonsocial" name="razonsocial" placeholder="RAZON SOCIAL">
            <input type="text" class="form-control mb-3" id="nombrefantasia" name="nombrefantasia" placeholder="NOMBRE DE FANTASIA">
            <input type="text" class="form-control mb-3" id="cuit" name="cuit" placeholder="CUIT">
            <select class="form-select mb-3" name="condafip" aria-label="Default select example">
              <option selected>Condicion ante AFIP</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
            <select class="form-select  mb-3" name="condiibb" aria-label="Default select example">
              <option selected>Condicion ante IIBB</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
            <input type="text" class="form-control mb-3" id="niibb" name="niibb" placeholder="Numero de IIBB">
            <input type="text" class="form-control mb-3" id="direccion" name="direccion" placeholder="Direccion del Comercio">
            <input type="text" class="form-control mb-3" id="cp" name="cp" placeholder="Codigo Postal">
            <input type="text" class="form-control mb-3" id="localidad" name="localidad" placeholder="Localidad">
            <input type="text" class="form-control mb-3" id="telefono" name="telefono" placeholder="Telefono Celular">
          </div>
        </div>


        <div class="col-sm">
          <div class="form-group label-floating mt-4">
          <input type="text" class="form-control mb-3" id="email" name="email" placeholder="Email">
            <input type="text" class="form-control mb-3" id="actcomer" name="actcomer" placeholder="Actividad Comercial">
            <input type="text" class="form-control mb-3" id="sucursal" name="sucursal" placeholder="Sucursal">


            <div class="form-group label-floating ">
              <label for="exampleFormControlInput1" class="form-label">Producto Ofrecido</label>
              <BR></BR>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="cajopack" onclick="myFunction2()" id="ahorro" value="CAJA DE AHORRO">
                <label class="form-check-label" for="inlineRadio1">CAJA DE AHORRO</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="cajopack" onclick="myFunction()" id="paquet" value="PAQUETE">
                <label class="form-check-label" for="inlineRadio2">PAQUETE</label>
              </div>
            </div>
            <br>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="inlineRadio2" style="font-weight: bold;">ADJUNTAR DNI</label>
              </div>
            <div class="input-group mb-3">
              <label class="input-group-text" for="dnifrente">DNI FRENTE</label>
              <input type="file" class="form-control" name="dnifrente" id="dnifrente">
            </div>
            <div class="input-group mb-3">
              <label class="input-group-text" for="dnidorso" >DNI DORSO</label>
              <input type="file" class="form-control" name="dnidorso" id="dnidorso">
            </div>

            <div class="form-submit mt-5">
                <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit" id="submit">
                  <i class="material-icons mdi mdi-message-outline"></i>Enviar</button>
                <div id="msgSubmit" class="h3 text-center hidden"></div>
                <div class="clearfix"></div>
              </div>
          </div>
        </div>

        <div class="col-sm" id="paquete" style="display: none;">
          <div class="form-group label-floating mt-4">

            <select class="form-select" name="productoofrecido" id="productoofrecido" aria-label="Default select example">
              <option value="" selected>PRODUCTO OFRECIDO</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
          </div>
          <div class="form-group label-floating">
            <label for="exampleFormControlInput1" class="form-label">ADICIONAL 1</label>
            <input type="text" class="form-control mb-2" id="nyaad1" name="nyaad1" placeholder="NOMBRE Y APELLIDO">
            <input type="text" class="form-control" id="dniad1" name="dniad1" placeholder="DNI">
          </div>
          <div class="form-group label-floating">
            <label for="exampleFormControlInput1" class="form-label">ADICIONAL 2</label>
            <input type="text" class="form-control mb-2" id="nyaad2" name="nyaad2" placeholder="NOMBRE Y APELLIDO">
            <input type="text" class="form-control" id="dniad2" name="dniad2" placeholder="DNI">
          </div>
          <div class="form-group label-floating">
            <label for="exampleFormControlInput1" class="form-label">ADICIONAL 3</label>
            <input type="text" class="form-control mb-2" id="nyaad3" name="nyaad3" placeholder="NOMBRE Y APELLIDO">
            <input type="text" class="form-control" id="dniad3" name="dniad3" placeholder="DNI">
          </div>
          <div class="form-group label-floating mb-4">
            <label for="exampleFormControlInput1" class="form-label">ADICIONAL 4</label>
            <input type="text" class="form-control mb-2" id="nyaad4" name="nyaad4" placeholder="NOMBRE Y APELLIDO">
            <input type="text" class="form-control" id="dniad4" name="dniad4" placeholder="DNI">
          </div>
        </div>
      </div>
    </form>
  </div>

  <script src="/assets/dist/js/bootstrap.bundle.min.js"></script>

<script src="/assets/dist/js/sidebars.js"></script>
</body>

</html>