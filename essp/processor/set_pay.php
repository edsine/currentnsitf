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
              $artisan = $_GET['artisan'];
             $artisan = base64_decode($artisan);
             
             
                 $request_id = $_SESSION['reqP'];
   
                 $amount = $_POST['amount'];

             
             
        try{

         
                $update_query = "UPDATE request  SET assigned_amount=:amount WHERE request_id = :rid";

                $insert_stmt = $conn->prepare($update_query);

                // DATA BINDING
                  $insert_stmt->bindValue(':rid',$request_id, PDO::PARAM_INT);
            
                $insert_stmt->bindValue(':amount',$amount ,PDO::PARAM_STR);
                

                $insert_stmt->execute();
               
              $returnData = msg(1,201,$user,'You have successfully registered.');

               // $returnData = msg(1,201,$user,'You have successfully registered.');
                   
    
            // header('location:../requested');
        }
        catch(PDOException $e){
            $returnData = msg(0,500,'fail',$e->getMessage());
        }
    


echo json_encode($returnData);