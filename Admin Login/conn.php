<?php
$host = "127.0.0.1:3307";
$db_username = "root";
$db_password = "";
$db_name = "admin_crud";
 

$insert ="INSERT into tbl_user (user_id, username, password,full_name) 
 VALUES  ('', '$username', '$hash')";

if($conn->query($insert)){
  echo 'Data inserted successfully';
}
 else{
  echo 'Error '.$conn->error;  
}

$conn = mysqli_connect($host, $db_username, $db_password);
mysqli_select_db($conn, $db_name) or ini_set('error_reporting', E_ALL);
?>