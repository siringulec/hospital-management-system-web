<?php
include('dbconnect.php');

$sql = "
SELECT
    appointments.appointmentID,
    patient.name AS patient_name,
    doctor.name AS doctor_name,
    appointments.date,
    appointments.time
FROM
    appointments
JOIN
    patient ON appointments.patientID = patient.patientID
JOIN
    doctor ON appointments.doctorID = doctor.doctorID;
";

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
