<?php
session_start();
include('conn.php');

function sendemail_verify()
{
    
}



if(isset($_POST['btn- btn-lg btn-primary btn-block']))
{
 $username = $_POST['username'];
 $password = $_POST['password'];
 $fullname = $_POST['fullname'];
 $verify_token = md5(rand());

 // Email Exists or not
 $check_email_query = "SELECT * username  FROM users WHERE  username='$username' LIMIT 1";
 $check_email_query_run = mysqli_query($conn, $check_email_query);

 if($mysql-_number_rows($check_email_query_run) > 0)
 {
     $_SESSION['status'] = "Email Id already Exists";
     header("location: registration.php");
 }
 else
 {
        // Insert User / Registered User Data
        $query = "INSERT INTO table_user (username,password,fullname) VALUES ('$username','$password','$fullname','$verify_token')";
        $query_run = mysqli_query($con, $query);

        if($query_run)
        {
            sendemail_verify("$username","$password","$fullname","$verify_token");

            $_SESSION['$status'] = "Registration Successful.! Please verify your Email Address.";
            header("location: registration.php");
        }
        else
        $_SESSION['$status'] = "Registration Failed";
        header("location: registration.php");
        }
    }


?>