/* Destroy current user session */

<?php
session_start();
unset($_SESSION['username']);
session_destroy();

header('location: signin.php');
?>