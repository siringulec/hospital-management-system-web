<?php
include_once 'dbconnect.php';

if (isset($_POST['unameid'])) {
    $username = $_POST['unameid'];
}
if (isset($_POST['passid'])) {
    $password = $_POST['passid'];
}

$username = stripcslashes($username);
$password = stripcslashes($password);
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);

$query = "SELECT password FROM patient WHERE username = ?";
$rs = $conn->prepare($query);

if ($rs === false) {
    die("Failed to prepare the SQL statement: " . $conn->error);
}

$rs->bind_param("s", $username);
$rs->execute();
$result = $rs->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $hashed_password = $row['password'];

    if (password_verify($password, $hashed_password)) {
        include '../html/patient_dash.html';
    } else {
        echo "<script>alert('Login failed. Invalid username or password.')</script>";
        echo "<script>window.open('../index.html', '_self')</script>";
    }
} else {
    echo "<script>alert('Login failed. Invalid username or password.')</script>";
    echo "<script>window.open('../index.html', '_self')</script>";
}

$rs->close();
$conn->close();
?>
