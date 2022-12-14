<!DOCTYPE html>
<html lang="en">
<?php require_once "../db.php"?>
<?php require_once "../head.php"?>
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
    $nreg = DB::run("select idUser, count(username), contrasenya from usuari where username = ?", [$nick])->fetchAll();
    if ($nreg[0]["count(username)"] == 0 || $pss != $nreg[0]['contrasenya']) { ?>

        <div class="main">
            <p class="sign" id="error" align="center">La contrassenya o el nom d'usuari son incorrectes</p>
            <a href="login.php" id="torn">Tornar a provar</a>
        </div>

    <?php
    } else {
        setcookie("user", $nreg[0]['idUser']);
        echo $_COOKIE['user'];
        ?>
        <script>
            window.location.replace('/BD2-practica/<?php echo basename(__DIR__) ?>/main.php');
        </script>
    <?php }
    ?>
</body>

</html>