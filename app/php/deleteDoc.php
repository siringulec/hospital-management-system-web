<?php
include('dbconnect.php');

if (isset($_GET['a'])) {
    $doctorID = $_GET['a'];
    $sql = "DELETE FROM doctor WHERE identification_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $doctorID);

    if ($stmt->execute()) {
        echo "Doctor deleted successfully.";
    } else {
        echo "Error deleting doctor: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No doctor ID provided.";
}
?>
