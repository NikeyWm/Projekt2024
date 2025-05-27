<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST['submit'])) {
    if (!empty($_POST['benutzername']) && !empty($_POST['pw'])) {
        $benutzername = htmlspecialchars($_POST['benutzername']);
        $benutzername = trim($benutzername);
        $pw = htmlspecialchars($_POST['pw']);

        try {
            require_once('dbconnection.php');

            $stmt = $pdo->prepare("SELECT * FROM benutzer WHERE benutzername = :benutzername");
            $stmt->bindParam(':benutzername', $benutzername);
            $stmt->execute();

            $benutzer = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($benutzername) {
                if (password_verify($pw, $benutzer['pw'])) {
                    $_SESSION['benutzer'] = $benutzername;
                    $_SESSION['uid'] = $benutzer['uid'];
                    header('Location: startseite.php');
                    exit();
                } else {
                    echo('Falsches Passwort');
                }
            } else {
                echo('Benutzername nicht gefunden');
            }
        } catch (PDOException $e) {
            die('Fehler beim Anmelden');
        }
    } else {
        echo('Bitte alle Felder ausfüllen');
    }
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <?php include('header.php'); ?>


    <form action="<?php
    echo($_SERVER['SCRIPT_NAME']);
    ?>" method="post">

        <label for="benutzername">Benutzername</label>
        <input type="text" name="benutzername" id="benutzername" required><br>

        <label for="pw">Passwort</label>
        <input type="password" name="pw" id="pw" required><br><br>

        <input type="submit" name="submit" value="Login">
</body>
</html>

<?php
}?>