<?php
session_start();
if (!isset($_SESSION['benutzer'])) {
    header("Location: login.php");
    exit(); 
}else{
session_unset();
session_destroy();
header("Location: login.php");
exit();
}
?>