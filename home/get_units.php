<?php
    if (isset($_POST['department'])) {
        $department = $_POST['department'];
        require_once "db.php";
        $return_arr = array();
        $result = mysqli_query($conn,"SELECT * FROM units where department_id  = $department");
        while ($row = mysqli_fetch_array($result)) { 
            $row_array = array("title" => $row['unit_name'], "id" => $row['id']); 
            array_push($return_arr,$row_array);     
        }
        echo json_encode($return_arr);
    }
?>