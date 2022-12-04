<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/BD2-practica/assets/styles/styles1.css">
    <link rel="scriptsheet" href="scripts.js">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <title>Register</title>
</head>

<body>

    <div class="main">
        <p class="sign" align="center">Register</p>
        <form action="/BD2-practica/<?php echo basename(__DIR__) ?>/registrado.php" class="form1" method="get">
            <input name="nom" class="un " type="text" align="center" placeholder="Nom">
            <input name="telefon" class="un " type="text" align="center" placeholder="Telèfon">
            <input name="correu" class="un " type="text" align="center" placeholder="Email">
            <input name="nomUsuari" class="un " type="text" align="center" placeholder="Username">
            <input name="contrassenya" class="pass" type="password" align="center" placeholder="Contrassenya">
            <button type="submit" class="registerButton">Register</button>
    </div>

</body>

</html>