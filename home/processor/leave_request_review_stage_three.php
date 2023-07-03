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

                $officer =    $_POST['officer'] ;
                $leave =   $_POST['leaveId'] ;
                $approveDays = $_POST['app_days'] ;
                $app_date =   $_POST['app_date'];
                $comment =   $_POST['comment'];
                $logged_in_user_role =   $_POST['logged_in_user_role'];

                $staff_role = $logged_in_user_role ;
                $stage = 3; //HOD
                
              
                
        try{  
             $update_query = "update leave_review set officer_id =:officer_id, leave_id =:leave_id, approved_days =:approved_days, approved_date =:approved_date, comments =:comments";
                $update_stmt = $conn->prepare($update_query);
             // DATA BINDING
                $conn->begintransaction();
               $update_stmt->bindValue(':officer_id',$officer,PDO::PARAM_INT);
               $update_stmt->bindValue(':leave_id',$leave,PDO::PARAM_INT);
               $update_stmt->bindValue(':approved_days', $approveDays,PDO::PARAM_STR);
                $update_stmt->bindValue(':approved_date', $app_date,PDO::PARAM_STR);
               $update_stmt->bindValue(':comments', $comment,PDO::PARAM_STR);
               $result = $update_stmt->execute();
                $employer = $conn->lastInsertId();

                $file = 'CAC';
                $update_leave_stage = "UPDATE leave_stage SET stage =:stage where leave_id=:leave_id";
                $update_stmt = $conn->prepare($update_leave_stage);
                 $update_stmt->bindValue(':leave_id',$leave,PDO::PARAM_INT);
                 $update_stmt->bindValue(':stage',$stage,PDO::PARAM_INT);
                 $update_stmt->execute();
                 $conn->commit();

                $_SESSION['rvSuccess'] = TRUE;
                header('location:../hod_reviewed'); 
        }
        catch(PDOException $e){
            $returnData = msg(0,500,'fail',$e->getMessage());
        }
    echo json_encode($returnData);