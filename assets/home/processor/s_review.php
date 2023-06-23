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
                
              
                
        try{
            
            
         
                
             $insert_query = "INSERT INTO `leave_review`(officer_id, `leave_id`, `approved_days`, `approved_date`, `comments`) VALUES(:officer_id,:leave_id,:approved_days, :approved_date, :comments)";
                     $insert_stmt = $conn->prepare($insert_query);

             // DATA BINDING
               $insert_stmt->bindValue(':officer_id',$officer,PDO::PARAM_INT);
               $insert_stmt->bindValue(':leave_id',$leave,PDO::PARAM_INT);
               
               $insert_stmt->bindValue(':approved_days', $approveDays,PDO::PARAM_STR);
               
               
                $insert_stmt->bindValue(':approved_date', $app_date,PDO::PARAM_STR);
               $insert_stmt->bindValue(':comments', $comment,PDO::PARAM_STR);
               
              
               
                         
              
         
                 
                 
               $result = $insert_stmt->execute();
                $employer = $conn->lastInsertId();
                $file = 'CAC';
               
               
                
                if($result){
                    
                    
                    if($review == 'hrm'){
                    $stat = 1;
                 
    
           $update_query = "UPDATE leave_request  SET md_hr=:stat WHERE leaveId = :rid";

              $insert1_stmt = $conn->prepare($update_query);

             //    DATA BINDING
                  $insert1_stmt->bindValue(':rid',$leave, PDO::PARAM_INT);
            
               $insert1_stmt->bindValue(':stat',$stat ,PDO::PARAM_INT);
               
               $insert1_stmt->execute();
               
               $_SESSION['rvSuccess'] = TRUE;
    
            header('location:../hr_reviewed');

             
 
                    }elseif($review == 'sup'){
                        
                        
                         $stat = 1;
                 
    
           $update_query = "UPDATE leave_request  SET supervisor_office=:stat WHERE leaveId = :rid";

              $insert1_stmt = $conn->prepare($update_query);

             //    DATA BINDING
                  $insert1_stmt->bindValue(':rid',$leave, PDO::PARAM_INT);
            
               $insert1_stmt->bindValue(':stat',$stat ,PDO::PARAM_INT);
               
               $insert1_stmt->execute();
               
               $_SESSION['rvSuccess'] = TRUE;
    
            header('location:../s_reviewed');

             
             }elseif($review == 'app'){
                 
                 
                 
                     $stat = 1;
                      $sta = 1;
                 
    
           $update_query = "UPDATE leave_request  SET leave_officer=:stat, approve_status=:sta WHERE leaveId = :rid";

              $insert1_stmt = $conn->prepare($update_query);

             //    DATA BINDING
                  $insert1_stmt->bindValue(':rid',$leave, PDO::PARAM_INT);
                   $insert1_stmt->bindValue(':sta',$sta, PDO::PARAM_INT);
            
               $insert1_stmt->bindValue(':stat',$stat ,PDO::PARAM_INT);
               
               $insert1_stmt->execute();
               
               
               $_SESSION['rvSuccess'] = TRUE;
    
            header('location:../approved_leaves');

             }
                    
               
                  
}
        }
        catch(PDOException $e){
            $returnData = msg(0,500,'fail',$e->getMessage());
        }
    


echo json_encode($returnData);