<?php
session_start();
?>


<?php 

include 'conn.php';	
			
// Connection variables
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}   
      
 //declaramos como variables a los campos de texto del formulario.
 $nombre=$_POST["username"];
 $password=base64_encode($_POST["password"]);

 //Consulta del usuario y el password
 $result = mysqli_query($conn, "SELECT * FROM users WHERE user='$nombre' and pass='$password'");
$row = mysqli_fetch_assoc($result);


 $hash = $row['pass'];
 //Si existe el usuario lo va a redireccionar a la pagina de Bienvenida.
 if ($password = $hash) {	
				
    $_SESSION['loggedin'] = true;
    $_SESSION['id'] = $row['id'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['privilegio'] = $row['privilegio'];
    $_SESSION['avatar'] = $row['avatar'];
    $_SESSION['nomenclatura'] = $row['nomenclatura'];
    $_SESSION['puesto'] = $row['puesto'];
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (9600 * 60) ;	

    header ("Location:index.php"); 

} else {
    echo "<div class='alert alert-danger mt-4' role='alert'>Usuario o Contraseña incorrecta
    <p><a href='index.php'><strong>Intenta de nuevo!</strong></a></p></div>";
}	
?>