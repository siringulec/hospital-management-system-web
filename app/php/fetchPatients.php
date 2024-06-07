<?php
include('dbconnect.php');

// SQL query to select data from database
$sql = "SELECT * FROM patient";
$result = $conn->query($sql);

$patients = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $patients[] = $row;
    }
}

// Close the connection
$conn->close();

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($patients);
?>
