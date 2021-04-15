<?php
// start a session
session_start();

if (isset($_SESSION['loggedin'])) {
} else {
  echo "<div class='alert alert-danger mt-4' role='alert'>
    <h4>Necesitas iniciar sesion para acceder a esta pagina</h4>
    <p><a href='index.php'>Inicia sesión acá</a></p></div>";
  exit;
}
// checking the time now when check-login.php page starts
$now = time();
if ($now > $_SESSION['expire']) {
  session_destroy();
  echo "<div class='alert alert-danger mt-4' role='alert'>
    <h4>Tu sesión a expirado!</h4>
    <p><a href='index.php'>Inicia sesión acá</a></p></div>";
  exit;
}

?>
<!doctype html>
<html lang="es">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

  <title>Inicio</title>
</head>

<body>
  <?php include('header.php'); ?>


  <?php
  include 'conn.php';

  $rzon = "";
  $direc = "";
  $provin = "";
  $tele = "";
  $mail = "";
 $coment = "";
  // Connection variables
  $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  // Attempt select query execution
  $id = $_GET['id'];
  $id2 = $_GET['id'];
  $sql = "SELECT * FROM clientes WHERE id='$id'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      $rzon = $row["razon"];
      $direc = $row["direccion"];
      $provin = $row["sector"];
      $tele = $row["telefono"];
      $mail = $row["mail"];
      $coment = $row["comentarios"];
    }
  } else {
    echo "0 results";
  }
  $conn->close();
  ?>

  <section class="Material-contact-section section-padding section-dark">
    <div class="container-fluid">
      <!-- contact form -->
      <div class="d-flex justify-content-center h-100">
        <div class="col-md-4 wow animated fadeInLeft" data-wow-delay=".2s">
          <form action="/cargarnuevocliente.php" enctype="multipart/form-data" method="POST" id="contactForm" name="contact-form">


            <label for="myCheck">Capacitado:</label>
            <input type="checkbox" class="form-check-input" id="myCheck" onclick="myFunction()">
            <section id="nocp">
            <div class="form-group label-floating">
                <label class="control-label">ID</label>
                <input class="form-control" id="id2" type="text" name="id2" value="<?php echo htmlspecialchars($id2); ?>" required data-error="Please enter your message subject" readonly>
                <div class="help-block with-errors"></div>
              </div>
            <select id="tipificacion" name="tipificacion" class="form-select" aria-label="Default select example">
              <option selected></option>
              <option value="Comercio Inexistente">Comercio Inexistente</option>
              <option value="Rechazado por Comercio">Rechazado por Comercio</option>
              <option value="Comercio Cerrado Definitivamente">Comercio Cerrado Definitivamente</option>
            </select>
            </section>
            
            <script>
              function myFunction() {
                var checkBox = document.getElementById("myCheck");
                var cap = document.getElementById("capacitado");
                var nocap = document.getElementById("nocp");
                if (checkBox.checked == true) {
                  cap.style.display = "block";
                  nocap.style.display = "none";

                  document.getElementById("telefono").value = "<?php echo htmlspecialchars($tele) ?>";
                  document.getElementById("id").value = "<?php echo htmlspecialchars($id) ?>";
                  document.getElementById("id2").value = "";
                  document.getElementById("tipificacion").value = "";
                  document.getElementById("provincia").value = "<?php echo htmlspecialchars($provin) ?>";
                  document.getElementById("razon").value = "<?php echo htmlspecialchars($rzon) ?>";
                  document.getElementById("direccion").value = "<?php echo htmlspecialchars($direc) ?>";
                  document.getElementById("comentario").value = "<?php echo htmlspecialchars($coment) ?>";
                  document.getElementById("mcliente").value = "<?php echo htmlspecialchars($mail) ?>";
                } else {
                  cap.style.display = "none";
                  nocap.style.display = "block";

                  document.getElementById("telefono").value = "";
                  document.getElementById("id").value = "";
                  document.getElementById("id2").value = "<?php echo htmlspecialchars($id) ?>";
                  document.getElementById("provincia").value = "";
                  document.getElementById("tipificacion2").value = "";
                  document.getElementById("razon").value = "";
                  document.getElementById("direccion").value = "";
                  document.getElementById("comentario").value = "";
                  document.getElementById("mcliente").value = "";
                }
              }
            </script>
            <script>
              function myFunction2() {
                var checkBox = document.getElementById("myCheck");
                var cap = document.getElementById("capacitado");
                var nocap = document.getElementById("nocp");
                if (checkBox.checked == true) {
                  cap.style.display = "block";
                  nocap.style.display = "none";
                } else {
                  cap.style.display = "none";
                  nocap.style.display = "block";
                }
              }
            </script>


            <section id="capacitado" style="display: none;">
              <!-- RAZON SOCIAL -->
              <label for="identifik2">Señalizado:</label>
              <input type="checkbox" class="form-check-input" id="identifik2" onclick="myFunction2()">
              <div class="form-group label-floating">
                <label class="control-label">ID</label>
                <input class="form-control" id="id" type="text" name="id" required data-error="Please enter your message subject" readonly>
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group label-floating">
                <label class="control-label">RAZON SOCIAL</label>
                <input class="form-control" id="razon" type="text" name="razon" required data-error="Please enter your message subject" readonly>
                <div class="help-block with-errors"></div>
              </div>

              <div class="form-group label-floating">
                <label class="control-label">Dirección</label>
                <input class="form-control" id="direccion" type="text" name="direccion" data-error="Please enter your message subject" readonly>
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group label-floating">
                <label class="control-label">Provincia</label>
                <input class="form-control" type="text" name="provincia" id="provincia" data-error="Please enter your message subject" readonly>
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group label-floating">
                <label class="control-label">Telefono</label>
                <input class="form-control" id="telefono" type="text" name="telefono" data-error="Please enter your message subject">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group label-floating">
                <label class="control-label">EMAIL CLIENTE</label>
                <input class="form-control" id="mcliente" type="email" name="mcliente" data-error="Please enter your message subject">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group label-floating">
                <label class="control-label">TIPIFICACIÓN</label>
              <select id="tipificacion2" name="tipificacion2" class="form-select" aria-label="Default select example">
              <option selected></option>
              <option value="Establecimiento OK">Establecimiento OK</option>
              <option value="Terminal defectuosa">Terminal defectuosa</option>
              <option value="QR ACTIVADO EN TERMINAL DIFERENTE">QR ACTIVADO EN TERMINAL DIFERENTE</option>
              <option value="No hay terminal en el establecimiento">No hay terminal en el establecimiento</option>
              <option value="QR NO OPERATIVO">QR no operativo</option>
            </select>
            <div class="help-block with-errors"></div>
              </div>
              <div class="form-group label-floating">
                <label class="control-label">COMENTARIOS (MAXIMO 250 CARÁCTERES)</label>
                <textarea class="form-control" id="comentario" name="comentario" maxlength="250" aria-label="With textarea"></textarea>
                <div class="help-block with-errors"></div>
              </div>

              <div class="form-group label-floating">
                <div class="input-group mt-3 mb-3">
                  <label class="input-group-text" for="inputGroupFile01">Foto Vidriera</label>
                  <input type="file" class="form-control" id="fotovid" name="fotovid">
                </div>
                <div class="input-group mb-3">
                  <label class="input-group-text" for="inputGroupFile01">Foto Display</label>
                  <input type="file" class="form-control" id="fotodis" name="fotodis">
                </div>
                <div class="input-group mb-3">
                  <label class="input-group-text" for="inputGroupFile01">Foto Ticket</label>
                  <input type="file" class="form-control" id="fototick" name="fototick">
                </div>
              </div>
              </section>
              <div class="form-submit mt-5">
                <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit" id="submit">
                  <i class="material-icons mdi mdi-message-outline"></i>Enviar</button>
                <div id="msgSubmit" class="h3 text-center hidden"></div>
                <div class="clearfix"></div>
              </div>
          </form>
        </div>
      </div>
    </div>
 
  </section>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->

</body>

</html>