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



             $date=   $_SESSION['regDate'] ;
              $expdate= $_SESSION['expDate'] ;
             $map  =   $_SESSION['invoice'] ;
             $subtype = $_SESSION['plan'];
          
          
           

       


        
                $artisan = $_SESSION['artisan'];
          
                $gendar =$_SESSION['gendar'];
                $address = $_SESSION['address'];
                $local =  $_SESSION['local'];
                $item=  $_SESSION['skills'];
                 $state=  $_SESSION['state'];
                  
    
        try{

                 $pin = rand(100000,999999);
                  
                  $map = "SANA'A".$pin;
                  
                  $type = 1;
                    $stat = 1;
                  
                  $update_query = "UPDATE artisan_tb   SET a_address=:address, gendar=:gendar,local_gvt=:local, state=:state, verified_status=:vrs WHERE artisan_id=:user";

                $insert_stmt = $conn->prepare($update_query);
                // DATA BINDING
                
                $insert_stmt->bindValue(':address', $address,PDO::PARAM_STR);
               $insert_stmt->bindValue(':gendar', $gendar,PDO::PARAM_STR);
     
                $insert_stmt->bindValue(':local', $local,PDO::PARAM_STR);
                 $insert_stmt->bindValue(':state', $state,PDO::PARAM_STR);
                  $insert_stmt->bindValue(':user', $artisan,PDO::PARAM_INT);
                         $insert_stmt->bindValue(':vrs', $stat,PDO::PARAM_INT);
         

               $result = $insert_stmt->execute();
                $user = $conn->lastInsertId();
                
                $_SESSION['artisan']=$user;
               
                
                if($result){
                     
                    
                     $insert_query = "INSERT INTO `artisan_service`(`artisan_id`,`service_id`) VALUES(:userId,:serve)";

                $insert_stmt = $conn->prepare($insert_query);

                // DATA BINDING
                $insert_stmt->bindValue(':userId', $artisan,PDO::PARAM_STR);
                $insert_stmt->bindValue(':serve',$item,PDO::PARAM_STR);
             
              $insert_stmt->execute();
              //  $user = $conn->lastInsertId();
              
              
              
                    
                     $insert = "INSERT INTO `subscriptions`(users_id, subs_type, invoice_number, registerdate, expirydate) VALUES(:user,:subs,:invoice,:regDate,:expDate)";

                $insert_stmt = $conn->prepare($insert);

                // DATA BINDING
                $insert_stmt->bindValue(':user', $artisan,PDO::PARAM_STR);
                $insert_stmt->bindValue(':subs',$subtype,PDO::PARAM_STR);
             
               $insert_stmt->bindValue(':invoice', $map,PDO::PARAM_STR);
                $insert_stmt->bindValue(':regDate',$date,PDO::PARAM_STR);
             
               $insert_stmt->bindValue(':expDate', $expdate,PDO::PARAM_STR);
              
             
              $insert_stmt->execute();
              //  $user = $conn->lastInsertId();
              
              
              
              
              
              
              
              
              
                
                    
                }


               // $returnData = msg(1,201,$user,'You have successfully registered.');

    
            header('location:../demo_invoice');

        }
        catch(PDOException $e){
            $returnData = msg(0,500,'fail',$e->getMessage());
        }
    


echo json_encode($returnData);