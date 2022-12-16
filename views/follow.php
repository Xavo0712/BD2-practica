<div style="min-width: 100%">
    <?php require_once __DIR__ . "/header.php" ?>
    <?php require_once __DIR__ . "/chat.php" ?>
    <?php
    $loggedUser = $_COOKIE['user']; //paco as user for test purpouse
    $loggedUserInfo = DB::run("SELECT * FROM usuari WHERE idUser = ?", [$loggedUser])->fetchAll(PDO::FETCH_ASSOC)[0];

    $followPageUser = $_GET['idUser'];
    $followers = DB::run("SELECT * FROM usuari JOIN follow ON idUserFollower = usuari.idUser AND idUserFollowing = ?",[$followPageUser])->fetchAll(PDO::FETCH_ASSOC);
    $following = DB::run("SELECT * FROM usuari JOIN follow ON idUserFollower = ? AND idUserFollowing = usuari.idUser",[$followPageUser])->fetchAll(PDO::FETCH_ASSOC);
    ?>

    
</div>