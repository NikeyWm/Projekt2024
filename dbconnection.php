<?php
try {
    $dns = "mysql:host=localhost;dbname=checkmate;charset=utf8";
    $pdo = new PDO($dns, 'root', '');
} catch (PDOException $e) {
    die("Fehler bei der Verbindung zur Datenbank: " . $e->getMessage());
}
?>