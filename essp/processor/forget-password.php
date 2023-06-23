<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

function msg($success,$status,$message,$extra = []){
    return array_merge([
        'success' => $success,
        'status' => $status,
        'message' => $message
    ],$extra);
}

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

require __DIR__.'/classes/Database.php';
//require __DIR__.'/classes/JwtHandler.php';

$db_connection = new Database();
$conn = $db_connection->dbConnection();

$data = json_decode(file_get_contents("php://input"));
$returnData = [];

// IF REQUEST METHOD IS NOT EQUAL TO POST
if($_SERVER["REQUEST_METHOD"] != "POST"):
    $returnData = msg(0,404,'Page Not Found!');

// CHECKING EMPTY FIELDS
elseif(!isset($data->phone) 
    
    || empty(trim($data->phone))
    
    ):

    $fields = ['fields' => ['email']];
    $returnData = msg(0,422,'Please Fill in all Required Fields!',$fields);

// IF THERE ARE NO EMPTY FIELDS THEN-
else:
    $email = trim($data->phone);
    
     $sms_numner = setNumber($email);
   // $password = trim($data->password);

    // CHECKING THE EMAIL FORMAT (IF INVALID FORMAT)
   
    // IF PASSWORD IS LESS THAN 8 THE SHOW THE ERROR
      if(strlen($email) < 11):
        $returnData = msg(0,422,'Your phone number must be at least 11 characters long!');

    // THE USER IS ABLE TO PERFORM THE LOGIN ACTION
    else:
        try{
            
            
             $check_phone = "SELECT artisan_id,`phone` FROM `artisan_tb` WHERE `phone`=:phone";
            $check_email_stmt = $conn->prepare($check_phone);
            $check_email_stmt->bindValue(':phone', $email,PDO::PARAM_STR);
            $check_email_stmt->execute();

            if($check_email_stmt->rowCount()){
             
               $row =  $check_email_stmt->fetch(PDO::FETCH_ASSOC);
                
                
                  $id = $row['artisan_id'];
                  $message ="Your SANA'A password recovery pin is";
                            $curl = curl_init();
                            $data = array( "api_key" => "TL0TP7GwJxtiaOCDIDyTwaSXxqEo8nKNLuXmFwZ185UCu2CLr4Nsx0tVYsM6mc",
                                         "message_type" => "NUMERIC",
                                         "to" =>$sms_numner ,
                                         "from" => "N-Alert",
                                         "channel" => "dnd",
                                         "pin_attempts" => 10,
                                         "pin_time_to_live" => 60,
                                         "pin_length" => 4,
                                         "pin_placeholder" => "< 1234 >",
                                         "message_text" => $message."< 1234 >",
                                         "pin_type" => "NUMERIC");
                            
                            $post_data = json_encode($data);
                            
                            curl_setopt_array($curl, array(
                             CURLOPT_URL => "https://api.ng.termii.com/api/sms/otp/send",
                             CURLOPT_RETURNTRANSFER => true,
                             CURLOPT_ENCODING => "",
                             CURLOPT_MAXREDIRS => 10,
                             CURLOPT_TIMEOUT => 0,
                             CURLOPT_FOLLOWLOCATION => true,
                             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                             CURLOPT_CUSTOMREQUEST => "POST",
                             CURLOPT_POSTFIELDS => $post_data,
                             CURLOPT_HTTPHEADER => array(
                               "Content-Type: application/json"
                             ),
                            ));
                            
                            $response = curl_exec($curl);
                            
                            curl_close($curl);
                            
                            $result = json_decode($response);
                            
                              $pin = $result->pinId;
                
              
              
              

                  // $jwt = new JwtHandler();
                  
                  //  $id =  $row['f_id'];
                    $phone =  $row['phone'];
                    $returnData = [
                        'success' => 1,
                        'message' => 'You have successfully logged in.',
                        'token' => $token,
                        'user'=>  $id,
                        'vpin'=> $pin,
                        'phone'=>$phone
                    ];

             
            
            }else{
            
             $returnData = msg(0,422,'Farmer registered already, Go back and login!');
        }}
        catch(PDOException $e){
            $returnData = msg(0,500,$e->getMessage());
        }

    endif;

endif;

echo json_encode($returnData);