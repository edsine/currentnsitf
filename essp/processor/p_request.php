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
             
             
            $service = $_SESSION['service'];
            $address =$_SESSION['address'];
            $client = $_SESSION['client'];
            $job = 1;
            $progress = 2;
             $pro_status = 1;
             
             
        try{

                 $pin = rand(100000,999999);
                  
                  $map = "SANA'A".$pin;
                  
         
                $insert_query = "INSERT INTO `request`(client_id, request_address, skill_id, request_type, provider_id, progress_status,provider_status) VALUES(:user,:address,:skill, :type,:provider,:status,:pstatus)";

                $insert_stmt = $conn->prepare($insert_query);

                // DATA BINDING
                  $insert_stmt->bindValue(':user',$client,PDO::PARAM_STR);
                $insert_stmt->bindValue(':address',htmlspecialchars(strip_tags( $address)),PDO::PARAM_STR);
                $insert_stmt->bindValue(':skill',  $service ,PDO::PARAM_STR);
                $insert_stmt->bindValue(':type',  $job ,PDO::PARAM_STR);
                 $insert_stmt->bindValue(':provider',$artisan ,PDO::PARAM_STR);
    
                $insert_stmt->bindValue(':status',$progress,PDO::PARAM_STR );
                   $insert_stmt->bindValue(':pstatus',$pro_status ,PDO::PARAM_STR);

                $done =  $insert_stmt->execute();
               //  $user = $conn->lastInsertId();
                $_SESSION['artisan'] = $artisan;

                $returnData = msg(1,201,$user,'You have successfully registered.');

               // $returnData = msg(1,201,$user,'You have successfully registered.');
                   if($done){
                       $duty = 1;
                       $update_query = "UPDATE artisan_tb  SET on_duty=:duty WHERE artisan_id = :rid";

                $insert_stmt = $conn->prepare($update_query);

                // DATA BINDING
                  $insert_stmt->bindValue(':rid',$artisan, PDO::PARAM_INT);
            
                $insert_stmt->bindValue(':duty',$duty ,PDO::PARAM_STR);
                

                $insert_stmt->execute();
               
                   }
    
             header('location:../requested2');
        }
        catch(PDOException $e){
            $returnData = msg(0,500,'fail',$e->getMessage());
        }
    


echo json_encode($returnData);