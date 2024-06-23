<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];

    // Check if password and confirm password match
    if ($password !== $confirmpassword) {
        echo "<script>alert('Passwords do not match. Please try again.')</script>";
        echo "<script>window.open('../html/signup.html', '_self');</script>";
        exit();
    }

    // Hash the password after confirmation
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    include_once 'dbconnect.php';

    if ($conn->connect_error) {
        echo "<script>alert('Database connection error')</script>";
        echo "<script>window.open('../html/signup.html', '_self');</script>";
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO patient (username, password, name, age, gender, phone) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiss", $username, $hashed_password, $name, $age, $gender, $phone);

    if ($stmt->execute()) {
        echo "<script>alert('New patient registered successfully.')</script>";
        echo "<script>window.open('../index.html', '_self')</script>";
    } else {
        if ($stmt->errno == 1062) {
            echo "<script>alert('Error: Duplicate entry for username or phone.')</script>";
            echo "<script>window.open('../html/signup.html', '_self')</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
    $conn->close();
}
?>
