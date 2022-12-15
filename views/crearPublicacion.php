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
            <p class="sign" style="font-size: 40px;" align="center">Crear Publicació</p>
            <h3 class="sign" style="font-size: 20px;" align="center">- Un dels 2 camps (o els 2) ha d'omplir-se</h3>
            <form action="/BD2-practica/<?php echo basename(__DIR__) ?>/publicacionPublicada.php" class="form1"
                method="get">
                <input name="link" class="un " type="text" align="center" placeholder="Link de la imatge">
                <input name="text" class="un " type="text" align="center" placeholder="Text">
                <p class="sign" align="center">Afegir a una història</p>
                <select name="hist" class="form-select" style="width: auto; margin-left: 42.5%;"
                    aria-label="Default select example">
                    <option disabled selected value>No afegir</option>
                    <?php
                        foreach($resultado as $m) {
                    ?>
                    <option value="<?php echo $m['idHist'];?>"><?php echo $m['titol'];?></option>
                    <?php
                        }
                    ?>
                </select>
                <button type="submit" class="registerButton">CREAR</button>
        </div>

    </body>
</div>

</html>
<script>
$(document).ready(function() {

});
</script>