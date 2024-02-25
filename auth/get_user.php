<?php
require_once '../config/connection.php';
require_once '../data/response.php';




$stmt = $conn->prepare("SELECT id,fullname,address,cp_number as phone,email FROM users WHERE id = ?");

$stmt->bind_param("i", $uid);



header('Content-Type: application/json');


if (!isset($_GET['uid'])) {
    http_response_code(400);
    echo json_encode(new Response(false, "Missing required data."));
    exit;
}

$uid = filter_input(INPUT_GET, 'uid', FILTER_SANITIZE_NUMBER_INT);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        http_response_code(200);
        $response = new Response(true, "Fetch successful",  $user);
        echo $response;
    } else {
        http_response_code(404);
        echo json_encode(new Response(false, "User not found!"));
    }
} else {
    http_response_code(500);
    echo json_encode(new Response(false, "Database error"));
}

  $stmt->close();
  $conn->close();
?>

