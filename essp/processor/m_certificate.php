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


$targetDir = "../application_letters/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);









  $employer = $_SESSION['employerId'] ;
  
  $branch = $_POST['branch'] ;
  $amount= 20000;
      


           
            
                       try{
            
            
            
              
            
           $allowTypes = array('jpg','png','jpeg','pdf');
          if(in_array($fileType, $allowTypes)){
      
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
 

           
                $insert_query = "INSERT INTO certificate_request(employer_id, `payment_fee`, `branch_id`,`app_letter`)VALUES(:employer_id,
                :payment_fee,:branch_id, :app_letter)";

                $insert_stmt = $conn->prepare($insert_query);

                // DATA BINDING
                
               
                $insert_stmt->bindValue(':employer_id',  $employer,PDO::PARAM_INT);
               $insert_stmt->bindValue(':payment_fee', $amount,PDO::PARAM_STR);
               
             
                $insert_stmt->bindValue(':branch_id',$branch ,PDO::PARAM_STR);
                
                  $insert_stmt->bindValue(':app_letter',$fileName ,PDO::PARAM_STR);
               
               $result = $insert_stmt->execute();
                $employer = $conn->lastInsertId();
            
               
               
                
                if($result){
                 
                
                
              
                  
                  
                  
                  
                 
                     
                     
                     
                     
                     
                      header("location:../account/certificate_request");
               }


        }
        
    

}
        }
        catch(PDOException $e){
            $returnData = msg(0,500,'fail',$e->getMessage());
        }
    


echo json_encode($returnData);