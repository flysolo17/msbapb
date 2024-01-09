<?php
include 'conn.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<?php
if(isset($_GET['register_action'])){
	if($_GET['register_action'] == "success"){ ?>
	<div class="alert alert-success text-center" role="alert">
		Successfully register
	</div>
<?php
	}
}
?>
	<form method="POST" action="register-action.php">
		<div class="container col-md-3 mt-5">
		<center><img class="mt-5" src="img/MSBFP Transparent.png"
				height="100" width="100"></center>
				<h1 class="h3 mb-3 font-weight-normal text-center">Please Sign in</h1>
				<label for="username" class="font-weight-bold mr-auto">Username:</label>
				<input type="text" name="username" class="form-control mb-3" placeholder="Username" required=""></label>
				<label for="password" class="font-weight-bold mr-auto">Password:</label>
				<input type="password" name="password" class="form-control mb-3" placeholder="Password" required=""></label>

				<label for="fullname" class="font-weight-bold mr-auto">Fullname:</label>
				<input type="text" name="fullname" class="form-control mb-3" placeholder="Fullname" required=""></label>
				<button class="btn- btn-lg btn-primary btn-block" name="submit" type="submit">Sign in</button>
			</div>
	</form>
	<p class="text-center">Already a member? Click <a href="login.php">here</a> To login</p>
</body>
</html>