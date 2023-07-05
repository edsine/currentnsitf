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



require __DIR__.'/../../classes/Database.php';

$db_connection = new Database();


$conn = $db_connection->dbConnection();



//require("/home2/artisan6/public_html/demo/client/PHPMailer_5.2.0/class.phpmailer.php");
//require("/home2/artisan6/public_html/demo/client/PHPMailer_5.2.0/class.smtp.php");
//require("/home2/artisan6/public_html/demo/client/PHPMailer_5.2.0/class.pop3.php");


 //$query =new Manage();
//  $mail = new PHPMailer();


            //     $nin =  $_POST['nin'];
                
                  $fileId= $_POST['fileId'] ;
                $fromId =    $_POST['fromId'] ;
                  $toId =   $_POST['toId'] ;
                 $comment = $_POST['comment'] ;
               
                
        try{
            
            
            
              
            
         
                $insert_query = "INSERT INTO shared_files( fileId, `from_Id`,to_Id,comments)VALUES(:fileId,:from_id,
                :to_Id,:comments)";

                $insert_stmt = $conn->prepare($insert_query);

                // DATA BINDING
                  $insert_stmt->bindValue(':fileId',$fileId,PDO::PARAM_INT);
                $insert_stmt->bindValue(':from_id',$fromId,PDO::PARAM_INT);
                $insert_stmt->bindValue(':to_Id',  $toId,PDO::PARAM_INT);
               $insert_stmt->bindValue(':comments', $comment,PDO::PARAM_STR);
               
              
               
                 
               $result = $insert_stmt->execute();
                $employer = $conn->lastInsertId();
          
               
               
                
                if($result){
                 
                
                  
                  
                
            header('location:../md_home');
                    
               }


        
        

        }
        catch(PDOException $e){
            $returnData = msg(0,500,'fail',$e->getMessage());
        }
    


echo json_encode($returnData);