<!DOCTYPE html>
<html lang="en">

<?php require_once "../db.php"?>
<?php require_once "../head.php"?>

<body>

    <?php
    $locLink = $_GET['link'];
    $locText = $_GET['text'];

    $con = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($con, "bd201");
    $consulta = "INSERT INTO publicacio (idUser, data, link, text) VALUES ('" . $locNom . "', CURRENT_TIMESTAMP ,'" . $locLink . "','" . $locText . "')";
    $resultado = mysqli_query($con, $consulta);
    ?>

    <div class="main">
        <p class="sign" align="center">Publicació registrada correctament</p>
        <a href="/BD2-practica/<?php echo basename(__DIR__) ?>/main.php" id="torn">Tornar a Inicio</a>
    </div>

</body>
</html>