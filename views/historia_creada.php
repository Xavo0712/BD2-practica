
<?php require_once "../db.php"?>
<?php require_once "../head.php"?>

<?php   
    //comprobar formulario es correcto
    

    $tipo=$_POST['tipus'];
    //$titulo=$_POST['titulo'];

    /*
    $con = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($con, "bd201");
    $consulta="INSERT INTO historia (idHist,tipus,idUser) VALUES ('".$tipo."')";
    $resultado = mysqli_query($con, $consulta);
    */

    DB::run("INSERT INTO historia (idHist,tipus,idUser) VALUES (?)", [$_POST['tipus']]);    
?>
