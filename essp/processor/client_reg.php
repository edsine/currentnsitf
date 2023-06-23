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

 
                  $name = trim($_POST['name']);
                 $phone= trim($_POST['phone']);
                 $password =   trim($_POST['password']);
                  $pin = rand(100000,999999);
                  $map = "SANA'A".$pin;
                  
                   $crypt_pin = password_hash($pin, PASSWORD_BCRYPT);
        try{

                 $pin = rand(100000,999999);
                  
                  $map = "SANA'A".$pin;
                  
                   $userType = 1;
                   
                   
                   
               $check_phone = "SELECT `phone` FROM `artisan_tb` WHERE `phone`=:phone";
            $check_email_stmt = $conn->prepare($check_phone);
            $check_email_stmt->bindValue(':phone', $phone,PDO::PARAM_STR);
            $check_email_stmt->execute();

            if($check_email_stmt->rowCount()){
              // $_SESSION['errors'] = "Phone Number already exists";
                    header("location:../clients-account");
            
           } else{
                $insert_query = "INSERT INTO `artisan_tb`(sanaa_id, surname, phone, user_type, password) VALUES(:sanaa,:name,:phone, :type,:password)";

                $insert_stmt = $conn->prepare($insert_query);

                // DATA BINDING
                  $insert_stmt->bindValue(':sanaa', $map,PDO::PARAM_STR);
                $insert_stmt->bindValue(':name', htmlspecialchars(strip_tags($name)),PDO::PARAM_STR);
                $insert_stmt->bindValue(':phone', $phone,PDO::PARAM_STR);
                 $insert_stmt->bindValue(':type',$userType,PDO::PARAM_STR);
                $insert_stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT),PDO::PARAM_STR);

                $insert_stmt->execute();
                 $user = $conn->lastInsertId();
                   $_SESSION['client'] = $user;

                $returnData = msg(1,201,$user,'You have successfully registered.');
                
                  // $returnData = msg(1,201,$user,'You have successfully registered.');
                   
    
             header('location:../make-request');


           }


             
        }
        catch(PDOException $e){
            $returnData = msg(0,500,'fail',$e->getMessage());
        }
    


echo json_encode($returnData);