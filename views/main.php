<html>
<div style="min-width: 100%">
    <?php require_once __DIR__ . "/header.php" ?>
    <?php require_once __DIR__ . "/chat.php" ?>

    <body class="mainBody">

        <h1><?php session_start();
                        echo var_dump($_SESSION); ?></h1>
        <p>Paragraph</p>
    </body>
</div>

</html>
<script>
$(document).ready(function() {

});
</script>