<html>
<div style="min-width: 100%">
    <?php require_once __DIR__ . "/header.php" ?>
    <?php require_once __DIR__ . "/chat.php" ?>

    <body class="mainBody">

        <div class="mainThings">
            <a href="/BD2-practica/<?php echo basename(__DIR__) ?>/logOut.php" id="torn" style="margin-left: 88%;">Log
                Out</a>

            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <select id="users" class="form-select" onchange="handleSelect(this)">
                            <option value="" selected>Cerca un usuari</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </body>
</div>

</html>
<script>
$(document).ready(function() {
    var data;
    getAllUsers(function(response) {
        data = response;
    });

    for (let i = 0; i < data.length; i++) {
        user = data[i];
        const us = "<?php echo $_COOKIE['user']; ?>";
        if (user.idUser != us) {
            $("#users").append("<option value='" + user.idUser + "'>" + user.username + "</option>")
        }
    }

    var select1 = document.querySelector('#users');
    dselect(select1, {
        search: true
    });
});

function handleSelect(elm) {
    window.location.replace("profile.php?idUser=" + elm.value);
}
</script>