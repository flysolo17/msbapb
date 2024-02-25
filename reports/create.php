<?php

require_once '../config/connection.php';
require_once '../data/response.php';

$required_fields = ['reporter_id', 'location', 'type', 'description', 'status', 'severity'];

// Check for missing required fields
$missing_fields = array_diff($required_fields, array_keys($_POST));
if (!empty($missing_fields)) {
    $response = new Response(false, "Missing required fields: " . implode(', ', $missing_fields));
    echo $response;
    exit;
}

// Sanitize inputs (implement appropriate validation based on data type)
$reporter_id = filter_var($_POST['reporter_id'], FILTER_SANITIZE_NUMBER_INT);
$location = filter_var($_POST['location'], FILTER_SANITIZE_STRING);
$type = filter_var($_POST['type'], FILTER_SANITIZE_STRING);
$description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
$status = filter_var($_POST['status'], FILTER_SANITIZE_NUMBER_INT);
$severity = filter_var($_POST['severity'], FILTER_SANITIZE_NUMBER_INT);

// Prepare and execute the query
$sql = "INSERT INTO incidents (reporter_id, location, type, description, status, severity, incident_date) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    $response = new Response(false, "Error preparing statement: " . mysqli_error($conn));
    echo $response;
    exit;
}

$incident_date = date("Y-m-d H:i:s");  
mysqli_stmt_bind_param($stmt, "isssiis", $reporter_id, $location, $type, $description, $status, $severity, $incident_date);

if (!mysqli_stmt_execute($stmt)) {
    $response = new Response(false, "Error executing query: " . mysqli_stmt_error($stmt));
    echo $response;
    exit;
}

if (mysqli_stmt_affected_rows($stmt) > 0) {
    $response = new Response(true, "Incident created successfully.");
    echo $response;
} else {
    $response = new Response(false, "Incident creation failed.");
    echo $response;
}

mysqli_stmt_close($stmt);
mysqli_close($conn);


?>