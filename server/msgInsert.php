<?php require_once "../db.php" ?>

<?php
//SUSTITUIBLE POR UN STORED PROCEDURE EN SU DOCUMENTO DE ORIGEN, SE QUEDA EL AJAX Y DESPUÉS DE LA LLAMADA SE INVOCA ESTO
DB::run("INSERT INTO missatge (text,idUserE,idUserR,timeSent) VALUES (?,?,?,NOW())", [$_GET['text'], $_GET['idS'], $_GET['idR']]);
?>