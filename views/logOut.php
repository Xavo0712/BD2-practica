<!DOCTYPE html>
<html lang="en">

<?php require_once "../db.php"?>
<?php require_once "../head.php"?>

<body>

    <div class="main">
        <p class="sign" align="center">Segur que vols sortir?</p>
        <a href="/BD201/<?php echo basename(__DIR__) ?>/login.php" id="torn">Si, sortir</a>
        <a href="/BD201/<?php echo basename(__DIR__) ?>/main.php" id="torn">Cancelar</a>
    </div>

</body>
</html>