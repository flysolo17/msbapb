<?php

require_once '../config/connection.php';
require_once '../data/response.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
        
        $uploadDir = "../uploads/";
      
        $photoName = uniqid() . '_' . basename($_FILES["photo"]["name"]);
        
        
        $targetFilePath = $uploadDir . $photoName;
        
    
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath)) {
            
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

        
            $title = htmlspecialchars($_POST['title']);
            $description = htmlspecialchars($_POST['description']);
            $link = htmlspecialchars($_POST['link']);
            $type = htmlspecialchars($_POST['type']);

            $insertQuery = $conn->prepare("INSERT INTO news (photo, title, description,link, type) VALUES (?, ?,?, ?, ?)");
            $insertQuery->bind_param("ssssi", $photoName, $title, $description,$link, $type);

            if ($insertQuery->execute()) {
                http_response_code(201);
                $response = new Response(true, "News created successfully.");
                echo $response;
            } else {
                http_response_code(402); 
                $response = new Response(false, "Error: " . $insertQuery->error);
                echo $response;
            }

            $insertQuery->close();
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
