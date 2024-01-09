<?php
include 'conn.php';

if(isset($_POST['username'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$fullname = $_POST['fullname'];
	$password=password_hash($_POST['$password'], PASSWORD_DEFAULT);


	$register = mysqli_query($conn, "INSERT INTO user_tbl (username,password,full_name) VALUES ('$username','$password', '$fullname')");
	if($register){
		header("Location: registration.php?register_action=success");
	}else{
		 ini_set('error_reporting', E_ALL);
	}
}	
?>