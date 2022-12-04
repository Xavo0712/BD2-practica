<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/BD2-practica/assets/styles/styles1.css">
    <link rel="scriptsheet" href="scripts.js">
    
    <link rel="register" href="register.php">
    <title>Principal</title>
</head>

<body>

    <?php
    $nick = $_GET['nomUsuari'];
    $pss = $_GET['contrassenya'];
    $con = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($con, "bd201");
    $notis = mysqli_query($con, "select count(username), contrasenya from usuari where username = '" . $nick . "'");
    $nreg = mysqli_fetch_array($notis);
    if ($nreg[0] == 0 || $pss != $nreg['contrasenya']) { ?>

        <div class="main">
            <p class="sign" id="error" align="center">La contrassenya o el nom d'usuari son incorrectes</p>
            <a href="login.php" id="torn">Tornar a provar</a>
        </div>

    <?php
    } else { ?>
        <script>
            window.location.replace('/BD2-practica/<?php echo basename(__DIR__) ?>/main.php');
        </script>
    <?php }
    ?>
</body>

</html>