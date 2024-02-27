<?php


require_once '../config/connection.php';
require_once '../data/response.php';

// Check if the request body is provided
$requestBody = file_get_contents('php://input');
$data = json_decode($requestBody, true);

// Check if the required parameters are provided in the request body
if (!isset($data['incidents']) || !is_array($data['incidents'])) {
    $response = new Response(false, "Missing or invalid request body.");
    echo $response;
    exit;
}

// Prepare the INSERT statement
$query = "INSERT INTO respondents (incident_id, respondent_id) VALUES (?,?)";
$stmt = mysqli_prepare($conn, $query);

if (!$stmt) {
    $response = new Response(false, "Error preparing statement: " . mysqli_error($conn));
    echo $response;
    exit;
}

// Iterate through each object in the array and execute the insertion query
foreach ($data['incidents'] as $incident) {
    $incidentId = $incident['incident_id'];
    $respondentId = $incident['respondent_id'];

    mysqli_stmt_bind_param($stmt, 'ii', $incidentId, $respondentId);

    if (!mysqli_stmt_execute($stmt)) {
        $response = new Response(false, "Error executing statement: " . mysqli_stmt_error($stmt));
        echo $response;
        exit;
    }
}

// Check if any rows were affected
if (mysqli_stmt_affected_rows($stmt) > 0) {
    $response = new Response(true, "Respondents added successfully.");
    echo $response;
} else {
    $response = new Response(false, "No rows were inserted.");
    echo  $response;
}

mysqli_stmt_close($stmt);
?>