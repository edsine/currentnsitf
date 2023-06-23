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
               $phone= $_POST['phone'];
           
                 $stat =1;

             
 function  setNumber($number){
    $first = $number[0];
$leng = strlen($number);
if($leng==11 and $first==='0'){
   $val = substr($number, 1);
   $ad = '234';
   $final = $ad.$val;
  return $final;
} elseif($leng==10) {
     $ad = '234';
   $final = $ad.$number;
    return $final;
} else {
    return "Please enter a valid number";
}
    
}


        try{

         
                $update_query = "UPDATE c_artisan  SET approve_status=:stat WHERE cArt_id = :rid";

                $insert_stmt = $conn->prepare($update_query);

                // DATA BINDING
                  $insert_stmt->bindValue(':rid',$artisan, PDO::PARAM_INT);
            
                $insert_stmt->bindValue(':stat',$stat ,PDO::PARAM_STR);
                

                $done=$insert_stmt->execute();
               if($done){
                   
                   $sms_numner = setNumber($phone);
                 
                       $curl = curl_init();
                            $data = array("to"=>$sms_numner, "from" => "N-Alert", 
                            "sms" => "ArtisanPro: Your submitted files are successfully verified ", "type" => "plain", "channel" => "dnd", "api_key" => "TL0TP7GwJxtiaOCDIDyTwaSXxqEo8nKNLuXmFwZ185UCu2CLr4Nsx0tVYsM6mc" );
                    
                            $post_data = json_encode($data);
                            
                            curl_setopt_array($curl, array(
                            CURLOPT_URL => 'https://api.ng.termii.com/api/sms/send',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                             CURLOPT_POSTFIELDS => $post_data,
                            CURLOPT_HTTPHEADER => array(
                              'Content-Type: application/json'
                            ),
                            ));

                                    $response = curl_exec($curl);
                                    curl_close($curl);
                                    echo $response;

          

               // $returnData = msg(1,201,$user,'You have successfully registered.');
                   
        $returnData = msg(1,201,$user,'You have successfully registered.');
             header('location:../admin');
               }
        }
        catch(PDOException $e){
            $returnData = msg(0,500,'fail',$e->getMessage());
        }
    


echo json_encode($returnData);