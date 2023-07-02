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
$conn = $db_connection->data;

 $targetDir = "../../DOCUMENTS/REGISTRY/";
$fileName = basename($_FILES["file"]["name"]);

$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

                  
                  
                   $staff =    $_SESSION['staff'] ;
                $fname =    $_POST['fname'] ;
                  $femail =   $_POST['femail'] ;
                  $docName =    $_POST['doc_name'] ;
                // $doc_path = $_POST['doc_path'] ;
                  $comment = $_POST['comment'] ;
   
               
             //  echo $fileName;
               
               
               
               
                 
                    
                
        try{
            
             $allowTypes = array('jpg','png','jpeg','pdf');

          if(in_array($fileType, $allowTypes)){

      
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){

                
                 $insert_query = "INSERT INTO registry_doc(staffId, from_name, `from_email`, `document_name`, `doc_path`, comment )VALUES(:staffId,:from_name,:from_email,
                :document_name,:doc_path, :comment)";
                
                   $insert_stmt = $conn->prepare($insert_query);

                  $insert_stmt->bindValue(':staffId', $staff ,PDO::PARAM_INT);
                  $insert_stmt->bindValue(':from_name', $fname ,PDO::PARAM_STR);
                  
                $insert_stmt->bindValue(':from_email', htmlspecialchars(strip_tags($femail)),PDO::PARAM_STR);
                
                
                 $insert_stmt->bindValue(':document_name', htmlspecialchars(strip_tags($docName)),PDO::PARAM_STR);
                
                
                $insert_stmt->bindValue(':doc_path', htmlspecialchars(strip_tags(  $targetFilePath)),PDO::PARAM_STR);
                
                $insert_stmt->bindValue(':comment', htmlspecialchars(strip_tags( $comment)),PDO::PARAM_STR);
                
                
              
               $result = $insert_stmt->execute();
                $employer = $conn->lastInsertId();
               
               
                
                if($result){
                
                 
                    $_SESSION['rvSuccess']= TRUE;
    
            header('location:../process_doc');
                    
               } 


        
        
        }}


        }
        catch(PDOException $e){

            $returnData = msg(0,500,'fail',$e->getMessage());
        }
    


echo json_encode($returnData);