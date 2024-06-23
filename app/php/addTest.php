<?php
include_once 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $testDescription = $_POST['testDescription'];

    $stmt = $conn->prepare("INSERT INTO type_of_test (type_of_test) VALUES (?)");
    $stmt->bind_param("s", $testDescription);

    if ($stmt->execute()) {
        echo "Medicine added successfully";
    } else {
        if ($stmt->errno == 1062) {
            echo "Error: Duplicate entry for test name.";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
    $conn->close();
}
?>
