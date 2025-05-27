<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['benutzer'])) {
    header("Location: login.php");
    exit();
}
?>