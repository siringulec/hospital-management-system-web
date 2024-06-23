<?php
include('dbconnect.php');

$sql = "
SELECT
    prescription.prescriptionID,
    patient.name AS patient_name,
    medicine.name AS medicine_name,
    prescription.date,
    prescription.dosage
FROM
    prescription
JOIN
    patient ON prescription.patientID = patient.patientID
JOIN
    medicine ON prescription.medicineID = medicine.medicineID
";

$result = $conn->query($sql);

$medicine = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $medicine[] = $row;
    }
}

// Close the connection
$conn->close();

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($medicine);
?>
