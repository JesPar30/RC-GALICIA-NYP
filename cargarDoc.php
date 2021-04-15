<?php
session_start();
?>


<?php
include 'conn.php';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';



// Connection variables
$usmail = "";
$uscontra = "";
$uso = "";
$fechult = "";
$idemailusado = "";
//declaramos como variables a los campos de texto del formulario.
$idcli = $_POST["id"];
$idcli2 = $_POST["id2"];
$sector = $_POST['provincia'];
$clienteMail = $_POST['mcliente'];
$tele = $_POST['telefono'];
$coment = $_POST['comentario'];
$tipi = $_POST['tipificacion'];
$tipi2 = $_POST['tipificacion2'];
$vidsql = '';
$dissql = '';
$ticksql = '';
$img1 = '';
$img2 = '';
$img3 = '';

$ok1 = '';
$ok2 = '';
$ok3 = '';
if (!isset($_POST['myCheck'])) {

  if (isset($_POST['submit'])) {
    $name1       = basename($_FILES['fotovid']['name']);
    $temp_name1  = $_FILES['fotovid']['tmp_name'];
    $name2       = basename($_FILES['fotodis']['name']);
    $temp_name2  = $_FILES['fotodis']['tmp_name'];
    $name3       = basename($_FILES['fototick']['name']);
    $temp_name3  = $_FILES['fototick']['tmp_name'];

    $sql4 = "UPDATE clientes SET gestionado = '1', telefono='" . $tele . "', mail='" . $clienteMail . "', TIPIFICACION='" . $tipi2 . "', comentarios='" . $coment . "' WHERE id='" . $idcli . "' ";
    $result4 = $conn->query($sql4);

    $location2 = 'public/files/' . $sector . '/';
    if (!file_exists($location2)) {
      mkdir($location2, 0777, true);
    }

    if (isset($name1) and !empty($name1) OR isset($name2) and !empty($name2) OR isset($name3) and !empty($name3)) {
      $location = 'public/files/' . $sector . '/' . $idcli . '/';
      $ubicacion = 'public/files/' . $sector . '/' . $idcli . '/';
      if (!file_exists($ubicacion)) {
        mkdir($ubicacion, 0777, true);
        echo "Carpeta $idcli creada";

      }


      $visdql = str_replace(' ', '+', $name1);
      $dissql = str_replace(' ', '+', $name2);
      $ticksql = str_replace(' ', '+', $name3);

      if (basename($name1) !== '') {
        if (move_uploaded_file($temp_name1, $location . $visdql)) {
          rename($location . $visdql, $location . $idcli . ' - Vidriera.jpg');
          $img1 = $ubicacion.$idcli . ' - Vidriera.jpg';
          $ok1 = 'OK';
        }
      }
      if (basename($name2) !== '') {
        if (move_uploaded_file($temp_name2, $location . $dissql)) {
          rename($location . $dissql, $location . $idcli . ' - Display.jpg');
          $img2 = $ubicacion.$idcli . ' - Display.jpg';
          $ok2 = 'OK';
        }
      }
      if (basename($name3) !== '') {
        if (move_uploaded_file($temp_name3, $location . $ticksql)) {
          rename($location . $ticksql, $location . $idcli . ' - Ticket.jpg');
          $img3 = $ubicacion.$idcli . ' - Ticket.jpg';
          $ok3 = 'OK';
        }
      }


        $sql = "INSERT INTO descargas (nombreDoc, fotovidriera, fotodisplay, fototicket, sector,carpeta,respaldovidriera,respaldodisplay,respaldoticket) VALUES ('$idcli', '$img1', '$img2', '$img3', '$sector','$idcli','$ok1','$ok2','$ok3')";
        if (mysqli_query($conn, $sql) === TRUE) {
          echo "New record created successfully";
          echo 'File uploaded successfully';

          // Instantiation and passing `true` enables exceptions
          $mail = new PHPMailer(true);

          //variables mail




          $sql2 = "SELECT MIN(id) as id,mail,contrasena,uso,fecha_ult_uso FROM emails WHERE uso<'400' ";
          $result2 = $conn->query($sql2);
          if ($result2->num_rows > 0) {
            // output data of each row
            while ($row2 = $result2->fetch_assoc()) {
              $usmail = $row2["mail"];
              $uscontra = base64_decode($row2["contrasena"]);
              $uso = $row2["uso"];
              $fechult = $row2["fecha_ult_uso"];
              $idemailusado = $row2["id"];
            }
          } else {
            echo "0 results";
          }



          try {
            //Server settings
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtpout.secureserver.net';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = $usmail;                     // SMTP username
            $mail->Password   = $uscontra;                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom($usmail, 'CAPACITACIÓN LAPOS QR');
            $mail->addAddress($clienteMail);               // Name is optional

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'CAPACITACIÓN QR PRISMA';
            $mail->Body    = 'Video comercial: https://youtu.be/Si2IdnHlBs0    Video tutorial: https://youtu.be/yxZIwIPh_LI'; // <a href="https://youtu.be/yxZIwIPh_LI"><img src="https://railcom.com.ar/wp-content/uploads/2019/01/MAYMIN-1.png"/></a><br><a href="https://youtu.be/yxZIwIPh_LI"><img src="https://railcom.com.ar/wp-content/uploads/2019/01/MAYMIN-1.png"/></a>
            $mail->AltBody = '';

            $mail->send();
            echo 'Message has been sent';

            $usado = $uso + 1;

            $sql3 = "UPDATE emails SET uso='" . $usado . "' WHERE id='" . $idemailusado . "' ";
            $result3 = $conn->query($sql3);

?>

            <script>
              alert('Cliente gestionado y mail con capacitacion enviado!');
              window.location.href = '/';
            </script>

    <?php
          } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
          }
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
      
    } else {
      echo 'You should select a file to upload !!';
    }
  }
} else {
  $sql5 = "UPDATE clientes SET gestionado = '1' , TIPIFICACION='" . $tipi . "' WHERE id='" . $idcli2 . "' ";
  $result5 = $conn->query($sql5);
  if ($result5 === TRUE) {

    ?>
    <script>
      alert('CLIENTE ID: <?php echo htmlspecialchars($idcli2) ?>; TIPIFICADO: <?php echo htmlspecialchars($tipi) ?>');
      window.location.href = '/';
    </script>


  <?php
  } else {
  ?>
    <script>
      alert('Error tipificando, solicitar ayuda de sistemas');
      window.location.href = '/';
    </script>
<?php
  }
}
