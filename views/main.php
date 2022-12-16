<html>
<div style="min-width: 100%">
    <?php require_once __DIR__ . "/header.php" ?>
    <?php require_once __DIR__ . "/chat.php" ?>
    <?php
    $con = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($con, "bd201");
    $loggedUser = $_COOKIE['user'];
    $selectUser = ("SELECT * FROM USUARI WHERE usuari.idUser= " . $loggedUser);
    $datosUser = mysqli_query($con, $selectUser);


    //SELECT PARA MOSTRAR TODO RESPUESTAS, REENVIOS Y PUBLICACIONES DE USUARIOS
    $selectPublicacio = ("SELECT * FROM publicacio WHERE publicacio.idUser= " . $loggedUser);
    $datosPublicacio = mysqli_query($con, $selectPublicacio);


    ?>


    <body class="mainBody">
        <div class="usuari">
            <?php foreach ($datosUser as $usuario) {

                echo "
            <div class=\"imagen\">
            <img class=\"perfilImagen\" src=\"" . $usuario['imagen'] . "\">
            <div class=\"imagenCabecera\">
            <h2>\"" . $usuario['username'] . "\"</h2>
            <h2>\"" . $usuario['nom'] . "\"</h2>
            </div>
            </div>
            <medium>\"" . $usuario['telefon'] . "\"</medium>
            <medium>\"" . $usuario['correu'] . "\"</medium>";
            }
            ?>
        </div>
        <div class="muro">
            <?php
            foreach ($datosPublicacio as $publicacio) {
                echo "
                    <div id=\"post" . $publicacio['idPub'] . "\" class=\"row post\ max-width=\"200px\">
                        <p>" . $publicacio['text'] . "</p>
                        <img src=\"" . $publicacio['link'] . "\" max-height=\"200px\" max-width=\"200px\">
                         <p class=\"data\">" . $publicacio['data'] . "</p>          
                    </div>";
            }
            ?>
        </div>
    </body>
</div>
</html>
<script>
    $(document).ready(function() {

    });
</script>