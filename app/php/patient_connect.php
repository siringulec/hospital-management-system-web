<?php
function get_patient_id($db, $username) {
    $query = "SELECT patientID FROM patient WHERE username = ?";
    $rs = $db->prepare($query);
    $rs->bind_param("s", $username);
    $rs->execute();
    $result = $rs->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['patientID'];
    } else {
        return null; // or handle error accordingly
    }
}

function data($db, $patientID, $query) {
    if (empty($db)) {
        $msg = "Database connection error";
    } else if (empty($query)) {
        $msg = "No query";
    } else {
        $rs = $db->prepare($query);
        $rs->bind_param("i", $patientID);
        $rs->execute();
        $result = $rs->get_result();

        if ($result) {
            if ($result->num_rows > 0) {
                $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
                $msg = $row;
            } else {
                $msg = "No Data Found";
            }
        } else {
            $msg = mysqli_error($db);
        }
    }
    return $msg;
}
?>
