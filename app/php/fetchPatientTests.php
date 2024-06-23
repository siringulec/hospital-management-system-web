<?php
include('dbconnect.php');

$sql = "
SELECT
    test.testID,
    patient.name AS patient_name,
    type_of_test.type_of_test AS test_name,
    test.date,
    test.results
FROM
    test
JOIN
    patient ON test.patientID = patient.patientID
JOIN
    type_of_test ON test.type_of_test = type_of_test.typeID
";

$result = $conn->query($sql);

$test = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $test[] = $row;
    }
}

// Close the connection
$conn->close();

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($test);
?>
