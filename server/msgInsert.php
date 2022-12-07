<?php require_once "../db.php" ?>

<?php
DB::run("INSERT INTO missatge (text,idUserE,idUserR,timeSent) VALUES (?,?,?,NOW())", [$_GET['text'], $_GET['idS'], $_GET['idR']]);
?>