<?php
require_once('authCheck.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('dbconnection.php');
if (isset($_POST['submit'])) {
    $stmt = $pdo->prepare("SELECT uid FROM benutzer WHERE benutzername = ?");
    $stmt->execute([$_SESSION['benutzer']]);
    $benutzer = $stmt->fetch(PDO::FETCH_ASSOC);
    $uid = $benutzer['uid'];

    $titel = htmlspecialchars($_POST['titel']);
    $beschreibung = htmlspecialchars($_POST['beschreibung']);
    $datum = htmlspecialchars($_POST['datum']);
    $fertig = 0;

    $stmt = $pdo->prepare("INSERT INTO aufgaben (titel, beschreibung, datum, fertig) VALUES (?, ?, ?, ?)");
    $stmt->execute([$titel, $beschreibung, $datum, $fertig]);

    header("Location: toDoAnzeigen.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="toDoHinzufuegen.css">
    <title>Neues ToDo</title>
</head>

<body>
    <?php include('header.php'); ?>

    <div>
        <form method="POST" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
            <h1>ToDo Hinzufügen</h1>

            <label for="titel">Titel:</label>
            <input type="text" id="titel" name="titel" required>

            <label for="beschreibung">Beschreibung:</label>
            <textarea id="beschreibung" name="beschreibung" required></textarea>

            <div class="wrapper"></div>
            <label for="datum">Datum:</label>
            <input type="date" name="datum" id="datum" autocomplete="off" required>

            <input type="submit" name="submit" id="submit" value="ToDo hinzufügen">
        </form>
    </div>
    
    <?php include('footer.php'); ?>
</body>

</html>