<div style="min-width: 100%">
    <?php require_once __DIR__ . "/header.php" ?>
    <?php require_once __DIR__ . "/chat.php" ?>

    <?php
    $loggedUser = $_COOKIE['user']; //paco as user for test purpouse
    $loggedUserInfo = DB::run("SELECT * FROM usuari WHERE idUser = ?", [$loggedUser])->fetchAll(PDO::FETCH_ASSOC)[0];

    $allUserPosts = DB::run("SELECT link AS img, text AS text, publicacio.idPub FROM publicacio 
        JOIN r_reenv ON (r_reenv.idPub = publicacio.idPub AND r_reenv.idUser = ?) OR (publicacio.idUser = ? AND publicacio.idHist IS NULL);", [$loggedUser, $loggedUser])->fetchAll(PDO::FETCH_ASSOC);

    $allUserStoriesIds = DB::run("SELECT idHist FROM historia WHERE idUser = ?", [$loggedUser])->fetchAll(PDO::FETCH_ASSOC);
    $allUserStories = array();
    foreach ($allUserStoriesIds as $id) {
        $postsInStory = DB::run("SELECT link AS img, text AS text, idPub, idHist FROM publicacio
            WHERE idHist = ?", [$id['idHist']])->fetchAll(PDO::FETCH_ASSOC);
        array_push($allUserStories, $postsInStory);
    }
    ?>

    <body class="mainBody">
        <div class="row">
            <div class="panel panel-default col-lg-6 profileBlock">
                <img style="margin-left:33%; margin-top:20px;" class="userPic" src=<?php echo "\"" . $loggedUserInfo['imagen'] . "\"" ?> width="300px" height="300px" />
                <div class="row">
                    <p class="profileInfo username">@<?php echo $loggedUserInfo['username'] ?></p>
                    <p class="profileInfo"><?php echo $loggedUserInfo['nom'] ?></p>
                </div>
                <div class="row">
                    <div id="postButton" class="col-lg-6 buttonText">
                        Publicaciones
                    </div>
                    <div id="storyButton" class="col-lg-6 buttonText">
                        Historias
                    </div>
                </div>
                <div class="panel panel-default profilePosts" style="overflow-y:auto; height:800px;">
                    <?php
                    foreach ($allUserPosts as $post) {
                        echo "  <div id=\"post" . $post['idPub'] . "\" class=\"row post\">
                                    <p>" . $post['text'] . "</p>
                                    <img src=\"" . $post['img'] . "\" max-height=\"200px\" max-width=\"200px\">
                                </div>";
                    }
                    ?>
                </div>
                <div class="panel panel-default profileStories" style="display:none; overflow-y:auto; height:800px;">
                    <?php
                    foreach ($allUserStories as $story) {
                        $primero = false;
                        echo "<div id=\"story" . $story[0]['idHist'] . "\" class=\"carousel slide\" data-ride=\"carousel\">
                            <a class=\"carousel-control-prev\" role=\"button\" data-slide=\"prev\">
                                <span class=\"carousel-control-prev-icon\" aria-hidden=\"true\"></span>
                                <span class=\"sr-only\">Previous</span>
                            </a>
                            <div class=\"carousel-inner\">";
                        foreach ($story as $post) {

                            echo "  <div id=\"post" . $post['idPub'] . "\" class=\"carousel-item row post ".(($primero == false)? "active" : "" )."\">
                                        <p>" . $post['text'] . "</p>
                                        <img src=\"" . $post['img'] . "\" max-height=\"200px\" max-width=\"200px\">
                                    </div>";
                            $primero = true;
                        }
                        echo "</div>
                                <a class=\"carousel-control-next\" role=\"button\" data-slide=\"next\">
                                    <span class=\"carousel-control-next-icon\" aria-hidden=\"true\"></span>
                                    <span class=\"sr-only\">Next</span>
                                </a>
                            </div>";
                    }
                    ?>
                </div>
            </div>
        </div>
</div>
</body>
</div>

<script>
    $('.carousel-control-next').click(function() {
        $(this).parent().carousel('next');
    });

    $('.carousel-control-prev').click(function() {
        $(this).parent().carousel('prev');
    });

    $('#storyButton').click(function() {
        $('.profileStories').css('display', 'block');
        $('.profilePosts').css('display', 'none');
    });

    $('#postButton').click(function() {
        $('.profileStories').css('display', 'none');
        $('.profilePosts').css('display', 'block');
    });
</script>