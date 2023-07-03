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


$targetDir = "../../DOCUMENTS/inspection_data/";
$fileName = basename($_FILES["doc"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
$filesize = filesize($_FILES["doc"]);



            //     $nin =  $_POST['nin'];
                
                  
                      //$insId = $_POST['inspId'] ;
                $employerId =    $_POST['empId'] ;
                  $insEmp =   $_POST['insEmp'] ;
                 $ins_start = $_POST['ins_start'] ;
                $ins_end =   $_POST['ins_end'];
                $compliant =   $_POST['compliant'];
                
               $staff =  $_SESSION['staff'] ;
        
               $depart = 3;
               
               $stat =1;
                    
                    
                
        try{
            
            
           $allowTypes = array('jpg','png','jpeg','pdf');
          if(in_array($fileType, $allowTypes)){
      
        if(move_uploaded_file($_FILES["doc"]["tmp_name"], $targetFilePath)){
 
                
                $insert_query = "INSERT INTO `inspection_report`(inspectorId, `employerId`, `numberEmpIns`, `ins_start`, `ins_end`, `complient_status`, `report_doc` )VALUES(:inspectorId,
                :employerId,:numberEmpIns,:ins_start,:ins_end, :complient_status, :report_doc)";

                $insert_stmt = $conn->prepare($insert_query);

                // DATA BINDING
                
                
                  $insert_stmt->bindValue(':inspectorId',$staff,PDO::PARAM_STR);
                  $insert_stmt->bindValue(':employerId', $employerId,PDO::PARAM_STR);
                  
                      
                $insert_stmt->bindValue(':numberEmpIns', htmlspecialchars(strip_tags( $insEmp)),PDO::PARAM_STR);
                  
                
                $insert_stmt->bindValue(':ins_start', $ins_start ,PDO::PARAM_STR);
               $insert_stmt->bindValue(':ins_end',$ins_end,PDO::PARAM_STR);
               
              
                
               $insert_stmt->bindValue(':complient_status', htmlspecialchars(strip_tags($compliant)),PDO::PARAM_STR);
                $insert_stmt->bindValue(':report_doc', $fileName,PDO::PARAM_STR);
                
                 
                 
               $result = $insert_stmt->execute();
                $employer = $conn->lastInsertId();
                $file = 'CAC';
               
               
                
                if($result){
                 
                
                    $insert_query = "INSERT INTO `document_manager`(`department`, `staffId`, `document_name`) VALUES(:department,:staffId,:document_name)";
                     $insert_stmt = $conn->prepare($insert_query);

             // DATA BINDING
               $insert_stmt->bindValue(':department',$depart,PDO::PARAM_INT);
               $insert_stmt->bindValue(':staffId',$staff,PDO::PARAM_INT);
               
               $insert_stmt->bindValue(':document_name', $fileName,PDO::PARAM_STR);
               
                         
              
          $tr = $insert_stmt->execute();
           
           
             if($tr){
            $update_query = "UPDATE employer_tb  SET inspection_status=:stat WHERE employer_id = :rid";

                $insert1_stmt = $conn->prepare($update_query);

                // DATA BINDING
                  $insert1_stmt->bindValue(':rid',$employerId, PDO::PARAM_INT);
            
                $insert1_stmt->bindValue(':stat',$stat ,PDO::PARAM_INT);
                
                $insert1_stmt->execute();
             
 
              
                  $_SESSION['insSuccess'] = TRUE;
    
            header('location:../ins_pending');
             }
                    
               }


        }
        
    

}
        }
        catch(PDOException $e){
            $returnData = msg(0,500,'fail',$e->getMessage());
        }
    


echo json_encode($returnData);