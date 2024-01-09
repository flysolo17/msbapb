<?php
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "admin_crud";

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_password);
mysqli_select_db($conn, $db_name);
?>