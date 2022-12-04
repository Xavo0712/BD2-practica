<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/BD2-practica/assets/styles/styles1.css">
    <link rel="scriptsheet" href="scripts.js">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="register" href="register.php">
    <title>Registrat</title>
</head>

<body>

    <?php
    $locNom = $_GET['nom'];
    $locTelf = $_GET['telefon'];
    $locCorr = $_GET['correu'];
    $locNick = $_GET['nomUsuari'];
    $locCont = $_GET['contrassenya'];

    $con = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($con, "bd201");
    $consulta = "INSERT INTO usuari (nom, contrasenya, telefon, correu, username) VALUES ('" . $locNom . "','" . $locCont . "','" . $locTelf . "','" . $locCorr . "','" . $locNick . "')";
    $resultado = mysqli_query($con, $consulta);
    ?>

    <div class="main">
        <p class="sign" align="center">Usuari registrat correctament</p>
        <a href="/BD2-practica/<?php echo basename(__DIR__) ?>/login.php" id="torn">Tornar a Login</a>
    </div>

</body>
</html>