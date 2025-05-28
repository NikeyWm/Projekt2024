<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="header.css">
    <?php include 'darkmode.php'; ?>

</head>

<body>

    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once('dbconnection.php');
    ?>
    <header>
        <div class="logo">
            <a href="startseite.php">
                <img src="logo.png" alt="Logo">
            </a>
            <span class="checkmate">CheckMate</span>
        </div>
        <nav>
            <ul>
                <li><a href="toDoAnzeigen.php">Todo List</a></li>
                <li><a href="datenschutz.php">Über uns</a></li>
                <li><a href="impressum.php">Kontakt</a></li>
            </ul>
        </nav>
        <div class="dropdown">

            <select onchange="if (this.value) window.location.href=this.value;">
                <?php if (isset($_SESSION['benutzer'])): ?>
                    <option disabled selected><?php echo ("$_SESSION[benutzer]") ?></option>
                <?php else: ?>
                    <option disabled selected>Konto</option>
                <?php endif; ?>
                <?php if (isset($_SESSION['benutzer'])): ?>
                    <option value="logout.php">Abmelden</option>
                <?php else: ?>
                    <option value="login.php">Anmelden</option>
                    <option value="registrieren.php">Registrieren</option>
                <?php endif; ?>
            </select>

        </div>
    </header>


</body>

</html>