<?php
function data($db, $id, $query)
{
    if (empty($db)) {
        $msg = "Database connection error";
    } else if (empty($query)) {
        $msg = "No query";
    } else {
        $rs = $db->prepare($query);
        $rs->bind_param("s", $id);
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
