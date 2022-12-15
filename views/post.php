<div style="min-width: 100%">
    <?php require_once __DIR__ . "/header.php" ?>
    <?php require_once __DIR__ . "/chat.php" ?>

    <?php
    $loggedUser = $_COOKIE['user']; //paco as user for test purpouse
    $loggedUserInfo = DB::run("SELECT * FROM usuari WHERE idUser = ?", [$loggedUser])->fetchAll(PDO::FETCH_ASSOC)[0];

    $postId = $_GET['postId'];
    $postInfo = DB::run("SELECT * FROM publicacio WHERE idPub = ?", [$postId])->fetchAll(PDO::FETCH_ASSOC)[0];
    $postUser = DB::run("SELECT * FROM usuari WHERE idUser = ?", [$postInfo['idUser']])->fetchAll(PDO::FETCH_ASSOC)[0];
    $commentsInfo = DB::run("SELECT usuari.username, usuari.imagen, resposta.text, resposta.data FROM resposta 
        JOIN usuari ON resposta.idUser = usuari.idUser WHERE idPub = ?", [$postId])->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <body class="mainBody">
        <div class="row">
            <div style="margin-left:25%;" class="panel panel-default col-lg-6 postBlock">
                <div class="postInfo row">
                    <div class="row">
                        <div class="col-lg-1">
                            <img class="userPic" src=<?php echo "\"" . $postUser['imagen'] . "\"" ?> width="75px" height="75px" />
                        </div>
                        <div class="col-lg-11">
                            <p class="username">@<?php echo $postUser['username'] ?></p>
                            <p><?php echo $postUser['nom'] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <img class="postImage" src=<?php echo "\"" . $postInfo['link'] . "\"" ?> max-height="200px" max-width="200px">
                    </div>
                </div>
                <div class="row panel-footer post-writer">
                    <input id="postWriter" placeholder="Escriba un mensaje" onkeypress="comment(event, <?php echo $postId ?>)"></input>
                </div>
                <div class="row">
                    <div class="panel panel-default postComments" style="overflow-y:auto; height:800px;">
                        <?php
                        foreach ($commentsInfo as $comment) {
                            echo "  <div class=\"row comment\">
                                    <div class=\"row\">
                                        <div class=\"col-lg-1\">
                                            <img class=\"userPic\" src=\"" . $comment['imagen'] . "\" width=\"75px\" height=\"75px\"/>
                                        </div>
                                        <div class=\"col-lg-1\">
                                            <p class=\"username\">@" . $comment['username'] . "</p>
                                        </div>
                                    </div>
                                    <div class=\"row\">
                                        <p>" . $comment['text'] . "</p>
                                    </div>
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

    function comment(event, postId) {
        if (event.keyCode == 13) {
            var comment = $('#postWriter').val();
            $.ajax({
                url: "../server/commentInsert.php",
                type: "GET",
                data: {
                    text: comment,
                    idUser: <?php echo $loggedUser?>,
                    idPub: postId
                },
                success: function() {
                    console.log("Reponse published successfully")
                    $('.postComments').prepend(
                        "<div class=\"row comment\">",
                            "<div class=\"row\">",
                                "<div class=\"col-lg-1\">",
                                    "<img class=\"userPic\" src=\" <?php echo $loggedUserInfo['imagen']?> \" width=\"75px\" height=\"75px\"/>",
                                "</div>",
                                "<div class=\"col-lg-1\">",
                                    "<p class=\"username\">@ <?php echo $loggedUserInfo['username']?> </p>",
                                "</div>",
                            "</div>",
                            "<div class=\"row\">",
                                "<p>" + comment + "</p>",
                            "</div>",
                        "</div>");
                    $('#postWriter').val("");
                }
            });

        }
    }
</script>