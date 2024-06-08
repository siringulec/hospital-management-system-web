<?php
include('dbconnect.php');

if (isset($_GET['a'])) {
    $doctorID = $_GET['a'];
    $sql = "DELETE FROM doctor WHERE doctorID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $doctorID);

    if ($stmt->execute()) {
        echo "<script>window.open('../html/doctor.html', '_self')</script>";
    } else {
        echo "<script>alert('Error deleting doctor!')</script>";
        echo "<script>window.open('../html/doctor.html', '_self')</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('No doctor ID provided!')</script>";
    echo "<script>window.open('../html/doctor.html', '_self')</script>";
}
?>
