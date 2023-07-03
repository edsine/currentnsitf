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



require __DIR__.'/classes/database.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();



            //     $nin =  $_POST['nin'];
                
                  
                      //$insId = $_POST['inspId'] ;
                $officer =    $_POST['officer'] ;
                   $review =    $_POST['review'] ;
                  $leave =   $_POST['leaveId'] ;
                 $approveDays = $_POST['app_days'] ;
                $app_date =   $_POST['app_date'];
                $comment =   $_POST['comment'];
                $logged_in_user_role =   $_POST['logged_in_user_role'];

                $staff_role = $logged_in_user_role ;
                $stage = 2;
                $leave_officer = $_SESSION['staff'];
                
                
              
                
        try{
            
            
         
                
             $insert_query = "INSERT INTO `leave_review`(officer_id, `leave_id`, `approved_days`, `approved_date`, `comments`) VALUES(:officer_id,:leave_id,:approved_days, :approved_date, :comments)";
                $insert_stmt = $conn->prepare($insert_query);
                $conn->begintransaction();
             // DATA BINDING
               $insert_stmt->bindValue(':officer_id',$officer,PDO::PARAM_INT);
               $insert_stmt->bindValue(':leave_id',$leave,PDO::PARAM_INT);
               $insert_stmt->bindValue(':approved_days', $approveDays,PDO::PARAM_STR);
                $insert_stmt->bindValue(':approved_date', $app_date,PDO::PARAM_STR);
               $insert_stmt->bindValue(':comments', $comment,PDO::PARAM_STR);
               $result = $insert_stmt->execute();
                $employer = $conn->lastInsertId();

                $file = 'CAC';
                $update_leave_stage = "UPDATE leave_stage SET stage =:stage where leave_id=:leave_id";
                $update_stmt = $conn->prepare($update_leave_stage);
                $update_stmt->bindValue(':leave_id',$leave,PDO::PARAM_INT);
                $update_stmt->bindValue(':stage',$stage,PDO::PARAM_INT);
                $update_stmt->execute();
                $conn->commit();
            
                $_SESSION['rvSuccess'] = TRUE;
                header('location:../s_reviewed');
        }
        catch(PDOException $e){
            $returnData = msg(0,500,'fail',$e->getMessage());
            $conn->rollback();
        }
    


echo json_encode($returnData);