<?php
include_once 'dbconnect.php';
if (isset($_POST['unameid'])) {
    $Id = $_POST['unameid'];
}
if (isset($_POST['passid'])) {
    $password = $_POST['passid'];
}
// $submitbutton = $_POST['btn1'];

$Id = stripcslashes($Id);
$password = stripcslashes($password);
$Id = mysqli_real_escape_string($conn, $Id);
$password = mysqli_real_escape_string($conn, $password);
$query = "SELECT identification_number, pass FROM patient WHERE pass =? AND identification_number =?";
$rs = $conn->prepare($query);
$rs->bind_param("si", $password, $Id);
$rs->execute();
$result = $rs->get_result();
if ($Id == 'admin' && $password == 'admin') {
    include 'dash.html';
} elseif (mysqli_num_rows($result) == 1) {
    include 'patient_dash.html';
} else {
    echo "<script>alert(' Login failed. Invalid username or password.')</script>";
    echo "<script>window.open('index.html','_self')</script>";
}
// close connection
mysqli_close($conn);
