<?php
require 'data connection.php';

if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];

    $query = "INSERT INTO tb_data VALUES('', '$name', '$email', '$latitude', '$longitude')";
    mysqli_query($conn, $query);

    echo
    "
    <script>
    alert('Data Added Successfully!');
    document.location.href = 'data index.php';
    </script>
    "
    ;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <body onload ="getLocation();">

       <meta charset="utf-8">
           <title>Personnels Data and Geolocations</title>
    </head>
    <body>

    <form class="myForm" action="" method="post" autocomplete="off">
      <label for="">Name</label>
      <input type="text" name="name" required value=""> <br>
      <label for="">Email</label>
      <input type="text" name="email" required value=""> <br>
      <input type="hidden" name="latitude" value="">
      <input type="hidden" name="longitude" value="">
      <button type="submit" name="submit">Submit</button>
    </form>
    <script type="text/javascript">
        function getLocation(){
            if(navigator.geolocation){
                navigator.geolocation.getCurrentPosition(showPosition,showError);
            }
        }
        function showPosition(position){
            document.querySelector('.myForm input[name = "latitude"]').value = position.coords.latitude;
            document.querySelector('.myForm input[name = "longitude"]').value = position.coords.longitude;
        }
        function showError(error){
            switch(error.code){
                case error.PERMISSION_DENIED:
                alert("You Must Allow The Request for Geolocation To Fill Out The Form");
                location.reload();
                break;
            }
        }
      </script>
      <br>
      <a href="data.php">Database Page</a>
    </body>
</html> 