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



require __DIR__.'/../../classes/database.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();


              $officer =   $_POST['officer'] ;
                   $review =   $_POST['review'] ;
                  $dta = $_POST['claimId'] ;
               
                $comment = $_POST['comment'];
                
                $reviewTat = 1;
               
                
            
                
              
                
        try{
            
            
         
                
             $insert_query = "INSERT INTO `claims_review`(claimId,officerId,comment,review_status)VALUES(:claimId,:officerId,:comment,:review_status)";
             
             
                     $insert_stmt = $conn->prepare($insert_query);

             // DATA BINDING
             
               $insert_stmt->bindValue(':claimId',$dta,PDO::PARAM_INT);
               $insert_stmt->bindValue(':officerId',$officer,PDO::PARAM_INT);
               
               
             
               
               
               $insert_stmt->bindValue(':comment', $comment,PDO::PARAM_STR);
               
               
                 $insert_stmt->bindValue(':review_status',$reviewTat,PDO::PARAM_INT);
                 
                
              
               
                         
              
         
                 
                 
               $result = $insert_stmt->execute();
                $employer = $conn->lastInsertId();
                $file = 'CAC';
               
               
                
                if($result){
                    
                    
                    if($review == 'hd'){
                    $stat = 1;
                 
    
           $update_query = "UPDATE accident_claim  SET branchMd_status=:stat WHERE claimId = :rid";

              $insert1_stmt = $conn->prepare($update_query);

             //    DATA BINDING
                  $insert1_stmt->bindValue(':rid',$claim, PDO::PARAM_INT);
            
               $insert1_stmt->bindValue(':stat',$stat ,PDO::PARAM_INT);
               
               $insert1_stmt->execute();
               
               $_SESSION['hodSuccess'] = TRUE;
    
            header('location:../hclaim_reviewed');

             
 
                    }elseif($review == 'sp'){
                        
                        
                         $stat = 1;
                         
                         
                 
    
           $update_query = "UPDATE dta_request  SET supervisor_status=:stat WHERE dta_id = :rid";

              $insert1_stmt = $conn->prepare($update_query);

             //    DATA BINDING
                  $insert1_stmt->bindValue(':rid', $dta, PDO::PARAM_INT);
            
               $insert1_stmt->bindValue(':stat',$stat ,PDO::PARAM_INT);
               
               $insert1_stmt->execute();
               
               $_SESSION['dtaSuccess'] = TRUE;
    
            header('location:../dtas_reviewed');

             
             }elseif($review == 'ac'){
                 
                 
                 
                     $stat = 1;
                      $sta = 1;
                 
    
           $update_query = "UPDATE dta_request   SET account_status=:stat, approval_status=:sta WHERE dta_id = :rid";

              $insert1_stmt = $conn->prepare($update_query);

             //    DATA BINDING
                  $insert1_stmt->bindValue(':rid',$dta, PDO::PARAM_INT);
                   $insert1_stmt->bindValue(':sta',$sta, PDO::PARAM_INT);
            
               $insert1_stmt->bindValue(':stat',$stat ,PDO::PARAM_INT);
               
               $insert1_stmt->execute();
               
               
               $_SESSION['accSuccess'] = TRUE;
    
               header('location:../dtas_reviewed');

             }elseif($review == 'md'){
                 
                 
                  $stat = 1;
                 
    
           $update_query = "UPDATE dta_request  SET md_status=:stat WHERE dta_id = :rid";

              $insert1_stmt = $conn->prepare($update_query);

             //    DATA BINDING
                  $insert1_stmt->bindValue(':rid',$dta, PDO::PARAM_INT);
            
               $insert1_stmt->bindValue(':stat',$stat ,PDO::PARAM_INT);
               
               $insert1_stmt->execute();
               
               $_SESSION['dtahSuccess'] = TRUE;
    
            header('location:../dtas_reviewed');

             
                 
                 
                 
                 
                 
                 
             }
                    
               
                  
}
        }
        catch(PDOException $e){
            $returnData = msg(0,500,'fail',$e->getMessage());
        }
    


echo json_encode($returnData);