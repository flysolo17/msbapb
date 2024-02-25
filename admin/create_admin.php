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
    

    $sql = "INSERT INTO administrators (office, name, type, email, password) 
            VALUES ('$office', '$name', '$type', '$email', '$hashed_password')";
    
    $result = $conn->query($sql);
    
    if($result  === TRUE) {
        $response = new Response(
            true,
            "Successfully Created!"
        );
        http_response_code(201);
        echo $response;
    } else {
        $response = new Response(false, "Error: " . $conn->error);
        http_response_code(500);
        echo $response;
    }
} else {
    $response = new Response(
        false,
        "All required fields are not set"
    );
    http_response_code(400);
    echo $response;
}



$conn->close();
?>
