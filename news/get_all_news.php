


<?php 

require_once '../config/connection.php';
require_once '../data/response.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
$sql = "SELECT 
        n.photo,
        n.title,
        n.description,
        n.link,
        n.created_at as createdAt,
        p.name as type
     FROM news as n
     JOIN personel_type as p ON p.id = n.type
     ORDER BY n.created_at DESC
     ";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $news = array();
        while ($row = $result->fetch_assoc()) {
            $new = array(
                "photo" => $row['photo'],
                "title" => $row['title'],
                "description" => $row['description'],
                "link" => $row['link'],
                "createdAt" => $row['createdAt'],
                "type" => $row['type']
            );
            array_push($news, $new);
        }

        $response = new Response(
            true,
            "Fetch Successfully",
            $news
        );
        echo $response;
        http_response_code(200);
    } else {
        // No locations found
        $response = new Response(
            false,
            "No news found"
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
