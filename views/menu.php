<?php require_once "../db.php"?>
<?php require_once "../head.php"?>

<div id="mySidenav" class="sidenav">
    <a href="#" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="main.php">Inicio</a>
    <a href="profile.php?idUser=<?php echo $_COOKIE['user']?>">Mi Perfil</a>
    <a href="chatPage.php">Chats</a>
    <a href="crearPublicacion.php">Crear Publicación</a>
    <a href="crearHistoria.php">Crear Historia</a>
    <a href="borrarHistoria.php">Borrar Historia</a> 
</div>

<script>
function openNav() {
    $("#mySidenav").css("width", "250px");
    $(".mainBody").css("margin-left", "250px");
    $("#navOpener").removeClass("visible");
    $("#navOpener").addClass("hidden");
}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
function closeNav() {
    $("#mySidenav").css("width", "0px");
    $(".mainBody").css("margin-left", "0px");
    $("#navOpener").removeClass("hidden");
    $("#navOpener").addClass("visible");
}
</script>