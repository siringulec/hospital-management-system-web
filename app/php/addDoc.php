<?php
if (isset($_POST['submit'])) {
    $idd = $_POST['idd'];
    $nameDoc = $_POST['nameDoc'];
    $pass = $_POST['pass'];
    $spe = $_POST['spe'];
    $gender = $_POST['gender'];
    $phoneNum = $_POST['phoneNum'];

    include_once 'dbconnect.php';

    if (empty($conn)) {
        echo "<script>alert('Database connection error'); window.open('doctor.html','_self');</script>";
    } else {
        if (!empty($idd) && !empty($nameDoc) && !empty($pass) && !empty($spe) && !empty($gender) && !empty($phoneNum)) {
            $query = "INSERT INTO doctor (identification_number, name, pass, subspecialty, gender, phone) VALUES ('$idd', '$nameDoc', '$pass', '$spe', '$gender', '$phoneNum')";
            $res = mysqli_query($conn, $query);
            if ($res) {
                echo "<script>alert('Data updated successfully'); window.open('doctorTable.html','_self');</script>";
            } else {
                echo "<script>alert('Error inserting data'); window.open('doctor.html','_self');</script>";
            }
        } else {
            echo "<script>alert('All fields are required'); window.open('doctor.html','_self');</script>";
        }
        $conn->close();
    }
} else {
    echo "<script>alert('Error submitting form'); window.open('doctor.html','_self');</script>";
}
?>
