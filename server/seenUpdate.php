<?php require_once "../db.php" ?>
<!--Pequeño bug, pone más 1s de los que toca a veces-->
<?php
if ($_GET['loggedUser'] == $_GET['idS']) {
    $leido = "leidoE";
} else {
    $leido = "leidoR";
}
DB::run("UPDATE missatge SET " . $leido . "=1 WHERE idUserE = ? AND idUserR = ?", [$_GET['idS'], $_GET['idR']]);
echo "UPDATE missatge SET " . $leido . "=1 WHERE idUserE = ? AND idUserR = ?";
?>