<!DOCTYPE html>
<head>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="style.css">
    <body>
    <?php
    include 'sidebar and Navbar.html';
    if (isset($_POST["submit_address"]))
    {
        $address = $_POST["address"];
        $address = str_replace(" ", "+", $address);
        ?>
 
        <iframe width="100%" height="500" src="https://maps.google.com/maps?q=<?php echo $address; ?>&output=embed"></iframe>
 
        <?php
    }
    if (isset($_POST["submit_coordinates"]))
    {
        $latitude = $_POST["latitude"];
        $longitude = $_POST["longitude"];
        ?>
 
        <iframe width="100%" height="500" src="https://maps.google.com/maps?q=<?php echo $latitude; ?>,<?php echo $longitude; ?>&output=embed"></iframe>
 
        <?php
    }

?>
<form method="POST">
    <br>
    <br>
                   <Center> <h2> Welcome Admin</h2></Center>
    <hr>
    <br>
    <br>
    <br>
    <br>
       <p>
        <center><input type="text" name="address" placeholder="Enter address"></center>
       </p>
       <br>
   
       <center> <input type="submit" name="submit_address"style="background-color:blue;color:white;width:80px;height:30px;" value="Submit"></center>
       <br>
</form>
<form method="POST">
        <p>
           <center> <input type="text" name="latitude" placeholder="Enter latitude">
        </p>
        <br>
        <p>
            <input type="text" name="longitude" placeholder="Enter longitude">
        </p>
        <br>
        <input type="submit" name="submit_coordinates" style="background-color:blue;color:white;width:80px;height:30px;" value="Submit"></center>
      
</form>
    <br>
    <br>
    <br>
    <br>
    <style>
h2 {
  color: blue;
  font-family: verdana;
  font-size: 300%;
}
p {
  color: red;
  font-family: courier;
  font-size: 160%;
}
</style>
</head>
<body>

    <br>
    <br>
    <br>
    <br>

</body>
</head>
</html>





