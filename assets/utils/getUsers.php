<?php
$con = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($con, "bd201");
/* Getting demo_viewer table data */
$sql = "SELECT * FROM usuari";
$users = mysqli_query($con, $sql);
$usersArray = array();
while ($row = $users->fetch_assoc()) {
	$usersArray[] = $row;
}
$usersJSON = json_encode($usersArray);
echo $usersJSON;
?>

