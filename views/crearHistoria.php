<html>
<div style="min-width: 100%">
    <?php require_once __DIR__ . "/header.php" ?>

    <body class="mainBody">

        <div class="main" style="margin: bottom 500px;">
            <p class="sign" style="font-size: 40px;" align="center">Crear Historia</p>
            <form action="/BD201/<?php echo basename(__DIR__) ?>/historiaPublicada.php" class="form1"
                method="get">
                <input name="link" class="un " style="width: 300px;" type="text" align="center" placeholder="Link de la imatge (obligatori)">
                <input name="titol" class="un " type="text" align="center" placeholder="Text (obligatori)">
                <p class="sign" align="center">Privacitat de la història</p>
                <select name="priv" class="form-select" style="width: auto; margin-left: 42.5%;"
                    aria-label="Default select example">
                    <option value=0>Pública</option>
                    <option value=1>Privada</option>
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