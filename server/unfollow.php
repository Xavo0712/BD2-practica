<?php require_once "../db.php" ?>

<?php
    DB::run("DELETE FROM follow WHERE idUserFollower = ? AND idUserFollowing = ?;", [$_GET['follower'], $_GET['following']])->fetchAll(PDO::FETCH_ASSOC);
?>