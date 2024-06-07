<?php
include('dbconnect.php');

// SQL query to select data from the database
$sql = "SELECT * FROM type_of_test";
$result = $conn->query($sql);

$tests = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tests[] = $row;
    }
}

// Close the connection
$conn->close();

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($tests);
?>
