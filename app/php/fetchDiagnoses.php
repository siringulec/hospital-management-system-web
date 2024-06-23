<?php
include('dbconnect.php');

$sql = "
SELECT
    diagnosis.diagnosisID,
    patient.name AS patient_name,
    diagnosis.date,
    diagnosis.symptoms,
    diagnosis.diagnosis
FROM
    diagnosis
JOIN
    patient ON diagnosis.patientID = patient.patientID
";

$result = $conn->query($sql);

$diagnoses = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $diagnoses[] = $row;
    }
}

// Close the connection
$conn->close();

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($diagnoses);
?>
