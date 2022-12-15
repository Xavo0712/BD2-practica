<?php require_once "../db.php" ?>

<?php
DB::run("UPDATE usuari SET imagen = ? WHERE idUser = ?;", [$_GET['link'], $_GET['idUser']]);
?>