<?php
// Database connection
 

 $pwd = $_POST['password'];

// hash it with PASSWORD_DEFAULT
$hash = password_hash($pwd,  
          PASSWORD_DEFAULT); 
$username = $_POST['username']; 

$insert ="INSERT into tbl_user (user_id, username, password,full_name) 
 VALUES  ('', '$username', '$hash')";

if($conn->query($insert)){
  echo 'Data inserted successfully';
}
 else{
  echo 'Error '.$conn->error;  
}
?>