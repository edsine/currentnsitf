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
                
                
                   $review =    $_POST['review'] ;
                  $leave =   $_POST['leaveId'] ;
                $comment =   $_POST['comment'];
                $logged_in_user_role =   $_POST['logged_in_user_role'];

                $staff_role = $logged_in_user_role ;
                $stage = 2;
                
              
                
        try{
            
            
         
                
             $update_query = "UPDATE leave_review SET comments =:comments where leave_id =:leave_id";
                $update_stmt = $conn->prepare($update_query);
               $update_stmt->bindValue(':comments', $comment,PDO::PARAM_STR);
               $update_stmt->bindValue(':leave_id',$leave,PDO::PARAM_INT);
               $result = $update_stmt->execute();
                $leave_review_id = $conn->lastInsertId();

                $file = 'CAC';
                if($result){
                
                $leave_status = 0; //suspended
                $update_leave_stage = "UPDATE leave_stage SET leave_status =:leave_status where leave_id=:leave_id";
                $update_stmt2 = $conn->prepare($update_leave_stage);
                 $update_stmt2->bindValue(':leave_status',$leave_status,PDO::PARAM_INT);
                 $update_stmt2->bindValue(':leave_id',$leave,PDO::PARAM_INT);
                 $update_stmt2->execute();
    
                header('location:../s_reviewed');
            }
        }
        catch(PDOException $e){
            $returnData = msg(0,500,'fail',$e->getMessage());
        }
    


echo json_encode($returnData);