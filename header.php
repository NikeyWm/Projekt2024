<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="header.css">
</head>
<body>
    <?php  
    require_once('dbconnenction.php');
    session_start();
    ?>
    <header>
        <div class="logo">
            <img src="logo.png" alt="Logo">
            <span>CheckMate</span>
        </div>
        <nav>
            <ul>
                <li><a href="#">Todo List</a></li>
                <li><a href="#">Über uns</a></li>
                <li><a href="#">Kontakt</a></li>
            </ul>
        </nav>
        <div class="dropdown">
            <?php 
                $loggedIn = isset($_SESSION['benutzer']); // Beispiel für eine Login-Überprüfung
                $defaultOption = $loggedIn ? "Angemeldet" :"Anmelden";
            ?>
            <select>
                <option selected disabled><?php echo $defaultOption; ?></option>
                <?php if (!$loggedIn): ?>
                    <option value="" disabled selected hidden>Konto</option>
                    <option value="anmelden">Anmelden</option>
                    <option value="registrieren">Registrieren</option>
                <?php else: ?>
                    <option value="abmelden">Abmelden</option>
                <?php endif; ?>
            </select>
        </div>
    </header>
</body>
</html>