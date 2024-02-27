





<?php


require_once '../../config/connection.php';
require_once '../../data/response.php';

// Check if the required parameters are provided
if (!isset($_POST['id']) || !isset($_POST['active'])) {
    $response = new Response(false, "Missing required parameters.");
    echo $response;
    exit;
}

$personeID = $_POST['id']; 
$status = $_POST['active'];

$query = "UPDATE personels SET active = ? WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);

if (!$stmt) {
    $response = new Response(false, "Error preparing statement: " . mysqli_error($conn));
    echo $response;
    exit;
}

mysqli_stmt_bind_param($stmt, 'ii', $status, $personeID);


if (!mysqli_stmt_execute($stmt)) {
    $response = new Response(false, "Error executing statement: " . mysqli_stmt_error($stmt));
    echo $response;
    exit;
}

// Check if any rows were affected
if (mysqli_stmt_affected_rows($stmt) > 0) {
    $response = new Response(true, "Personel status updated successfully.");
    echo $response;
} else {
    $response = new Response(false, "No Personel found with the provided ID. " . $personeID);
    echo $response;
}

mysqli_stmt_close($stmt);
?>
