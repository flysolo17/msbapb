<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "msbapb_db";
$port = 3307;

// Allow requests from any origin
header("Access-Control-Allow-Origin: *");

// Allow the following HTTP methods
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

// Allow the following headers
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

// Respond to preflight requests immediately
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit();
}

$conn = new mysqli($host, $username, $password, $database,$port);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$conn->set_charset("utf8mb4");



?>