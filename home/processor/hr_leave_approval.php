<?php
session_start();
  $_SESSION['subType'] = $plan;
function msg($success,$status,$user,$message,$extra = []){
    return array_merge([
        'success' => $success,
        'status' => $status,
         'user' => $user,
        'message' => $message
    ],$extra);
}



require __DIR__.'/classes/Database.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();



                $leave_officer = $_SESSION['staff'];
                $approve_status = 1; //approved
                $leave_id =   $_POST['leaveId'];

                $stage = 4;
                $leave_status = 2; //approved

                
                $app_date =   $_POST['app_date'];
                $comment =   $_POST['comment'];
                $logged_in_user_role =   $_POST['logged_in_user_role'];

                $staff_role = $logged_in_user_role ;
               

        try{
                $update_query = "Update leave_request set leave_officer = :leave_officer, approve_status =:approve_status where leaveId =:leave_id";
                $update_stmt = $conn->prepare($update_query);
                $update_stmt->bindValue(':leave_officer',$leave_officer,PDO::PARAM_INT);
                $update_stmt->bindValue(':approve_status',$approve_status,PDO::PARAM_INT);
                $update_stmt->bindValue(':leave_id', $leave_id,PDO::PARAM_INT);
                $update_stmt->execute();
                $file = 'CAC';

                $update_leave_stage = "update leave_stage set stage =:stage, leave_status =:leave_status where leave_id=:leave_id";
                $update_stmt2 = $conn->prepare($update_leave_stage);
                $update_stmt2->bindValue(':stage',$stage,PDO::PARAM_INT);
                $update_stmt2->bindValue(':leave_status',$leave_status,PDO::PARAM_INT);
                $update_stmt2->bindValue(':leave_id',$leave_id,PDO::PARAM_INT);
                $update_stmt2->execute();

                $_SESSION['rvSuccess'] = TRUE;
                header('location:../approved_leaves');
    }
        catch(PDOException $e){
            $returnData = msg(0,500,'fail',$e->getMessage());
        }
    


echo json_encode($returnData);