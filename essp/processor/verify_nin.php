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
             $artisan = $_POST['artisan'];
   
                 $nin = $_POST['nin'];

             $tat = 1;
             
        try{

         
                $update_query = "UPDATE artisan_tb  SET nin=:nin, nin_status=:stat  WHERE artisan_id = :rid";

                $insert_stmt = $conn->prepare($update_query);

                // DATA BINDING
                  $insert_stmt->bindValue(':rid', $artisan, PDO::PARAM_INT);
                    $insert_stmt->bindValue(':stat', $tat, PDO::PARAM_INT);
            
                $insert_stmt->bindValue(':nin',$nin ,PDO::PARAM_STR);
                

                $insert_stmt->execute();
               
              $returnData = msg(1,201,$user,'NIN verified.');

               // $returnData = msg(1,201,$user,'You have successfully registered.');
                   
    
             header('location:../artisans-area/nin_success');
        }
        catch(PDOException $e){
            $returnData = msg(0,500,'fail',$e->getMessage());
        }
    


echo json_encode($returnData);