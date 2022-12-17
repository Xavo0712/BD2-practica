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

    if($locLink != "" && $locTitol != "") {
    $consulta = "INSERT INTO historia (tipus, idUser, text, img, data) VALUES ('" . $locPriv . "', '" . $loggedUser . "' , '" . $locTitol . "' ,'" . $locLink . "', CURRENT_TIMESTAMP)";
    $resultado = mysqli_query($con, $consulta);
    }
    ?>


    <!-- Si els camps estan plens-->
    <?php
    if($locLink != "" && $locTitol != "") { ?>
    <div class="main">
        <p class="sign" align="center">Història registrada correctament</p>
        <a href="/BD201/<?php echo basename(__DIR__) ?>/main.php" id="torn">Tornar a Inicio</a>
    </div>
    <?php
                        }
                    ?>
    <?php
    if($locLink == "" || $locTitol == "") {
    ?>
    <div class="main">
        <p class="sign" align="center">Història NO registrada, omple tots els camps</p>
        <a href="/BD201/<?php echo basename(__DIR__) ?>/main.php" id="torn">Tornar a Inicio</a>
    </div>
    <?php
                        }
                    ?>


</body>

</html>