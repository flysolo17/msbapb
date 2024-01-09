<?php
$host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "admin_crud";


$conn = mysqli_connect($host, $db_username, $db_password);
mysqli_select_db($conn, $db_name) or ini_set('error_reporting', E_ALL);
?>