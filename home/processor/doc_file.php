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


$path = $_SESSION['path'];

$selectedPath = $_POST['spath'];

if(empty($selectedPath)){

if (!file_exists('../../DOCUMENTS/'.$path)) {
    mkdir('../../DOCUMENTS/'.$path, 0777, true);
}



$targetDir = "../../DOCUMENTS/$path/";

}else{
    $targetDir = $selectedPath;
    
    
    
}

$fileName = basename($_FILES["m_file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);


                    $fileSize = filesize($_FILES["m_file"]["tmp_name"])." bytes "; 
           
                  $depratment = $_POST['dpart'] ;
                $staffId =    $_POST['staffId'] ;
                  $doc_name =   $_POST['doc_name'] ;
                 $doc_desc = $_POST['doc_desc'] ;
               
                    
                
        try{
            
            
             $check_phone = "SELECT c_email FROM employer_tb WHERE c_email=:email";
            $check_email_stmt = $conn->prepare($check_phone);
            $check_email_stmt->bindValue(':email', $cemail,PDO::PARAM_STR);
            $check_email_stmt->execute();

            if($check_email_stmt->rowCount()){
              $_SESSION['errors'] = "Employer with the following email address already exist";
                    header("location:../register");
            
           } else{
            
              
            
           $allowTypes = array('jpg','png','jpeg','pdf');
          if(in_array($fileType, $allowTypes)){
      
        if(move_uploaded_file($_FILES["m_file"]["tmp_name"], $targetFilePath)){
 

                 $pin = rand(100000,999999);
                  
                  $map = "RC".$pin;
                
                $insert_query = "INSERT INTO `document_manager`(`department`, `staffId`, `document_name`, `document_desc`,doc_size, path, doc_file )VALUES(:department,
                :staffId,:document_name, :document_desc , :doc_size, :path, :doc_file)";

                $insert_stmt = $conn->prepare($insert_query);

                // DATA BINDING
             
                $insert_stmt->bindValue(':department',  $depratment,PDO::PARAM_INT);
               $insert_stmt->bindValue(':staffId',$staffId,PDO::PARAM_STR);
               
               $insert_stmt->bindValue(':document_name', htmlspecialchars(strip_tags($doc_name)),PDO::PARAM_STR);
                $insert_stmt->bindValue(':document_desc', $doc_desc,PDO::PARAM_STR);
                 $insert_stmt->bindValue(':doc_size', $fileSize,PDO::PARAM_STR);
                 $insert_stmt->bindValue(':path', $targetFilePath,PDO::PARAM_STR);
                 
                  $insert_stmt->bindValue(':doc_file', $fileName,PDO::PARAM_STR);
                 
                
              
                 
                 
               $result = $insert_stmt->execute();
                $employer = $conn->lastInsertId();
                $file = 'CAC';
               
               
                
                if($result){
                 
                
                  
                     
                     
                     
                     
                 
    
            header('location:../md_home');
                    
               }


        }
        
    
}
}
        }
        catch(PDOException $e){
            $returnData = msg(0,500,'fail',$e->getMessage());
        }
    


echo json_encode($returnData);