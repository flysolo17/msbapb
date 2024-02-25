

<?php
require_once '../config/connection.php';
require_once '../data/response.php';

// Check if the required parameters are provided
if (!isset($_POST['id']) || !isset($_POST['status'])) {
    $response = new Response(false, "Missing required parameters.");
    echo json_encode($response);
    exit;
}

$incidentId = $_POST['id']; 
$status = $_POST['status'];


$query = "UPDATE incidents SET status = ? WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);

if (!$stmt) {
    $response = new Response(false, "Error preparing statement: " . mysqli_error($conn));
    echo $response;
    exit;
}

mysqli_stmt_bind_param($stmt, 'ii', $status, $incidentId);


if (!mysqli_stmt_execute($stmt)) {
    $response = new Response(false, "Error executing statement: " . mysqli_stmt_error($stmt));
    echo $response;
    exit;
}

// Check if any rows were affected
if (mysqli_stmt_affected_rows($stmt) > 0) {
    $response = new Response(true, "Incident status updated successfully.");
    echo $response;
} else {
    $response = new Response(false, "No incident found with the provided ID.");
    echo $response;
}

mysqli_stmt_close($stmt);


?>