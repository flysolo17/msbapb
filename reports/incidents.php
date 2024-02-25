<?php

require_once '../config/connection.php'; 

$sql = "SELECT 
  i.id,
  s.name as status,
  u.fullname,
  u.cp_number,
  u.email,
  i.location,
  i.type,
  i.description,
  s.name,
  sv.name as severity,
  GROUP_CONCAT(p.name SEPARATOR ', ') AS respondents,
  i.incident_date
FROM incidents AS i
JOIN users AS u ON u.id = i.reporter_id
JOIN incident_status AS s ON s.id = i.status
JOIN incident_severity AS sv ON sv.id = i.severity
LEFT JOIN respondents r ON i.id = r.incident_id
LEFT JOIN personels p ON r.respondent_id = p.id
GROUP BY i.id, u.fullname, u.cp_number, u.email, i.location, i.type, i.description, s.name, sv.name, i.incident_date
ORDER BY i.incident_date DESC;"
;


$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
  echo "Error preparing statement: " . mysqli_error($conn);
  exit;
}

if (!mysqli_stmt_execute($stmt)) {
  echo "Error executing query: " . mysqli_stmt_error($stmt);
  exit;
}

$result = mysqli_stmt_get_result($stmt);
if (!$result) {
    echo "Error getting results: " . mysqli_error($conn);
    exit;
  }
  
  $incidents = array();
  
  while ($row = mysqli_fetch_assoc($result)) {

    $reporter = array(
      "fullname" => $row['fullname'],
      "contact" => $row['cp_number'],
      "email" => $row['email']
    );
  

    unset($row['fullname']);
    unset($row['cp_number']);
    unset($row['email']);
    $row['reporter'] = $reporter;
  
    $incidents[] = $row;
  }
  
 
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
  
 
  header('Content-Type: application/json');
  echo json_encode($incidents);







?>
