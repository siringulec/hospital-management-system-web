<?php
include_once 'dbconnect.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$adminUsername = "adminini";
$adminPassword = password_hash("adminpass", PASSWORD_BCRYPT);

$sql = "INSERT INTO admin_table (username, password) VALUES ('$adminUsername', '$adminPassword')";

if ($conn->query($sql) === TRUE) {
    echo "New admin user created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
