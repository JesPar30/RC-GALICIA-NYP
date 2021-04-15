<?php include('header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RC Galicia NYP</title>
</head>
<body>

<div class="container-fluid mt-4">

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Central</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Enviadas</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Añadir</button>
  </li>
  
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="tifact-tab" data-bs-toggle="tab" data-bs-target="#tifact" type="tifact" role="tab" aria-controls="tifact" aria-selected="false">Restar</button>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane table-responsive fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  <?php
include 'conn.php';	
    
// Connection variables
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}      

$sql = "SELECT * FROM stock";
if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){?>
<table class="table table-striped">
<thead class="thead-dark">
    <tr>
      <th scope="col" class='text-center'>ULTIMA CARGA</th>
      <th scope="col" class='text-center'>Flyer</th>
      <th scope="col" class='text-center'>Sobre</th>
      <th scope="col" class='text-center'>Display</th>
      <th scope="col" class='text-center'>Colgante</th>
      <th scope="col" class='text-center'>Calco Bifaz</th>
      <th scope="col" class='text-center'>Calco Aceptación</th>
      <th scope="col" class='text-center'>KIT 40</th>
    </tr>
  </thead>
  <tbody>
  <?php
  while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td class='text-center'>" . $row['fecha_gestion'] . "</td>";
            echo "<td class='text-center'>" . $row['flyer'] . "</td>";
            echo "<td class='text-center'>" . $row['sobre'] . "</td>";
            echo "<td class='text-center'>" . $row['display'] . "</td>";
            echo "<td class='text-center'>" . $row['colgante'] . "</td>";
            echo "<td class='text-center'>" . $row['calco_bifaz'] . "</td>";
            echo "<td class='text-center'>" . $row['calco_aceptacion'] . "</td>";
            echo "<td class='text-center'>" . $row['kit40'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
?>
  
  
  </div>
  <div class="tab-pane table-responsive fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
  <?php
$sql2 = "SELECT * FROM log_stock as a INNER JOIN users as b ON a.u_asignado=b.id";
if($result2 = mysqli_query($conn, $sql2)){
    if(mysqli_num_rows($result2) > 0){?>
<table class="table table-striped">
<thead class="thead-dark">
    <tr>
      <th scope="col" class='text-center'>Usuario</th>
      <th scope="col" class='text-center'>Flyer</th>
      <th scope="col" class='text-center'>Sobre</th>
      <th scope="col" class='text-center'>Display</th>
      <th scope="col" class='text-center'>Colgante</th>
      <th scope="col" class='text-center'>Calco Bifaz</th>
      <th scope="col" class='text-center'>Calco Aceptación</th>
      <th scope="col" class='text-center'>KIT 40</th>
    </tr>
  </thead>
  <tbody>
  <?php
  while($row2 = mysqli_fetch_array($result2)){
            echo "<tr>";
            echo "<td class='text-center'>" . $row2['nombre'] . "</td>";
            echo "<td class='text-center'>" . $row2['flyer'] . "</td>";
            echo "<td class='text-center'>" . $row2['sobre'] . "</td>";
            echo "<td class='text-center'>" . $row2['display'] . "</td>";
            echo "<td class='text-center'>" . $row2['colgante'] . "</td>";
            echo "<td class='text-center'>" . $row2['calco_bifaz'] . "</td>";
            echo "<td class='text-center'>" . $row2['calco_aceptacion'] . "</td>";
            echo "<td class='text-center'>" . $row2['kit40'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result2);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql2. " . mysqli_error($link);
}
?>

  
  
  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
  
  <section class="Material-contact-section section-padding section-dark">
    <div class="container-fluid">
      <!-- contact form -->
      <div class="d-flex justify-content-center h-100">
        <div class="col-md-4 wow animated fadeInLeft" data-wow-delay=".2s">
          <form action="/anadirStock.php" enctype="multipart/form-data" method="POST" id="contactForm" name="contact-form">
              <div class="form-group label-floating">
                <label class="control-label">FLYERS</label>
                <input class="form-control" id="flyers" type="text" name="flyers" required data-error="Please enter your message subject">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group label-floating">
                <label class="control-label">SOBRES</label>
                <input class="form-control" id="sobres" type="text" name="sobres" data-error="Please enter your message subject">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group label-floating">
                <label class="control-label">COLGANTES</label>
                <input class="form-control" type="text" name="colgantes" id="colgantes" data-error="Please enter your message subject">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group label-floating">
                <label class="control-label">DISPLAYS</label>
                <input class="form-control" id="displays" type="text" name="displays" data-error="Please enter your message subject">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group label-floating">
                <label class="control-label">CALCO BIFAZ</label>
                <input class="form-control" id="calcobifaz" type="text" name="calcobifaz" data-error="Please enter your message subject">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group label-floating">
                <label class="control-label">CALCO ACEPTACION</label>
                <input class="form-control" id="calcoaceptacion" type="text" name="calcoaceptacion" data-error="Please enter your message subject">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group label-floating">
                <label class="control-label">KIT 40</label>
                <input class="form-control" id="kit40" type="text" name="kit40" data-error="Please enter your message subject">
                <div class="help-block with-errors"></div>
              </div>

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
  
  </div>
  
 
 <div class="tab-pane fade" id="tifact" role="tabpanel" aria-labelledby="tifact-tab">
 <section class="Material-contact-section section-padding section-dark">
    <div class="container-fluid">
      <!-- contact form -->
      <div class="d-flex justify-content-center h-100">
        <div class="col-md-4 wow animated fadeInLeft" data-wow-delay=".2s">
          <form action="/restarStock.php" enctype="multipart/form-data" method="POST" id="contactForm" name="contact-form">
              <div class="form-group label-floating">
                <label class="control-label">FLYERS</label>
                <input class="form-control" id="flyers2" type="text" name="flyers2" required data-error="Please enter your message subject">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group label-floating">
                <label class="control-label">SOBRES</label>
                <input class="form-control" id="sobres2" type="text" name="sobres2" data-error="Please enter your message subject">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group label-floating">
                <label class="control-label">COLGANTES</label>
                <input class="form-control" type="text" name="colgantes2" id="colgantes2" data-error="Please enter your message subject">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group label-floating">
                <label class="control-label">DISPLAYS</label>
                <input class="form-control" id="displays2" type="text" name="displays2" data-error="Please enter your message subject">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group label-floating">
                <label class="control-label">CALCO BIFAZ</label>
                <input class="form-control" id="calcobifaz2" type="text" name="calcobifaz2" data-error="Please enter your message subject">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group label-floating">
                <label class="control-label">CALCO ACEPTACION</label>
                <input class="form-control" id="calcoaceptacion2" type="text" name="calcoaceptacion2" data-error="Please enter your message subject">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group label-floating">
                <label class="control-label">KIT 40</label>
                <input class="form-control" id="kit402" type="text" name="kit402" data-error="Please enter your message subject">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
    <label for="exampleInputPassword1">Usuario</label>
    <select name="nomenclatura" class="form-select" id="nomenclatura">
<?php 
$sql = mysqli_query($conn, "SELECT * FROM users");
while ($row = $sql->fetch_assoc()){
echo "<option value='". $row['id'] ."'>" . $row['nombre'] . "</option>";
}
?>
</select>

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
  
  </div>
</div>

</div>
    
    
</body>
</html>