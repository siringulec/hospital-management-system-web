<?php
$host = "db"; // Docker service name for the database
$user = "root";
$password = '';
$db_name = "hospital";

$conn = mysqli_connect($host, $user, $password, $db_name);
if (mysqli_connect_errno()) {
    die("Failed to connect with MySQL: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO patient (username, password, name, age, gender, phone) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiss", $username, $password, $name, $age, $gender, $phone);

    // Execute and check for errors
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
}

$conn->close();
?>
