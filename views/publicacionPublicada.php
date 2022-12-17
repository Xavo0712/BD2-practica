<!DOCTYPE html>
<html lang="en">

<?php require_once "../db.php"?>
<?php require_once "../head.php"?>

<body>

    <?php
    $locLink = $_GET['link'];
    $locText = $_GET['text'];
    if($_GET['hist'] != "") {
        $locHist = $_GET['hist'];
    }
    $loggedUser = $_COOKIE['user'];

    $con = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($con, "bd201");
    if($_GET['hist'] != "") {
        $consulta = "INSERT INTO publicacio (idUser, idHist, data, link, text) VALUES ('" . $loggedUser . "', '" . $locHist . "' , CURRENT_TIMESTAMP ,'" . $locLink . "','" . $locText . "')";
    }
    else {
        $consulta = "INSERT INTO publicacio (idUser, data, link, text) VALUES ('" . $loggedUser . "', CURRENT_TIMESTAMP ,'" . $locLink . "','" . $locText . "')";
    }
    $resultado = mysqli_query($con, $consulta);
    ?>

    <div class="main">
        <p class="sign" align="center"> Publicació registrada correctament</p>
        <a href="/BD201/<?php echo basename(__DIR__) ?>/main.php" id="torn">Tornar a Inicio</a>
    </div>

</body>

</html>