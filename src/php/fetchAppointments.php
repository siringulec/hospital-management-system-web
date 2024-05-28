<?php
include('dbconnect.php');

// SQL query to select data from database
$sql = "SELECT * FROM appointments";
$result = $conn->query($sql);

$appointments = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }
}

// Close the connection
$conn->close();

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($appointments);
?>
