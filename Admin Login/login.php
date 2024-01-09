<?php
include 'conn.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
	<form method="POST" action="login-action.php">
		<div class="container col-md-3 mt-5">
		<center><img class="mt-5" src="img/MSBAPB.png"
				height="100" width="100"></center>
			<center><img class="mt-5" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg"
				height="75" width="75"></center>
				<h1 class="h3 mb-3 font-weight-normal text-center">Please Sign in</h1>
				<label for="username" class="font-weight-bold mr-auto">Username:</label>
				<input type="text" name="username" class="form-control mb-3" placeholder="Username" required=""></label>
				<label for="password" class="font-weight-bold mr-auto">Password:</label>
				<input type="password" name="password" class="form-control mb-3" placeholder="Password" required=""></label>
				

				<button class="btn- btn-lg btn-primary btn-block" name="submit" type="submit">Sign in</button> 
				<a href="registration.php" class="btn btn-lg btn-success btn-block" name="submit">Register</a>
			</div>
	</form>
</body>
</html>