<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


require __DIR__.'/classes/Database.php';
//require __DIR__.'/classes/JwtHandler.php';

$db_connection = new Database();
$conn = $db_connection->dbConnection();

if(isset($_GET['id'])){
    //IF HAS ID PARAMETER
    $artisan = filter_var($_GET['id'], FILTER_VALIDATE_INT);
}



    
        try{
            
            $fetch_user_by_email = "SELECT * FROM `clients_tb` WHERE `artisan_id`=:email";
            $query_stmt = $conn->prepare($fetch_user_by_email);
            $query_stmt->bindValue(':email', $artisan,PDO::PARAM_STR);
            $query_stmt->execute();

            // IF THE USER IS FOUNDED BY EMAIL
            if($query_stmt->rowCount()):
                $row = $query_stmt->fetch(PDO::FETCH_ASSOC);
              
                  // $jwt = new JwtHandler();
                  
                    $id =  $row['artisan_id'];
                      $art =  $row['surname'];
                      if($row['verified_status'] ==='1'){
                       $stat = '1';
                      }else{
                        $stat = '0';
                      }
                    $returnData = [
                        'success' => 1,
                        'message' => 'You have successfully logged in.',
                        'token' => $token,
                        'user'=>  $id,
                          'artisan'=>  $art,
                           'vstatus'=>   $stat
                    ];

                // IF INVALID PASSWORD
               
            

            // IF THE USER IS NOT FOUNDED BY EMAIL THEN SHOW THE FOLLOWING ERROR
            else:
                echo json_encode(['message'=>'user not found','status'=>201]);
            endif;
        }
        catch(PDOException $e){
            $returnData = msg(0,500,$e->getMessage());
        }



echo json_encode($returnData);