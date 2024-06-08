<?php
include('dbconnect.php');

if (isset($_GET['a'])) {
    $medicineID = $_GET['a'];
    $sql = "DELETE FROM medicine WHERE medicineID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $medicineID);

    if ($stmt->execute()) {
        echo "<script>window.open('../html/medicines.html', '_self')</script>";
    } else {
        echo "<script>alert('Error deleting medicine!')</script>";
        echo "<script>window.open('../html/medicines.html', '_self')</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('No medicine ID provided!')</script>";
    echo "<script>window.open('../html/medicines.html', '_self')</script>";
}
?>
