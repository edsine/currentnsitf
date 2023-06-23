<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
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
            
            $fetch_user_by_email = "SELECT a.*, d.*, e.* FROM `artisan_tb`as a, artisan_service as d, const_services as e  WHERE a.artisan_id = d.artisan_id and d.service_id =e.service_id and a.artisan_id=:email";
            $query_stmt = $conn->prepare($fetch_user_by_email);
            $query_stmt->bindValue(':email', $artisan,PDO::PARAM_STR);
            $query_stmt->execute();

            // IF THE USER IS FOUNDED BY EMAIL
            if($query_stmt->rowCount()):
                $row = $query_stmt->fetch(PDO::FETCH_ASSOC);
                  /*
                     $regdate =  $row['registerdate'];
                         $expDate =  $row['expirydate'];
                       
                 //  $expir = '2021/12/30';
                    $expires_at = new DateTime($expDate);
                    $today      = new DateTime('now');
                    
                    if($expires_at < $today){
                       $expDate =  "EXPIRED";
                       $sub =  'EXPIRED';
                      
                       $stat=2;
                       
              $update1_query = "UPDATE artisan_tb  SET subs_status=:stat WHERE artisan_id = :rid";

                $insert1_stmt = $conn->prepare($update1_query);

                // DATA BINDING
                  $insert1_stmt->bindValue(':rid',$artisan, PDO::PARAM_INT);
            
                $insert1_stmt->bindValue(':stat',$stat ,PDO::PARAM_STR);
                

                $insert1_stmt->execute();
         
                    
                    }else
                    {
                       $expDate =  $row['expirydate'];
                        $sub =  $row['plan'];
                    }

                
                  
                         if($row['expirydate']==='0000/00/00'){
                            $sub =   $row['plan'];
                             $expDate =  "Pending (Not Paid)";
                         }
                             
                          */
              
                  // $jwt = new JwtHandler();
                  
                         $id =  $row['artisan_id'];
                         $phone =  $row['phone'];
                         $name =  $row['surname'];
                         $service =  $row['service_name'];
                         //$price =  $row['price'];
                          $local =  $row['local_gvt'];
                          
                           $passport =  $row['passport'];
                        
                         $regdate =  $row['registerdate'];
                
                         $sanaa =  $row['sanaa_id'];
                          $skill =  $row['service_id'];
                         $returnData = [
                         'success' => 1,
                         'message' => 'You have successfully logged in.',
                         'name' => $name,
                         'user' => $id,
                         'subscription' => $sub,
                        
                         'regDate' =>$regdate,
                      
                         'phone'=>$phone,
                         'sanaa'=>$sanaa ,
                         'service'=>$service ,
                          'local'=>$local ,
                            'skill'=>$skill ,
                            'passport'=> $passport
                         
                          ];

            
            else:
                echo json_encode(['message'=>'user not found','status'=>201]);
            endif;
        }
        catch(PDOException $e){
            $returnData = msg(0,500,$e->getMessage());
        }



echo json_encode($returnData);