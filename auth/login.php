<?php

require_once '../config/connection.php';
require_once '../data/response.php';

if (!isset($_POST['email']) || !isset($_POST['password'])) {
  http_response_code(400); // Bad Request
  exit("Missing required data: email and password.");
}

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$password = $_POST['password']; // No sanitization needed for password comparison

// Check database connection
if (!$conn) {
  http_response_code(500);
  exit("Database connection failed: " . mysqli_connect_error());
}

$sql = "SELECT id, fullname, password FROM users WHERE email = ?";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
  $response = new Response(false, "Error preparing statement: " . mysqli_error($conn));
  echo $response;
  exit;
}

mysqli_stmt_bind_param($stmt, "s", $email);

if (!mysqli_stmt_execute($stmt)) {
  $response = new Response(false, "Error executing query: " . mysqli_stmt_error($stmt));
  echo $response;
  exit;
}

mysqli_stmt_bind_result($stmt, $user_id, $fullname, $hashed_password);

if (mysqli_stmt_fetch($stmt)) {
  // Check password
  if (password_verify($password, $hashed_password)) {
    http_response_code(200);
    $response = new Response(true, "Login successful",  $user_id);
    echo $response;
  } else {
    http_response_code(401); // Unauthorized
    $response = new Response(false, "Invalid email or password");
    echo $response;
  }
} else {
  http_response_code(401); // Unauthorized
  $response = new Response(false, "Invalid email or password");
  echo $response;
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

?>
