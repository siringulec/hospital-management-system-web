<?php
include_once 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $medName = $_POST['medName'];
    $medStock = $_POST['medStock'];

    $stmt = $conn->prepare("INSERT INTO medicine (name, stock) VALUES (?, ?)");
    $stmt->bind_param("si", $medName, $medStock);

    if ($stmt->execute()) {
        echo "Medicine added successfully";
    } else {
        if ($stmt->errno == 1062) {
            echo "Error: Duplicate entry for medicine name.";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
    $conn->close();
}
?>
