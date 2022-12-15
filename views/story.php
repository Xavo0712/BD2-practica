<div style="min-width: 100%">
    <?php require_once __DIR__ . "/header.php" ?>
    <?php require_once __DIR__ . "/chat.php" ?>

    <?php
    $loggedUser = $_COOKIE['user']; //paco as user for test purpouse
    $loggedUserInfo = DB::run("SELECT * FROM usuari WHERE idUser = ?", [$loggedUser])->fetchAll(PDO::FETCH_ASSOC)[0];

    $userId = $_GET['userId'];
    $userInfo = DB::run("SELECT * FROM usuari WHERE idUser = ?", [$userId])->fetchAll(PDO::FETCH_ASSOC)[0];
    $storyId = $_GET['storyId'];
    $storyPosts = DB::run("SELECT * FROM publicacio WHERE idHist = ?", [$storyId])->fetchAll(PDO::FETCH_ASSOC)
    ?>

    <body class="mainBody">
        <div class="row">
            <div style="margin-left:25%;" class="panel panel-default col-lg-6 postBlock">
                <div id="storyCarousel" class="carousel slide row" data-ride="carousel">
                    <a class="carousel-control-prev" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <div class="carousel-inner">
                        <?php
                        $primero = false;
                        foreach ($storyPosts as $post) {
                            echo "  <div id=\"post" . $post['idPub'] . "\"class=\"carousel-item postInfo row " . (($primero == false) ? "active" : "") . "\">
                            <div class=\"row\">
                                <div class=\"col-lg-1\">
                                    <img class=\"userPic\" src=\"" . $userInfo['imagen'] . "\" width=\"75px\" height=\"75px\" />
                                </div>
                                <div class=\"col-lg-11\">
                                    <p class=\"username\">@" . $userInfo['username'] . "</p>
                                    <p>" . $userInfo['nom'] . "</p>
                                </div>
                            </div>
                            <div class=\"row\">
                                <img class=\"postImage\" src=\"" . $post['link'] . "\" max-height=\"200px\" max-width=\"200px\">
                                <p class=\"data\">". $post['data'] ."</p>
                            </div>
                            </div>";
                            $primero = true;
                        }
                        ?>
                    </div>
                    <a class="carousel-control-next" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                <div class="row panel-footer post-writer">
                    <input id="postWriter" placeholder="Escriba un mensaje" onkeypress="comment(event)"></input>
                </div>
                <div class="row">
                    <div class="panel panel-default postComments" style="overflow-y:auto; height:800px;">
                    </div>
                </div>
            </div>
        </div>
    </body>
</div>

<script>
    $(document).ready(function() {
        var id = $.find('.active')[0].id.slice(-1)
        loadComments(id);
    });

    $('.carousel-control-next').click(function() {
        $(this).parent().carousel('next');
    });

    $('.carousel-control-prev').click(function() {
        $(this).parent().carousel('prev');
    });

    $('#storyCarousel').bind('slid.bs.carousel', function(e) {
        var id = $.find('.active')[0].id.slice(-1)
        loadComments(id);
    });

    function loadComments(postId) {
        $('.postComments').empty();
        $.ajax({
            url: "../server/getComments.php",
            type: "GET",
            data: {
                postId: postId
            },
            success: function(response) {
                var comments = JSON.parse(response);
                comments.forEach(comment => {
                    $('.postComments').append("<div class=\"row comment\">" +
                        "<div class = \"row\">" +
                        "<div class = \"col-lg-1\">" +
                        "<img class = \"userPic\" src=\"" + comment['imagen'] + "\" width=\"75px\" height=\"75px\"/>" +
                        "</div>" +
                        "<div class = \"col-lg-1\">" +
                        "<p class = \"username\">@" + comment['username'] +
                        "</p>" +
                        "</div>" +
                        "</div>" +
                        "<div class = \"row\">" +
                        "<p>" + comment['text'] + "</p>" +
                        "<p class=\"data\">" + comment['data'] + "</p>" +
                        "</div>" +
                        "</div>")
                });
            }
        });
    }

    function comment(event) {
        if (event.keyCode == 13) {
            var comment = $('#postWriter').val();
            var postId = $.find('.active')[0].id.slice(-1)
            $.ajax({
                url: "../server/commentInsert.php",
                type: "GET",
                data: {
                    text: comment,
                    idUser: <?php echo $loggedUser ?>,
                    idPub: postId
                },
                success: function() {
                    console.log("Reponse published successfully");
                    var dt = new Date();
                    var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
                    var day = dt.getFullYear() + "-" + (dt.getMonth()+1) + "-" + dt.getDate();
                    $('.postComments').prepend(
                        "<div class=\"row comment\">" +
                        "<div class=\"row\">" +
                        "<div class=\"col-lg-1\">" +
                        "<img class=\"userPic\" src=\" <?php echo $loggedUserInfo['imagen'] ?> \" width=\"75px\" height=\"75px\"/>" +
                        "</div>" +
                        "<div class=\"col-lg-1\">" +
                        "<p class=\"username\">@ <?php echo $loggedUserInfo['username'] ?> </p>" +
                        "</div>" +
                        "</div>" +
                        "<div class=\"row\">" +
                        "<p>" + comment + "</p>" +
                        "<p class=\"data\">" + day + " " + time +"</p>" +
                        "</div>" +
                        "</div>");
                    $('#postWriter').val("");
                }
            });

        }
    }
</script>