<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['benutzername'])) {
    header("Location: login.php");
    exit();
}
?>