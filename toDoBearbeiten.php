<?php
require_once('authCheck.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('dbconnection.php');

if (!isset($_GET['tid'])) {
    die("Keine ToDo-ID angegeben.");
}

$tid = (int)$_GET['tid'];
$uid = $_SESSION['uid'];

// Aufgabe abrufen
$stmt = $pdo->prepare("SELECT * FROM aufgaben WHERE tid = ? AND uid = ?");
$stmt->execute([$tid, $uid]);
$aufgabe = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$aufgabe) {
    die("Aufgabe nicht gefunden oder gehört nicht dir.");
}

// Aktualisieren
if (isset($_POST['update'])) {
    $titel = htmlspecialchars($_POST['titel']);
    $beschreibung = htmlspecialchars($_POST['beschreibung']);
    $datum = htmlspecialchars($_POST['datum']);

    $stmt = $pdo->prepare("UPDATE aufgaben SET titel = ?, beschreibung = ?, datum = ? WHERE tid = ? AND uid = ?");
    $stmt->execute([$titel, $beschreibung, $datum, $tid, $uid]);

    header("Location: toDoAnzeigen.php");
    exit();
}

// Löschen
if (isset($_POST['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM aufgaben WHERE tid = ? AND uid = ?");
    $stmt->execute([$tid, $uid]);

    header("Location: toDoAnzeigen.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>ToDo bearbeiten</title>
    <link rel="stylesheet" href="toDoHinzufuegen.css">
</head>
<body>
    <?php include('header.php'); ?>

    <div>
        <form method="POST">
            <h1>ToDo bearbeiten</h1>

            <label for="titel">Titel:</label>
            <input type="text" id="titel" name="titel" value="<?php echo htmlspecialchars($aufgabe['titel']); ?>" required>

            <label for="beschreibung">Beschreibung:</label>
            <textarea id="beschreibung" name="beschreibung" required><?php echo htmlspecialchars($aufgabe['beschreibung']); ?></textarea>

            <label for="datum">Datum:</label>
            <input type="date" name="datum" id="datum" value="<?php echo substr($aufgabe['datum'], 0, 10); ?>" required>

            <div style="display: flex; gap: 10px; margin-top: 10px;">
                <input type="submit" name="update" value="Speichern">
                <input type="submit" name="delete" value="Löschen" onclick="return confirm('Bist du sicher, dass du diese Aufgabe löschen möchtest?');">
            </div>
        </form>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>