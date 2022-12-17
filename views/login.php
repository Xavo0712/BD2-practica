<!DOCTYPE html>
<html lang="en">
<?php require_once "../db.php" ?>

<?php require_once "../head.php" ?>

<body>

    <header>
        <h1>UIBBER</h1>
    </header>

    <div class="main">
        <p class="sign" align="center">Login</p>
        <?php $rootPath = $_SERVER['DOCUMENT_ROOT'];
        $thisPath = dirname($_SERVER['PHP_SELF']);
        $onlyPath = str_replace($rootPath, '', $thisPath); ?>
        <!-- absolute path to relative path TODO-->
        <form action="<?php echo $onlyPath ?>/principal.php" class="form1">
            <input name="nomUsuari" class="un " type="text" align="center" placeholder="Usuari">
            <input name="contrassenya" class="pass" type="password" align="center" placeholder="Contrassenya">
            <button type="submit" class="registerButton">Login</button>
            <p class="forgot" align="center"> <strong id="frase">No tens compte?</strong><a
                    href="<?php echo $onlyPath ?>/register.php" id="regi"> Registra't</p>
    </div>

</body>

</html>