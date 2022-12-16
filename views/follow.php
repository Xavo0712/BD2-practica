<div style="min-width: 100%">
    <?php require_once __DIR__ . "/header.php" ?>
    <?php require_once __DIR__ . "/chat.php" ?>
    <?php
    $loggedUser = $_COOKIE['user']; //paco as user for test purpouse
    $loggedUserInfo = DB::run("SELECT * FROM usuari WHERE idUser = ?", [$loggedUser])->fetchAll(PDO::FETCH_ASSOC)[0];

    $followPageUser = $_GET['idUser'];
    $followers = DB::run("SELECT * FROM usuari JOIN follow ON idUserFollower = usuari.idUser AND idUserFollowing = ?", [$followPageUser])->fetchAll(PDO::FETCH_ASSOC);
    $following = DB::run("SELECT * FROM usuari JOIN follow ON idUserFollower = ? AND idUserFollowing = usuari.idUser", [$followPageUser])->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <body class="mainBody">
        <div class="row">
            <div class="col-lg-6">
                <h5 align="center">Seguidors</h5>
                <?php
                foreach ($followers as $follower) {
                    echo "  <a href=\"profile.php?idUser=" . $follower['idUser'] . "\">
                        <div class=\"row follower\">
                            <div class = \"col-lg-2\">
                                <img class=\"userPic\" src=\"" . $follower['imagen'] . "\" width=\"75px\" height=\"75px\"/>
                            </div>
                            <div class = \"col-lg-10\">
                                <p class=\"username\">" . $follower['username'] . "</p>
                            </div>
                        </div>
                    </a>";
                }
                ?>
            </div>
            <div class="col-lg-6">
                <h5 align="center">Seguits</h5>
                <?php
                foreach ($following as $followed) {
                    echo "  <a href=\"profile.php?idUser=" . $followed['idUser'] . "\">
                        <div class=\"row follower\">
                            <div class = \"col-lg-2\">
                                <img class=\"userPic\" src=\"" . $followed['imagen'] . "\" width=\"75px\" height=\"75px\"/>
                            </div>
                            <div class = \"col-lg-10\">
                                <p class=\"username\">" . $followed['username'] . "</p>
                            </div>
                        </div>
                    </a>";
                }
                ?>
            </div>
        </div>
    </body>
</div>