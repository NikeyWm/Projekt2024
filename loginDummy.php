<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['benutzername'] = 'testuser';
header('Location: startseite.php');
exit();