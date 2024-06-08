<?php
if (isset($_POST['submit'])) {
    $uname = $_POST['uname'];
    $nameDoc = $_POST['nameDoc'];
    $pass = $_POST['pass'];
    $spe = $_POST['spe'];
    $gender = $_POST['gender'];
    $phoneNum = $_POST['phoneNum'];

    include_once 'dbconnect.php';

    if (empty($conn)) {
        echo "<script>alert('Database connection error')</script>";
        echo "<script>window.open('../html/doctor.html','_self');</script>";
    } else {
        if (!empty($uname) && !empty($nameDoc) && !empty($pass) && !empty($spe) && !empty($gender) && !empty($phoneNum)) {
            
            $hashed_pass = password_hash($pass, PASSWORD_BCRYPT);

            $query = "INSERT INTO doctor (username, name, password, subspecialty, gender, phone) VALUES ('$uname', '$nameDoc', '$hashed_pass', '$spe', '$gender', '$phoneNum')";
            $res = mysqli_query($conn, $query);
            if ($res) {
                
                echo "<script>window.open('../html/doctor.html','_self');</script>";
            } else {
                echo "<script>alert('Error inserting data')</script>";
                echo "<script>window.open('../html/doctor.html','_self');</script>";
            }
        } else {
            echo "<script>alert('All fields are required')</script>";
            echo "<script>window.open('../html/doctor.html','_self');</script>";
        }
        $conn->close();
    }
} else {
    echo "<script>alert('Error submitting form')</script>";
    echo "<script>window.open('../html/doctor.html','_self');</script>";
}
?>
