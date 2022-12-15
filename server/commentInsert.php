<?php require_once "../db.php" ?>

<?php
//SUSTITUIBLE POR UN STORED PROCEDURE EN SU DOCUMENTO DE ORIGEN, SE QUEDA EL AJAX Y DESPUÉS DE LA LLAMADA SE INVOCA ESTO
DB::run("INSERT INTO resposta (text,data,idUser,idPub) VALUES (?,NOW(),?,?)", [$_GET['text'], $_GET['idUser'], $_GET['idPub']]);
?>