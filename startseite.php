<?php
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

    <div class="bodyOhneHeader">
        <h1>Willkommen bei CheckMate</h1>
        <h3>Hier können Sie Ihre Aufgaben verwalten.</h3>

        <p>Melden Sie sich hier an:</p>
        <button><a href="login.php">Login</a></button>

        <p>Oder registrieren Sie sich hier:</p>
        <button><a href="registrieren.php">Registrierung</a></button>

        <p>Kostenlos für immer</p>

        <div class="container">
            <div class="review"
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
                <p>Eusterst unsümpatische App.</p>
            </div>
            <div class="review">
                <h4>Alexandra Bugelnig</h4>
                <p>⭐⭐⭐⭐⭐</p>
                <p>Das habe ich von meinen Schülern erwartet ^^.</p>
            </div>
        </div>

        <?php include('footer.php'); ?>
    </div>

    <script>
        let inputBuffer = "";

        document.addEventListener("keydown", (e) => {
            inputBuffer += e.key.toLowerCase();
            inputBuffer = inputBuffer.slice(-3);

            if (inputBuffer === "rgb") {
                startRGBEffect();
                inputBuffer = "";
            }
        });

        function startRGBEffect() {
            const bodyElement = document.querySelector('.bodyOhneHeader');
            bodyElement.classList.add("easteregg");

            setTimeout(() => {
                bodyElement.classList.remove("easteregg");
            }, 10000);
        }
    </script>
<button id="skibidiButton" style="display: none; position: fixed; bottom: 50px; right: 50px; padding: 20px; background-color: red; color: white; font-size: 20px; border: none; border-radius: 10px; z-index: 9999;">
  Skibidi Time
</button>
<script>
let typed = "";
const secret = "skibidi";
const button = document.getElementById("skibidiButton");

// Zeige Knopf nach Tastenkombi
document.addEventListener("keydown", function(e) {
    typed += e.key.toLowerCase();
    if (typed.length > secret.length) typed = typed.slice(-secret.length);
    if (typed === secret) {
        button.style.display = "block";
    }
});

// Ändere Cursor bei Klick
button.addEventListener("click", function() {
    document.body.classList.add("cursor-skibidi");
});
</script>
</body>

</html>