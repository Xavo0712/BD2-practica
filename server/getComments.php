<?php require_once "../db.php" ?>

<?php
    $commentsInfo = DB::run("SELECT usuari.idUser, usuari.username, usuari.imagen, resposta.text, resposta.data FROM resposta 
    JOIN usuari ON resposta.idUser = usuari.idUser WHERE idPub = ? ORDER BY DATA DESC", [$_GET['postId']])->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($commentsInfo);
?>