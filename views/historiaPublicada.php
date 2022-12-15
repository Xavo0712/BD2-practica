<!DOCTYPE html>
<html lang="en">

<?php require_once "../db.php"?>
<?php require_once "../head.php"?>

<body>

    <?php
    $locLink = $_GET['link'];
    $locTitol = $_GET['titol'];
    $locPriv = $_GET['priv'];
    $loggedUser = $_COOKIE['user'];

    $con = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($con, "bd201");
    $consulta = "INSERT INTO historia (tipus, idUser, titol, link) VALUES ('" . $locPriv . "', '" . $loggedUser . "' , '" . $locTitol . "' ,'" . $locLink . "')";

    $resultado = mysqli_query($con, $consulta);
    ?>

    <div class="main">
        <p class="sign" align="center">Història registrada correctament</p>
        <a href="/BD2-practica/<?php echo basename(__DIR__) ?>/main.php" id="torn">Tornar a Inicio</a>
    </div>

</body>

</html>