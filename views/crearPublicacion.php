<html>
<div style="min-width: 100%">
    <?php require_once __DIR__ . "/header.php" ?>

    <body class="mainBody">

        <div class="main" style="margin: bottom 500px;">
            <p class="sign" style="font-size: 40px;" align="center">Crear Publicació</p>
            <form action="/BD2-practica/<?php echo basename(__DIR__) ?>/publicacionPublicada.php" class="form1"
                method="get">
                <input name="link" class="un " type="text" align="center" placeholder="Link de la imatge">
                <input name="text" class="un " type="text" align="center" placeholder="Text">
                <p class="sign" align="center">Afegir a una història</p>
                <select name="hist" class="form-select" style="width: auto; margin-left: 43.5%;"
                    aria-label="Default select example">
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
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