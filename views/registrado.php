<!DOCTYPE html>
<html lang="en">

<?php require_once "../db.php" ?>
<?php require_once "../head.php" ?>

<body>

    <?php
    $locNom = $_GET['nom'];
    $locTelf = $_GET['telefon'];
    $locCorr = $_GET['correu'];
    $locNick = $_GET['nomUsuari'];
    $locCont = $_GET['contrassenya'];

    $con = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($con, "bd201");
    $consulta = "INSERT INTO usuari (nom, contrasenya, telefon, correu, username) VALUES ('" . $locNom . "','" . $locCont . "','" . $locTelf . "','" . $locCorr . "','" . $locNick . "')";
    $resultado = mysqli_query($con, $consulta);
    ?>

    <div class="main">
        <?php $rootPath = $_SERVER['DOCUMENT_ROOT'];
        $thisPath = dirname($_SERVER['PHP_SELF']);
        $onlyPath = str_replace($rootPath, '', $thisPath); ?>
        <p class="sign" align="center">Usuari registrat correctament</p>
        <a href="<?php echo $onlyPath ?>/login.php" id="torn">Tornar a Login</a>
    </div>

</body>

</html>