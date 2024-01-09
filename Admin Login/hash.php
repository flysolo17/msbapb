<?php
// Password encrytion

   $password=20;
   
    if($password>21){
      echo $password=password_hash($_POST['$password'], PASSWORD_DEFAULT);
    }
    else{
      echo "thank you";
    }

?>