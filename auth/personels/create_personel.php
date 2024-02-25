<?php

require_once '../../config/connection.php';
require_once '../../data/response.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
        

        $uploadDir = "../../uploads/";
        
        // Generate a unique filename
        $photoName = uniqid() . '_' . basename($_FILES["photo"]["name"]);
        
        // Path to save the uploaded photo
        $targetFilePath = $uploadDir . $photoName;
        
        // Move the uploaded file to the specified location
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath)) {
            
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $name = $_POST['name'];
            $position = $_POST['position'];
            $type = $_POST['type'];
            $contact = $_POST['contact'];

   
            
            $insertQuery = "INSERT INTO personels (photo, name, position, type, contact) VALUES ('$photoName', '$name', '$position', '$type', '$contact')";

            if ($conn->query($insertQuery) === TRUE) {
                http_response_code(201);
                $response = new Response(true, "User created successfully.");
                echo $response;
            } else {
                http_response_code(402); 
                $response = new Response(false, "Error: " . $insertQuery . "<br>" . $conn->error);
                echo $response;
            }
            $conn->close();
        } else {
            echo "Error uploading photo";
        }
        
    } else {
        http_response_code(404); 
        $response = new Response(false, "No file uploaded or an error occurred");
        echo $response;
    }
}

?>