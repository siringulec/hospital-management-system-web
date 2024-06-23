<?php
if (isset($_POST['submit'])) {
    $uname = $_POST['uname'];
    $name = $_POST['name'];
    $pass = $_POST['pass'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];

    include_once 'dbconnect.php';

    if (empty($conn)) {
        echo "<script>alert('Database connection error')</script>";
        echo "<script>window.open('../html/patients.html','_self');</script>";
    } else {
        if (!empty($uname) && !empty($name) && !empty($pass) && !empty($age) && !empty($gender) && !empty($phone)) {
            
            $hashed_pass = password_hash($pass, PASSWORD_BCRYPT);

            $query = "INSERT INTO patient (username, name, password, age, gender, phone) VALUES ('$uname', '$name', '$hashed_pass', '$age', '$gender', '$phone')";
            $res = mysqli_query($conn, $query);
            if ($res) {
                echo "<script>window.open('../html/patients.html','_self');</script>";
            } else {
                echo "<script>alert('Error inserting data')</script>";
                echo "<script>window.open('../html/patients.html','_self');</script>";
            }
        } else {
            echo "<script>alert('All fields are required')</script>";
            echo "<script>window.open('../html/patients.html','_self');</script>";
        }
        $conn->close();
    }
} else {
    echo "<script>alert('Error submitting form')</script>";
    echo "<script>window.open('../html/patients.html','_self');</script>";
}
?>
