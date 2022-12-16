<?php require_once "../db.php" ?>

<?php
DB::run("INSERT INTO r_reenv VALUES(?,?,NOW())",[$_GET['idUserPub'],$_GET['idPub']])
?>