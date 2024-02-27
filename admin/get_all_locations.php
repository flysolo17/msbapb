<?php 

require_once '../config/connection.php';
require_once '../data/response.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
$sql = "SELECT l.name,l.contact, p.name as type, X(l.lat_lang) AS latitude, Y(l.lat_lang) AS longitude
     FROM locations as l
     JOIN personel_type as p ON p.id = l.type
     ";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $locations = array();
        while ($row = $result->fetch_assoc()) {
            $location = array(
                "name" => $row['name'],
                "contact" => $row['contact'],
                "type" => $row['type'],
                "latitude" => $row['latitude'],
                "longitude" => $row['longitude']
            );
            array_push($locations, $location);
        }

        $response = new Response(
            true,
            "Fetch Successfully",
            $locations
        );
        echo $response;
        http_response_code(200);
    } else {
        // No locations found
        $response = new Response(
            false,
            "No locations found"
        );
        http_response_code(404);
        echo $response;
    }
} else {
    // Invalid request method
    $response = new Response(
        false,
        "Invalid request method"
    );
    http_response_code(405);
    echo $response;
}

$conn->close();
?>
