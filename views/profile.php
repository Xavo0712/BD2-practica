<div style="min-width: 100%">
    <?php require_once __DIR__ . "/header.php" ?>
    <?php require_once __DIR__ . "/chat.php" ?>

    <?php
    $loggedUser = $_COOKIE['user'];

    $profileUser = $_GET['idUser'];
    $profileUserInfo = DB::run("SELECT * FROM usuari WHERE idUser = ?", [$profileUser])->fetchAll(PDO::FETCH_ASSOC)[0];
    $allUserPosts = DB::run("SELECT link AS img, text, publicacio.idPub, r_reenv.data FROM publicacio JOIN r_reenv ON (r_reenv.idPub = publicacio.idPub AND r_reenv.idUser = ?) UNION 
        SELECT link as img, text, publicacio.idPub, publicacio.data FROM publicacio WHERE (publicacio.idUser = ? AND publicacio.idHist IS NULL);", [$profileUser, $profileUser])->fetchAll(PDO::FETCH_ASSOC);

    $allUserStories = DB::run("SELECT * FROM historia WHERE idUser = ?", [$profileUser])->fetchAll(PDO::FETCH_ASSOC);
    $follows['follow'] = 1;
    if ($loggedUser != $profileUser) {
        $follows = DB::run("SELECT COUNT(*) AS follow FROM follow WHERE idUserFollower = ? AND idUserFollowing = ?", [$loggedUser, $profileUser])->fetchAll(PDO::FETCH_ASSOC)[0];
    }
    ?>

    <body class="mainBody">
        <div class="row">
            <div class="panel panel-default col-lg-6 profileBlock">
                <img id="profilePic" style="margin-left:33%; margin-top:20px;" class="userPic" src=<?php echo "\"" . $profileUserInfo['imagen'] . "\"" ?> width="300px" height="300px" />
                <div class="row">
                    <div class="col-lg-6">
                        <p class="profileInfo username">@<?php echo $profileUserInfo['username'] ?></p>
                        <p class="profileInfo"><?php echo $profileUserInfo['nom'] ?></p>
                    </div>
                    <div class="col-lg-6">
                        <a class="profileInfo" style="font-weight:bold;" href="follow.php?idUser=<?php echo $profileUserInfo['idUser'] ?>">Seguidors</a>
                        <?php if ($loggedUser != $profileUser) {
                            if ($follows['follow'] == 1) {
                                echo "<button class=\"btnFollow\" id=\"unfollow\">Dejar de seguir</button>";
                            } else {
                                echo "<button class=\"btnFollow\" id=\"follow\">Seguir</button>";
                            }
                        }
                        ?>
                    </div>
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
                        echo "  <a href=\"post.php?postId=" . $post['idPub'] . "\">
                                    <div id=\"post" . $post['idPub'] . "\" class=\"row post\">
                                        <p>" . $post['text'] . "</p>
                                        <img src=\"" . $post['img'] . "\" max-height=\"200px\" max-width=\"200px\">
                                    <div id=\"btn-data-line\">    
                                        <p class=\"data\">" . $post['data'] . "</p>
                                        <button type=\"button\" attridHist=".$post[ 'idPub']." class=\"btn-reenviar\">Reenviar</button>
                                    </div>
                                    </div>
                                </a>";      
                    }
                    ?>
                </div>
                <div class="panel panel-default profileStories" style="display:none; overflow-y:auto; height:800px;">
                    <?php
                    foreach ($allUserStories as $story) {
                        if (($follows['follow'] == 1 && $story['tipus'] == 1) || $story['tipus'] == 0) {
                            echo "  <a href=\"story.php?storyId=" . $story['idHist'] . "&userId=" . $story['idUser'] . "\">
                                    <div id=\"story" . $story['idHist'] . "\" class=\"row post\">
                                        <p>" . $story['text'] . "</p>
                                        <img src=\"" . $story['img'] . "\" max-height=\"200px\" max-width=\"200px\">
                                        <p class=\"data\">" . $story['data'] . "</p>
                                    </div>
                                </a>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div id="myModal" class="modal" tabindex="-1" role="dialog" style="display:none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cambiar Foto de Perfil</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input id="newPic" name="link" type="text" align="center" placeholder="Adjuntar enlace">
                        <p class="errorMsg">Introduzca una url válida</p>
                    </div>
                    <div class="modal-footer">
                        <button id="cambioFoto" type="button" class="btn btn-primary btnSave">Guardar cambios</button>
                        <button type="button" class="btn btn-secondary close" data-dismiss="modal">Cancelar</button>
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

    $('#myModal').on('shown.bs.modal', function() {
        $('#myInput').trigger('focus')
    });

    $('#profilePic').click(function() {
        if (<?php echo $loggedUser ?> == <?php echo $profileUser ?>) {
            $('#myModal').show();
        }
    });

    $('.close').click(function() {
        $('#myModal').hide();
    });

    $('#cambioFoto').click(function() {
        var link = $('#newPic').val();
        if (link == '') {
            $('.errorMsg').show();
        } else {
            $('.errorMsg').hide();
            $.ajax({
                url: "../server/imgUpdate.php",
                type: "GET",
                data: {
                    link: link,
                    idUser: <?php echo $loggedUser; ?>
                },
                success: function() {
                    console.log("Pic updated successfully")
                    $('#profilePic').attr('src', link);
                    $('#myModal').hide();
                }
            });
        }
    });

    $('.btnFollow').click(function() {
        if (this.id == "follow") {
            $.ajax({
                url: "../server/follow.php",
                type: "GET",
                data: {
                    follower: <?php echo $loggedUser; ?>,
                    following: <?php echo $profileUser; ?>
                },
                success: function() {
                    console.log("Followed successfully")
                    button = $('.btnFollow');
                    button.attr("id", "unfollow");
                    button.text("Dejar de Seguir");
                    <?php $follows['follow'] = 1;?>
                }
            });
        } else {
            $.ajax({
                url: "../server/unfollow.php",
                type: "GET",
                data: {
                    follower: <?php echo $loggedUser; ?>,
                    following: <?php echo $profileUser; ?>
                },
                success: function() {
                    console.log("Unollowed successfully")
                    button = $('.btnFollow');
                    button.attr("id", "follow");
                    button.text("Seguir");
                    <?php $follows['follow'] = 0;?>
                }
            });
        }
    });
</script>