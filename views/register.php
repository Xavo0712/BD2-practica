<?php require_once "../db.php" ?>
<?php require_once "../head.php" ?>

<!DOCTYPE html>
<html lang="en">


<body>

    <div class="main">
        <?php $rootPath = $_SERVER['DOCUMENT_ROOT'];
        $thisPath = dirname($_SERVER['PHP_SELF']);
        $onlyPath = str_replace($rootPath, '', $thisPath); ?>
        <p class="sign" align="center">Register</p>
        <form action="<?php echo $onlyPath ?>/registrado.php" class="form1" method="get">
            <input name="nom" class="un " type="text" align="center" placeholder="Nom">
            <input name="telefon" class="un " type="text" align="center" placeholder="Telèfon">
            <input name="correu" class="un " type="text" align="center" placeholder="Email">
            <input name="nomUsuari" class="un " type="text" align="center" placeholder="Username">
            <input name="contrassenya" class="pass" type="password" align="center" placeholder="Contrassenya">
            <button type="submit" class="registerButton">Register</button>
    </div>

</body>

</html>