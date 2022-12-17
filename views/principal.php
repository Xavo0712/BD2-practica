<!DOCTYPE html>
<html lang="en">
<?php require_once "../db.php" ?>
<?php require_once "../head.php" ?>

<head>
    <?php $rootPath = $_SERVER['DOCUMENT_ROOT'];
    $thisPath = dirname($_SERVER['PHP_SELF']);
    $onlyPath = str_replace($rootPath, '', $thisPath); ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $onlyPath ?>/assets/styles/styles1.css">
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
    ?>
    <script>
    window.location.replace('<?php echo $onlyPath ?>/main.php');
    </script>
    <?php }
    ?>
</body>

</html>