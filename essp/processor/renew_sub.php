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
             
              $user = $_SESSION['user'];
          

                  
    
        try{

                 $pin = rand(100000,999999);
                  
                //  $map = "SANA'A".$pin;
                  
                  $type = 2;
   
                    
                     
                     
                        $update1_query = "UPDATE subscriptions SET subs_type=:subs, invoice_number=:invoice, registerdate=:regDate,expirydate=:expDate WHERE users_id= :user";
                   $insert_stmt = $conn->prepare( $update1_query);

                // DATA BINDING
                $insert_stmt->bindValue(':user', $user,PDO::PARAM_STR);
                $insert_stmt->bindValue(':subs',$subtype,PDO::PARAM_STR);
             
               $insert_stmt->bindValue(':invoice', $pin,PDO::PARAM_STR);
                $insert_stmt->bindValue(':regDate',$date,PDO::PARAM_STR);
             
               $insert_stmt->bindValue(':expDate', $expdate,PDO::PARAM_STR);
              
             
              $insert_stmt->execute();
              //  $user = $conn->lastInsertId();
              
              
              
            $_SESSION['at_name'] = true;
    
            header('location:../minvoice');

        }
        catch(PDOException $e){
            $returnData = msg(0,500,'fail',$e->getMessage());
        }
    


echo json_encode($returnData);