<html>
<div style="min-width: 100%">
    <?php require_once __DIR__ . "/header.php" ?>

    <body class="mainBody">
        <h1><?php echo DB_NAME?></h1>
        <p>Paragraph</p>

        <div class="main">
            <p class="sign" align="center">Crear Publicació</p>
            <form action="/BD2-practica/<?php echo basename(__DIR__) ?>/publicacionPublicada.php" class="form1" method="get">
                <input name="link" class="un " type="text" align="center" placeholder="Link de la imatge">
                <input name="text" class="un " type="text" align="center" placeholder="Text">
                <button type="submit" class="registerButton">CREAR</button>
        </div>

    </body>
</div>

</html>
<script>
$(document).ready(function() {

});
</script>