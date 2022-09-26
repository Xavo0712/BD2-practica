<?php
session_start();
if(isset($_SESSION['user'])) {
    header('Location: header.php');
    exit;
}

require_once 'db.php';
?>
<?php require_once __DIR__ . "./head.php"?>
<?php require_once "./views/main.php"?>
