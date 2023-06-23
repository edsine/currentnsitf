<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

function msg($success,$status,$user,$pin,$message,$extra = []){
    return array_merge([
        'success' => $success,
        'status' => $status,
         'user' => $user,
         'pin' => $pin,
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

// INCLUDING DATABASE AND MAKING OBJECT
require __DIR__.'/classes/Database.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();

// GET DATA FORM REQUEST
$data = json_decode(file_get_contents("php://input"));
$returnData = [];

// IF REQUEST METHOD IS NOT POST
if($_SERVER["REQUEST_METHOD"] != "POST"):
    $returnData = msg(0,404,'Page Not Found!');

// CHECKING EMPTY FIELDS
elseif(!isset($data->name) 
    || !isset($data->phone) 

    || !isset($data->password)
    || empty(trim($data->name))
    || empty(trim($data->phone))
    || empty(trim($data->password))
    ):

    $fields = ['fields' => ['name','phone','password']];
    $returnData = msg(0,422,00,00,'Please Fill in all Required Fields!',$fields);

// IF THERE ARE NO EMPTY FIELDS THEN-
else:
    
    $name = trim($data->name);
    $email = trim($data->phone);
 
    $password = trim($data->password);

    
    if(strlen($password) < 8):
        $returnData = msg(0,422,00,00,'Your password must be at least 8 characters long!');

    elseif(strlen($name) < 3):
        $returnData = msg(0,422,00,00,'Your name must be at least 3 characters long!');

    else:
        try{
        $userType = 1;
          $pin = rand(100000,999999);
                   $sms_numner = setNumber($email);
                   // $num =  strval($sms_numner);
                  $map = "SANA'A".$pin;
               $check_phone = "SELECT `phone` FROM `clients_tb` WHERE `phone`=:phone";
            $check_email_stmt = $conn->prepare($check_phone);
            $check_email_stmt->bindValue(':phone', $email,PDO::PARAM_STR);
            $check_email_stmt->execute();

            if($check_email_stmt->rowCount()):
              // $_SESSION['errors'] = "Phone Number already exists";
                   
                $returnData = msg(0,422,'fail',00, 'This Phone Number is already in use!');
            
            else:
                
                
                  $insert_query = "INSERT INTO `clients_tb`(sanaa_id,surname, phone, user_type, password) VALUES(:sanaa,:name,:phone, :type,:password)";

                $insert_stmt = $conn->prepare($insert_query);
                
                
           
                // DATA BINDING
                 $insert_stmt->bindValue(':sanaa', $map,PDO::PARAM_STR);
                $insert_stmt->bindValue(':name', htmlspecialchars(strip_tags($name)),PDO::PARAM_STR);
                $insert_stmt->bindValue(':phone', $email,PDO::PARAM_STR);
                 $insert_stmt->bindValue(':type',$userType,PDO::PARAM_STR);
                $insert_stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT),PDO::PARAM_STR);

             $final =   $insert_stmt->execute();
                $user = $conn->lastInsertId();
             if($final){
                          /*
                            $message ="Your SANA'A phone number verificationn pin is";
                            $curl = curl_init();
                            $data = array( "api_key" => "TL0TP7GwJxtiaOCDIDyTwaSXxqEo8nKNLuXmFwZ185UCu2CLr4Nsx0tVYsM6mc",
                                         "message_type" => "NUMERIC",
                                         "to" =>$sms_numner ,
                                         "from" => "N-Alert",
                                         "channel" => "dnd",
                                         "pin_attempts" => 10,
                                         "pin_time_to_live" => 60,
                                         "pin_length" => 6,
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
                
              
              */
              

                $returnData = msg(1,200,$user,NULL,'You have successfully registered.');
                }
            endif;

        }
        catch(PDOException $e){
            $returnData = msg(0,500,$user,NULL,$e-$user>getMessage());
        }
    endif;
    
endif;

echo json_encode($returnData);