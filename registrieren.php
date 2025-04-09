<?php

if (isset($_POST['submit'])) {
    if (!empty($_POST['benutzername']) && !empty($_POST['pw']) && !empty($_POST['pwb'])) {
        $benutzername = htmlspecialchars($_POST['benutzername']);
        $benutzername = trim($benutzername);
        $pw = htmlspecialchars($_POST['pw']);
        $pwb = htmlspecialchars($_POST['pwb']);

        if ($_POST['pw'] == $_POST['pwb']) {
            
            if (strlen($pw) >= 4) {
                
                require('dbconnection.php');
    
            try {

                $stmt = $pdo->prepare("SELECT * FROM benutzer WHERE benutzername = :benutzername");
                $stmt->bindParam(':benutzername', $benutzername);
                $stmt->execute();
                $userExists = $stmt->fetchColumn();

                if ($userExists) {
                    die('Benutzername bereits vergeben');
                }

                $pw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
    
                $stmt = $pdo -> prepare ("INSERT INTO benutzer (benutzername, pw) VALUES (:benutzername, :pw)");
    
                $stmt -> bindParam(':benutzername', $benutzername);
                $stmt -> bindParam(':pw', $pw);
    
                $stmt -> execute();
                header('Location: login.php');
                exit();
            } catch (PDOException $e) {
                die('Fehler beim Registrieren');
            }
            } else {
                echo('Passwort zu kurz');
            }

        } else {
            echo('Passwörter stimmen nicht überein');
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
    <link rel="stylesheet" href="login.css">
    <title>Document</title>
</head>
<body>
    <?php include('header.php'); ?>
    <form action="<?php
    echo($_SERVER['SCRIPT_NAME']);
    ?>" method="post">

        <label for="benutzername">Benutzername</label>
        <input type="text" name="benutzername" id="benutzername" required><br>

        <label for="pw">Passwort</label>
        <input type="password" name="pw" id="pw" required><br>

        <label for="pwb">Passwort</label>
        <input type="password" name="pwb" id="pwb" required><br><br>

        <input type="submit" name="submit" value="Registrieren">

    </form>
</body>
</html>

<?php
}
?>