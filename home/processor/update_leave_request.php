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
              
                
        try{
            
            
         
                
             $update_query = "UPDATE leave_review SET officer_id =:officer_id, leave_id =:leave_id, approved_days=:approved_days,
             approved_date =:approved_date, comments =:comments";
                $update_stmt = $conn->prepare($update_query);

             // DATA BINDING
               $update_stmt->bindValue(':officer_id',$officer,PDO::PARAM_INT);
               $update_stmt->bindValue(':leave_id',$leave,PDO::PARAM_INT);
               $update_stmt->bindValue(':approved_days', $approveDays,PDO::PARAM_STR);
                $update_stmt->bindValue(':approved_date', $app_date,PDO::PARAM_STR);
               $update_stmt->bindValue(':comments', $comment,PDO::PARAM_STR);
               $result = $update_stmt->execute();
                $leave_review_id = $conn->lastInsertId();

                $file = 'CAC';
                if($result){
                    
                $update_leave_stage = "UPDATE leave_stage SET stage =:stage where leave_id=:leave_id";
                $update_stmt = $conn->prepare($update_leave_stage);
                 $update_stmt->bindValue(':leave_id',$leave,PDO::PARAM_INT);
                 $update_stmt->bindValue(':stage',$stage,PDO::PARAM_INT);
                 $update_stmt->execute();

                    if($review == 'hrm'){
                    $stat = 1;
                 
    
           $update_query2 = "UPDATE leave_request  SET md_hr=:stat WHERE leaveId = :rid";
              $update_stmt2 = $conn->prepare($update_query2);
             //    DATA BINDING
                  $update_stmt2->bindValue(':rid',$leave, PDO::PARAM_INT);
                $update_stmt2->bindValue(':stat',$stat ,PDO::PARAM_INT);
               $update_stmt2->execute();
               
               $_SESSION['rvSuccess'] = TRUE;
    
            header('location:../hr_reviewed');

             
 
                    }elseif($review == 'sup'){
                        
                        
                         $stat = 1;
                 
    
            $update_query3 = "UPDATE leave_request  SET supervisor_office=:stat WHERE leaveId = :rid";

              $update_stmt3 = $conn->prepare($update_query3);

             //    DATA BINDING
                  $update_stmt3->bindValue(':rid',$leave, PDO::PARAM_INT);
            
               $update_stmt3->bindValue(':stat',$stat ,PDO::PARAM_INT);
               
               $update_stmt3->execute();
               
               $_SESSION['rvSuccess'] = TRUE;
    
            header('location:../s_reviewed');

             
             }elseif($review == 'app'){
                 
                 
                 
                     $stat = 1;
                      $sta = 1;
                 
    
           $update_query4 = "UPDATE leave_request  SET leave_officer=:stat, approve_status=:sta WHERE leaveId = :rid";

              $update_stmt4 = $conn->prepare($update_query4);

             //    DATA BINDING
                  $update_stmt4->bindValue(':rid',$leave, PDO::PARAM_INT);
                   $update_stmt4->bindValue(':sta',$sta, PDO::PARAM_INT);
            
               $update_stmt4->bindValue(':stat',$stat ,PDO::PARAM_INT);
               
               $update_stmt4->execute();
               
               
               $_SESSION['rvSuccess'] = TRUE;
    
            header('location:../approved_leaves');

             }
                    
               
                  
}
        }
        catch(PDOException $e){
            $returnData = msg(0,500,'fail',$e->getMessage());
        }
    


echo json_encode($returnData);