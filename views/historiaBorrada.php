<!DOCTYPE html>
<html lang="en">

<?php require_once "../db.php"?>
<?php require_once "../head.php"?>

<body>

    <?php
    $locHist = $_GET['hist'];
    $loggedUser = $_COOKIE['user'];

    $con = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($con, "bd201");

    $consulta1 = "UPDATE publicacio SET idHist = NULL WHERE publicacio.idHist = '" . $locHist . "'";
    $resultado1 = mysqli_query($con, $consulta1);

    $consulta2 = "DELETE FROM historia WHERE historia.idHist = '" . $locHist . "'";
    $resultado2 = mysqli_query($con, $consulta2);
    ?>

    <div class="main">
        <p class="sign" align="center"> Història esborrada correctament</p>
        <a href="/BD201/<?php echo basename(__DIR__) ?>/main.php" id="torn">Tornar a Inicio</a>
    </div>

</body>

</html>