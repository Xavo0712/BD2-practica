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
            <form action="/BD201/<?php echo basename(__DIR__) ?>/publicacionPublicada.php" class="form1" method="get">
                <input id="link" name="link" class="un " type="text" align="center" placeholder="Link de la imatge">
                <input id="text" name="text" class="un " type="text" align="center" placeholder="Text">
                <p class="sign" align="center">Afegir a una història</p>
                <select name="hist" class="form-select" style="width: auto; margin-left: 42.5%;" aria-label="Default select example">
                    <option selected value>No afegir</option>
                    <?php
                    foreach ($resultado as $m) {
                    ?>
                        <option value="<?php echo $m['idHist']; ?>"><?php echo $m['text']; ?></option>
                    <?php
                    }
                    ?>
                </select>
                <p class="errorMsg" style="color:red;" align="center">Rellene alguno de los 2 campos</p>
                <button id="createPost" type="submit" class="registerButton">CREAR</button>
        </div>

    </body>
</div>

</html>
<script>
    $(document).ready(function() {
        $('#createPost').click(function() {
            var link = $('#link').val();
            var text = $('#text').val();
            if (link == "" && text == "") {
                $('.errorMsg').show();
                $("form").submit(function(e) {
                    return false;
                });
            }
        });
    });
</script>