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
    $selectPublicacio = ("SELECT * FROM publicacio");
    $datosPublicacio = mysqli_query($con, $selectPublicacio);

    $selectReenviament=("SELECT * FROM r_reenv ");
    $datosReenviament = mysqli_query($con, $selectReenviament);


    ?>


    <body class="mainBody">
        <div class="mainThings">
            <a href="/BD2-practica/<?php echo basename(__DIR__) ?>/logOut.php" id="torn" style="margin-left: 88%;">Log
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
            <?php foreach ($datosUser as $usuario) {

                echo "
            <div class=\"imagen\">

                <div class=\"imgTodo\">
                    <img class=\"perfilImagen\" src=\"" . $usuario['imagen'] . "\">
                    <div class=\"imagenCabecera\"><br />
                        <h2> @". $usuario['username'] . "</h2>
                        <h2>". $usuario['nom'] ."</h2>
                    </div>
                </div>
                <div class=\"imgTodo2\">
                    <div class=\"imgDescripcion\">
                        <medium>". $usuario['telefon'] . "</medium>
                        <medium>" . $usuario['correu'] . "</medium>
                    </div>
                    <div style=\"width:70px\">
                        
                    </div>
                </div>
            </div>
            ";
            }
            ?>
        </div>
        <div class="contenedor">
            <?php
            foreach ($datosPublicacio as $publicacio) {
                echo "
                    <div class=\"row post\" id=\"post" . $publicacio['idPub'] . "\"><br>     
                        <p>" . $publicacio['text'] . "</p>
                        <img  class=\"imgPubli\" src=\"" . $publicacio['link'] . "\"><br>
                        <p class=\"data\">" . $publicacio['data'] . "</p>          
                    </div>";
            }

            foreach($datosReenviament as $reenvii){
                $pubReenvc="SELECT * FROM publicacio WHERE publicacio.idPub=".$reenvii['idPub'];
                $pubReenv=mysqli_query($con,$pubReenvc);
                $reultado = mysqli_fetch_array($pubReenv);
                $userNamec="SELECT username FROM usuari WHERE usuari.idUser=".$reenvii['idUser'];
                $userName=mysqli_query($con,$userNamec);
                $resultado2=mysqli_fetch_array($userName);

                echo "
                <div class=\"row post\" id=\"post". $reultado['idPub']."\"><br>     
                    <p>" . $reultado['text'] . "</p>
                    <img  class=\"imgPubli\" src=\"" . $reultado['link'] . "\"><br>
                    <div class=\"reenviado\" style=\"display: flex , flex-direction=row;\">
                    <p class=\"data\">" . $reultado['data'] . "  
                    Reenviado por: ".$resultado2['username']."</p>
                    </div>      
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
</script>