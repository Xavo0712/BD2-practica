<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/styles1.css">
    <link rel="scriptsheet" href="scripts.js">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="register" href="register.php">
    <title>Registrat</title>
</head>

<body>

    <?php
    $locNom = $_GET['nom'];
    $locApe = $_GET['llinatges'];
    $locNick = $_GET['nomUsuari'];
    $locCont = $_GET['contrassenya'];

    $con = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($con, "usuaristemporals");
    $consulta = "INSERT INTO persona (nom,llinatges,nomUsuari,contrassenya) VALUES ('" . $locNom . "','" . $locApe . "','" . $locNick . "','" . $locCont . "')";
    $resultado = mysqli_query($con, $consulta);
    ?>

    <div class="main">
        <p class="sign" align="center">Usuari registrat correctament</p>
        <a href="login.php" id="torn">Tornar a Login</a>
    </div>

</body>
</html>