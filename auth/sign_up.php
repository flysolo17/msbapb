<?php
require_once '../config/connection.php';
require_once '../data/response.php';

// Check if all required fields are set in the POST data
if(isset($_POST['office'], $_POST['name'], $_POST['type'], $_POST['email'], $_POST['password'])) {
    // Sanitize input data to prevent SQL injection
    $office = mysqli_real_escape_string($conn, $_POST['office']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    
    // Prepare the SQL statement
    $sql = "INSERT INTO administrators (office, name, type, email, password) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $response = new Response(
            false,
            "Error preparing statement: " . mysqli_stmt_error($stmt)
        );
        http_response_code(500);
        echo json_encode($response);
        exit;
    }

    // Bind parameters and execute the statement
    mysqli_stmt_bind_param($stmt, "sssss", $office, $name, $type, $email, $hashed_password);
    if (!mysqli_stmt_execute($stmt)) {
        $response = new Response(
            false,
            "Error executing query: " . mysqli_stmt_error($stmt)
        );
        http_response_code(500);
        echo json_encode($response);
        exit;
    }

    // If execution is successful
    $response = new Response(
        true,
        "Successfully Created!"
    );
    http_response_code(201);
    echo json_encode($response);

    // Close statement
    mysqli_stmt_close($stmt);

} else {
    // If required fields are not set
    $response = new Response(
        false,
        "All required fields are not set"
    );
    http_response_code(400);
    echo json_encode($response);
}

// Close connection
$conn->close();
?>
