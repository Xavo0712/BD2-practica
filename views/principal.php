<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/styles1.css">
    <link rel="scriptsheet" href="scripts.js">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="register" href="register.php">
    <title>Principal</title>
</head>

<body>

    <?php
    $nick = $_GET['nomUsuari'];
    $pss = $_GET['contrassenya'];
    $con = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($con, "usuaristemporals");
    $notis = mysqli_query($con, "select count(nomUsuari), contrassenya from persona where nomUsuari = '" . $nick . "'");
    $nreg = mysqli_fetch_array($notis);
    if ($nreg[0] == 0 || $pss != $nreg['contrassenya']) { ?>

        <div class="main">
            <p class="sign" id="error" align="center">La contrassenya o el nom d'usuari son incorrectes</p>
            <a href="login.php" id="torn">Tornar a provar</a>
        </div>

    <?php
    } else { ?>
        <script>
            window.replace('./main.php');
        </script>
    <?php }
    ?>
</body>

</html>