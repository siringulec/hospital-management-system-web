<?php
include_once 'dbconnect.php';

if (isset($_POST['s'])) {
    $m = $_POST['mid'];
    $st = $_POST['stck'];

    $sql = "UPDATE medicine 
            SET stock='$st'
            WHERE medicineID='$m'";
    $result_q = $conn->query($sql);

    if($result_q){
        echo "Data updated successfully";
    } else {
        echo "Error updating data: " . $conn->error;
    }

    $conn->close();
}
?>

