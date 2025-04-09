<?php
session_start();
require_once('dbconnection.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="startseite.css">
    <title>Startseite</title>
</head>

<body>
    <?php include('header.php'); ?>

    <h1>Willkommen bei CheckMate</h1>
    <h3>Hier können Sie Ihre Aufgaben verwalten.</h3>

    <p>Melden Sie sich hier an:</p>
    <button><a href="login.php">Login</a></button>

    <p>Oder registrieren Sie sich hier:</p>
    <button><a href="registrierung.php">Registrierung</a></button>

    <p>Kostenlos für immer</p>

    <div class="container">
        <div class="review">
            <h4>Güllfred Buschl</h4>
            <p>⭐⭐⭐⭐⭐</p>
            <p>Super App! Hat mir sehr geholfen.</p>
        </div>
        <div class="review">
            <h4>Dominik Güllcnik</h4>
            <p>⭐⭐⭐⭐</p>
            <p>Sehr nützlich, aber könnte mehr Funktionen haben.</p>
        </div>
        <div class="review">
            <h4>Axel Hubmann</h4>
            <p>⭐⭐⭐⭐⭐</p>
            <p>Ich liebe es! Sehr benutzerfreundlich.</p>
        </div>
        <div class="review">
            <h4>Johannes Soldat</h4>
            <p>⭐</p>
            <p>Historisch betrachtet, sehr schwach!</p>
        </div>
        <div class="review">
            <h4>Simon Morschig</h4>
            <p>⭐⭐</p>
            <p>Äußerst unsympathische App.</p>
        </div>
        <div class="review">
            <h4>Alexandra Bugelnig</h4>
            <p>⭐⭐⭐⭐⭐</p>
            <p>Das habe ich von meinen Schülern erwartet ^^.</p>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 CheckMate | Alle Rechte vorbehalten</p>
        <p><a href="impressum.php">Impressum</a> | <a href="datenschutz.php">Datenschutz</a></p>
    </footer>

</body>

</html>