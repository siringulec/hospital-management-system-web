<?php
include('dbconnect.php');

if (isset($_GET['a'])) {
    $patientID = $_GET['a'];
    $sql = "DELETE FROM patient WHERE patientID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $patientID);

    if ($stmt->execute()) {
        echo "<script>window.open('../html/patients.html', '_self')</script>";
    } else {
        echo "<script>alert('Error deleting patient!')</script>";
        echo "<script>window.open('../html/patients.html', '_self')</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('No patient ID provided.')</script>";
    echo "<script>window.open('../html/patients.html', '_self')</script>";
}
?>
