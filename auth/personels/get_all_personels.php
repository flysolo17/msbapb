<?php
require_once '../../config/connection.php';
require_once '../../data/response.php';

$sql = "SELECT 
    p.id,
    p.name,
    p.photo,
    p.position,
    pt.name AS type,
    CAST(p.contact AS CHAR) AS contact
FROM `personels` as p
JOIN `personel_type` AS pt ON pt.id = p.type;";

$result = $conn->query($sql);
if (!$result) {
    echo "Error: " . $conn->error;
} else {
    $rows = array();
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    echo json_encode($rows);
}

$conn->close();

?>
