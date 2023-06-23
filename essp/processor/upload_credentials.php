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


$targetDir = "../credential_files/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);





                
                
                $service =   $_SESSION['service'] ;
                $artisan =  $_SESSION['artisan'];
                $requirement =  $_POST['recId'];
               
               
               
                   
         
                 
                 
                  
    
        try{
            
    // Allow certain file formats
    $allowTypes = array('pdf','php');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
             
               $insert_query = "INSERT INTO `upload_requirement`(`service_id`, `artisan_id`, `requirement_id`,`requirement_file`) VALUES(:service_id,:artisan_id,:rc_id,:rcfile)";
             
             

                $insert_stmt = $conn->prepare($insert_query);

                // DATA BINDING
                  $insert_stmt->bindValue(':service_id', $service,PDO::PARAM_INT);
                $insert_stmt->bindValue(':artisan_id',$artisan,PDO::PARAM_INT);
                $insert_stmt->bindValue(':rc_id', $requirement,PDO::PARAM_STR);
               $insert_stmt->bindValue(':rcfile', $fileName,PDO::PARAM_STR);
             
                
            
               $result = $insert_stmt->execute();
                $user = $conn->lastInsertId();
                
               
            if($result){
                  header('location:../account/home');
            }else{
                header('location:../account/files_upload?up='.$requirement);
            $_SESSION['errors'] = "Error uploading file try again. ";
            } 
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
          $_SESSION['fileerror'] = "Only pdf file allowed";
         
          header('location:../account/files_upload?up='.$requirement);
            $_SESSION['errors'] = "Invalid file type. Only pdf file allowed";
        //  $statusMsg = "File upload failed, please try again.";
    }



               
        //  

        }
        catch(PDOException $e){
            $returnData = msg(0,500,'fail',$e->getMessage());
        }
    


echo json_encode($returnData);