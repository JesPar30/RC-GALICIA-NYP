<?php
include 'conn.php';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
//declaramos como variables a los campos de texto del formulario.

$razonsocial = $_POST["razonsocial"];
$nombrefantasia = $_POST["nombrefantasia"];
$cuit = $_POST['cuit'];
$condafip = $_POST['condafip'];
$condiibb = $_POST['condiibb'];
$niibb = $_POST['niibb'];
$direccion = $_POST['direccion'];
$cp = $_POST['cp'];
$localidad = $_POST['localidad'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$actcomer = $_POST['actcomer'];
$sucursal = $_POST['sucursal'];

$idejecutivo = $_SESSION['id'];
$nomenclaturaejecutivo = $_SESSION['nomenclatura'];

$name1       = basename($_FILES['dnifrente']['name']);
$temp_name1  = $_FILES['dnifrente']['tmp_name'];
$name2       = basename($_FILES['dnidorso']['name']);
$temp_name2  = $_FILES['dnidorso']['tmp_name'];

$img1='';
$img2='';

/*
$productoofrecido = $_POST['productoofrecido'];

$nyaad1 = $_POST['nyaad1'];
$dniad1 = $_POST['dniad1'];

$nyaad2 = $_POST['nyaad2'];
$dniad2 = $_POST['dniad2'];

$nyaad3 = $_POST['nyaad3'];
$dniad3 = $_POST['dniad3'];

$nyaad4 = $_POST['nyaad4'];
$dniad4 = $_POST['dniad4'];  */



if (isset($_POST['cajopack']) && $_POST['cajopack'] == 'CAJA DE AHORRO') {

  $location2 = 'public/files/'. $nomenclaturaejecutivo .'/CAJA DE AHORRO/';
  if (!file_exists($location2)) {
    mkdir($location2, 0777, true);
  }

  if (isset($name1) and !empty($name1) OR isset($name2) and !empty($name2)) {
    $location = 'public/files/'. $nomenclaturaejecutivo .'/CAJA DE AHORRO/' . $razonsocial . '/';
    $ubicacion = 'public/files/'. $nomenclaturaejecutivo .'/CAJA DE AHORRO/' . $razonsocial . '/';
    if (!file_exists($ubicacion)) {
      mkdir($ubicacion, 0777, true);
      echo "Carpeta $razonsocial creada";

    }


    $dn1sql = str_replace(' ', '+', $name1);
    $dn2sql = str_replace(' ', '+', $name2);

    if (basename($name1) !== '') {
      if (move_uploaded_file($temp_name1, $location . $dn1sql)) {
        rename($location . $dn1sql, $location . $razonsocial . ' - DNI FRENTE.jpg');
        $img1 = $ubicacion.$razonsocial . ' - DNI FRENTE.jpg';
      }
    }
    if (basename($name2) !== '') {
      if (move_uploaded_file($temp_name2, $location . $dn2sql)) {
        rename($location . $dn2sql, $location . $razonsocial . ' - DNI DORSO.jpg');
        $img1 = $ubicacion.$razonsocial . ' - DNI DORSO.jpg';
      }
    }
    $sql = "INSERT INTO fr (id_ejecutivo, nomenclaturaejecutivo, nombrefantasia, razonsocial, cuit, cond_rentas, n_brutos, cond_brutos, direccioncomercio, cp, localidad, telefonocelular, email, actividadcomercial, sucursal, productoofrecido, paquete, dnifrente, dnidorso) VALUES ('$idcli', '$img1', '$img2', '$img3', '$sector','$idcli','$ok1','$ok2','$ok3')";
    if (mysqli_query($conn, $sql) === TRUE) {
      echo "New record created successfully";
      echo 'File uploaded successfully';
    }


  }

  }else if (isset($_POST['cajopack']) && $_POST['cajopack'] == 'PAQUETE') {
    echo 'me gustan llos paquetes';
  }
  