<?php
include('dbconnect.php');

// SQL query to select data from the database
$sql = "SELECT * FROM doctor";
$result = $conn->query($sql);

$doctors = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $doctors[] = $row;
    }
}

// Close the connection
$conn->close();

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($doctors);
?>
