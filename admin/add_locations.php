<?php 

require_once '../config/connection.php';
require_once '../data/response.php';

if(isset($_POST['name'],$_POST['contact'], $_POST['lat'], $_POST['lang'], $_POST['type'])) {
    // Sanitize input data to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $lat = mysqli_real_escape_string($conn, $_POST['lat']);
    $lang = mysqli_real_escape_string($conn, $_POST['lang']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
 
    $sql = "INSERT INTO locations (name,contact, lat_lang, type) 
            VALUES ('$name','$contact', POINT($lat, $lang), '$type')";
    
    $result = $conn->query($sql);
    
    if($result === TRUE) {
        $response = new Response(
            true,
            "Successfully Created!"
        );
        http_response_code(201);
        echo $response; // Encode response to JSON
    } else {
        $response = new Response(false, "Error: " . $conn->error);
        http_response_code(500);
        echo $response; // Encode response to JSON
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
