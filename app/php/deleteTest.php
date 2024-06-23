<?php
include('dbconnect.php');

if (isset($_GET['a'])) {
    $typeID = $_GET['a'];
    $sql = "DELETE FROM type_of_test WHERE typeID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $typeID);

    if ($stmt->execute()) {
        echo "<script>window.open('../html/tests.html', '_self')</script>";
    } else {
        echo "<script>alert('Error deleting tests!')</script>";
        echo "<script>window.open('../html/tests.html', '_self')</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('No type ID provided!')</script>";
    echo "<script>window.open('../html/tests.html', '_self')</script>";
}
?>
