<?php
require_once '../config/connection.php';
require_once '../data/response.php';

// Check if email and password are set in the POST data
if(isset($_POST['email'], $_POST['password'])) {
    // Sanitize input data to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Prepare the SQL statement
    $sql = "SELECT id, office, name, photo, type, email, password FROM administrators WHERE email = ? LIMIT 1;";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        $response = new Response(false, "Error preparing statement: " . mysqli_error($conn));
        http_response_code(500);
        echo json_encode($response);
        exit;
    }

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "s", $email);

    // Execute the statement
    if (!mysqli_stmt_execute($stmt)) {
        $response = new Response(false, "Error executing query: " . mysqli_stmt_error($stmt));
        http_response_code(500);
        echo json_encode($response);
        exit;
    }

    // Bind result variables
    mysqli_stmt_bind_result($stmt, $user_id, $office, $name, $photo, $type, $email, $hashed_password);

    if (!mysqli_stmt_execute($stmt)) {
        $response = new Response(false, "Error executing query: " . mysqli_stmt_error($stmt));
        echo $response;
        exit;
      }
      
      mysqli_stmt_bind_result($stmt, $user_id, $office, $name, $photo, $type, $email, $hashed_password);
      
      if (mysqli_stmt_fetch($stmt)) {

        if (password_verify($password, $hashed_password)) {
          http_response_code(200);
          $response = new Response(true, "Login successful",  [
            'id' => $user_id,
            'office' => $office,
            'name' => $name,
            'photo' => $photo,
            'type' => $type,
            'email' => $email
        ]);
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
    }
?>
