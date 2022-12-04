<!DOCTYPE html>
<html lang="en">

<body>

    <header>
        <h1>UIBFLIX</h1>
    </header>

    <div class="main">
        <p class="sign" align="center">Login</p>
        <form action="/BD2-practica/<?php echo basename(__DIR__) ?>/principal.php" class="form1">
            <input name="nomUsuari" class="un " type="text" align="center" placeholder="Usuari">
            <input name="contrassenya" class="pass" type="password" align="center" placeholder="Contrassenya">
            <button type="submit" class="registerButton">Login</button>
            <p class="forgot" align="center"> <strong id="frase">No tens compte?</strong><a href="/BD2-practica/<?php echo basename(__DIR__) ?>/register.php" id="regi">Registra't</p>
    </div>

</body>

</html>