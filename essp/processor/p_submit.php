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

 
            $service = $_SESSION['service'];
            $address =$_SESSION['address'];
            $client = $_SESSION['client'];
            $local = $_SESSION['local_gvt'];
            $job = 2;
            $progress = 3;
             
             
        try{

                 $pin = rand(100000,999999);
                  
                  $map = "SANA'A".$pin;
                  
         
                $insert_query = "INSERT INTO `request`(client_id, request_address,local_gvt, skill_id, request_type, progress_status) VALUES(:user,:address,:local,:skill, :type,:status)";

                $insert_stmt = $conn->prepare($insert_query);

                // DATA BINDING
                  $insert_stmt->bindValue(':user',$client,PDO::PARAM_STR);
                $insert_stmt->bindValue(':address',htmlspecialchars(strip_tags( $address)),PDO::PARAM_STR);
                $insert_stmt->bindValue(':skill',  $service ,PDO::PARAM_STR);
                 $insert_stmt->bindValue(':local',$local  ,PDO::PARAM_STR);
                $insert_stmt->bindValue(':type',  $job ,PDO::PARAM_STR);
    
                $insert_stmt->bindValue(':status',$progress,PDO::PARAM_STR );

                $insert_stmt->execute();
               //  $user = $conn->lastInsertId();
                  // $_SESSION['client'] = $user;

                $returnData = msg(1,201,$user,'You have successfully registered.');

               // $returnData = msg(1,201,$user,'You have successfully registered.');
                   
    
              header('location:../client-area');
        }
        catch(PDOException $e){
            $returnData = msg(0,500,'fail',$e->getMessage());
        }
    


echo json_encode($returnData);