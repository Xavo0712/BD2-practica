<html>
<div style="min-width: 100%">
    <?php require_once __DIR__ . "/header.php" ?>
    <?php require_once __DIR__ . "/chat.php" ?>
    <?php
    $loggedUser = $_COOKIE['user'];
    $selectUser = DB::run("SELECT * FROM USUARI WHERE usuari.idUser= ?", [$loggedUser])->fetchAll(PDO::FETCH_ASSOC)[0];

    //SELECT PARA MOSTRAR TODO RESPUESTAS, REENVIOS Y PUBLICACIONES DE USUARIOS
    $datosPublicacio = DB::run("SELECT link AS img, text, publicacio.idPub, r_reenv.data, publicacio.idUser, usuari.username, r_reenv.idUser as reenvUser 
                                    FROM publicacio JOIN r_reenv ON r_reenv.idPub = publicacio.idPub JOIN usuari ON r_reenv.idUser = usuari.idUser UNION 
                                SELECT link as img, text, publicacio.idPub, publicacio.data, publicacio.idUser, null, null
                                    FROM publicacio JOIN usuari ON publicacio.idUser = usuari.idUser ORDER BY data DESC")->fetchAll(PDO::FETCH_ASSOC);
    ?>


    <body class="mainBody">
        <div class="mainThings">
            <a href="/BD201/<?php echo basename(__DIR__) ?>/logOut.php" id="torn" style="margin-left: 88%;">Log
                Out</a>

            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <select id="users" class="form-select" onchange="handleSelect(this)">
                            <option value="" selected>Cerca un usuari</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="usuari">
            <div class="imagen">

                <div class="imgTodo">
                    <a href="profile.php?idUser=<?php echo $selectUser['idUser'] ?>">
                        <img class="perfilImagen" src="<?php echo $selectUser['imagen'] ?>">
                        <div class="imagenCabecera">
                            <h2>@<?php echo $selectUser['username'] ?></h2>
                            <h2><?php echo $selectUser['nom'] ?></h2>
                        </div>
                    </a>
                </div>
                <div class="imgTodo2">
                    <div class="imgDescripcion">
                        <medium><?php echo $selectUser['telefon'] ?></medium>
                        <medium><?php echo $selectUser['correu'] ?></medium>
                    </div>
                </div>
            </div>
        </div>
        <div class="contenedor">
            <?php
            foreach ($datosPublicacio as $publicacio) {
                $postUser = DB::run("SELECT usuari.imagen, usuari.username, usuari.nom FROM usuari JOIN publicacio ON publicacio.idUser = usuari.idUser AND publicacio.idPub = ?", [$publicacio['idPub']])->fetchAll(PDO::FETCH_ASSOC)[0];
                echo "<div class=\"row post\" id=\"post" . $publicacio['idPub'] . "\" style=\"text-align:center;\">
                            <div class=\"row\" style=\"border-bottom: 1px solid black; padding-bottom: 10px;\">
                                <div class=\"col-lg-2\">
                                    <a href=\"profile.php?idUser=" . $publicacio['idUser'] . "\">
                                        <img class=\"userPic\" src=\"" . $postUser['imagen'] . "\" style=\"width: 75px!imporant; height: 75px!important;\" />
                                    </a>
                                </div>
                                <div class=\"col-lg-8\">
                                    <a href=\"profile.php?idUser=" . $publicacio['idUser'] . "\" class=\"username\">@" . $postUser['username'] . "</a>
                                    <p>" . $postUser['nom'] . "</p>
                                </div>";
                if ($publicacio['reenvUser'] != null) {
                    echo "  <div class=\"col-lg-2\">
                                <p>Reenviado por @" . $publicacio['username'] . "</p>
                            </div>";
                }
                echo "
                    </div>
                    <a href=\"post.php?postId=" . $publicacio['idPub'] . "\">
                        <p>" . $publicacio['text'] . "</p>
                        <img  class=\"imgPubli\" src=\"" . $publicacio['img'] . "\"><br>
                    </a>
                    <p class=\"data\">" . $publicacio['data'] . "</p>
                    <button type=\"button\" attridHist=" . $publicacio['idPub'] . " class=\"btn-reenviar\">Reenviar</button>        
                </div>";
            }
            ?>
        </div>
    </body>
</div>

</html>
<script>
    $(document).ready(function() {
        var data;
        getAllUsers(function(response) {
            data = response;
        });

        for (let i = 0; i < data.length; i++) {
            user = data[i];
            const us = "<?php echo $_COOKIE['user']; ?>";
            if (user.idUser != us) {
                $("#users").append("<option value='" + user.idUser + "'>" + user.username + "</option>")
            }
        }

        var select1 = document.querySelector('#users');
        dselect(select1, {
            search: true
        });
    });

    function handleSelect(elm) {
        window.location.replace("profile.php?idUser=" + elm.value);
    }

    $('.btn-reenviar').click(function() {
        var idPubButt = $(this).attr('attridHist')
        $('#myModal2').show();
        $.ajax({
            url: "../server/reenviar.php",
            type: "GET",
            data: {
                idUserPub: <?php echo $loggedUser; ?>,
                idPub: Number(idPubButt)
            },

            success: function() {
                document.location.reload();
            }

        })
    });
</script>