<html>
<div style="min-width: 100%">
    <?php require_once __DIR__ . "/header.php" ?>

    <?php
    $loggedUser = $_COOKIE['user'];

    $con = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($con, "bd201");
    $consulta = "SELECT * FROM historia WHERE idUser = $loggedUser";
    $resultado = mysqli_query($con, $consulta);
    ?>

    <body class="mainBody">

        <div class="main" style="margin: bottom 500px;">
            <p class="sign" style="font-size: 40px;" align="center">Borrar Historia</p>
            <form action="/BD201/<?php echo basename(__DIR__) ?>/historiaBorrada.php" class="form1"
                method="get">
                <p class="sign" align="center">Escull la història que vols esborrar</p>
                <select name="hist" class="form-select" style="width: auto; margin-left: 42.5%;"
                    aria-label="Default select example">
                    <option selected value>No esborrar</option>
                    <?php
                        foreach($resultado as $m) {
                    ?>
                    <option value="<?php echo $m['idHist'];?>"><?php echo $m['text'];?></option>
                    <?php
                        }
                    ?>
                </select>
                <button type="submit" class="registerButton">DELETE</button>
        </div>

    </body>
</div>

</html>
<script>
$(document).ready(function() {

});
</script>