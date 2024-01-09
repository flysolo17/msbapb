<?php
include 'conn.php';
session_start();


if(isset($_POST['username'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $login = mysqli_query($conn, "SELECT * FROM user_tbl WHERE username='$username' AND password='$password'");

    $row = mysqli_fetch_assoc($login);
    if($row >= 1){
        $_SESSION['$username'] = $username;
        header("Location: dashboard.php");
    }else{
        header("Location: index.html?success=success");
    }
}


?>