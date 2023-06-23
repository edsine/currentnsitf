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



            //     $nin =  $_POST['nin'];
                
                
                $fname =    $_POST['cname'] ;
                $phone =   $_POST['cphone'];
                $email =   $_POST['cemail'];
    
                $state =  $_POST['state'] ;
               
                   
            $password = $_POST['cpassword'];
                 
                 
                  
    
        try{

        

                 $pin = rand(100000,999999);
                  
                  $map = "SANA'A".$pin;
                  
                  $type = 2;
                $insert_query = "INSERT INTO `clients_data`(`fullname`, `off_email`,`off_phone`,`password`,`client_state`) VALUES(:name,:email,:phone,:pass,:state)";

                $insert_stmt = $conn->prepare($insert_query);

                // DATA BINDING
                  $insert_stmt->bindValue(':name', htmlspecialchars(strip_tags($fname)),PDO::PARAM_STR);
                $insert_stmt->bindValue(':phone', htmlspecialchars(strip_tags($phone)),PDO::PARAM_STR);
                $insert_stmt->bindValue(':email', $email,PDO::PARAM_STR);
        
               $insert_stmt->bindValue(':state', $state,PDO::PARAM_STR);
             
                $insert_stmt->bindValue(':pass', password_hash($password, PASSWORD_DEFAULT),PDO::PARAM_STR);
                
            
               $result = $insert_stmt->execute();
                $user = $conn->lastInsertId();
                
               
               
                
               // if($result){
                     
                    
              //       $insert_query = "INSERT INTO `artisan_service`(`artisan_id`,`service_id`, service_name) VALUES(:userId,:serve,:sname)";
//
             //   $insert_stmt = $conn->prepare($insert_query);

                // DATA BINDING
            //    $insert_stmt->bindValue(':userId', $user,PDO::PARAM_STR);
           //     $insert_stmt->bindValue(':serve',$item,PDO::PARAM_STR);
            //    $insert_stmt->bindValue(':sname', $sname,PDO::PARAM_STR);
          //    $insert_stmt->execute();
              //  $user = $conn->lastInsertId();
              
              
              
               
                    
            //    }


               // $returnData = msg(1,201,$user,'You have successfully registered.');
                 $_SESSION['name'] = $fname;
                  $_SESSION['pstate'] = $pstate;
                   $_SESSION['plocal'] = $plocal;
                  $_SESSION['address'] = $address;
                  $_SESSION['phone'] = $phone;
                   $_SESSION['state']=$state;
                    $_SESSION['service']=$service;
                   $_SESSION['artisan']=$user;
                     $_SESSION['email']=$email;
                 
    
            header('location:../sdash');

        }
        catch(PDOException $e){
            $returnData = msg(0,500,'fail',$e->getMessage());
        }
    


echo json_encode($returnData);