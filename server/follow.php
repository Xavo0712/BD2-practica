<?php require_once "../db.php" ?>

<?php
    DB::run("INSERT INTO follow VALUES (?,?);", [$_GET['follower'], $_GET['following']])->fetchAll(PDO::FETCH_ASSOC);
?>