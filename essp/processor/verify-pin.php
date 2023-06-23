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
elseif(!isset($data->pin) 
    || !isset($data->token)
    || empty(trim($data->pin))
    || empty(trim($data->token))
    ):

    $fields = ['fields' => ['pin','token']];
    $returnData = msg(0,422,'Please Fill in all Required Fields!',$fields);

// IF THERE ARE NO EMPTY FIELDS THEN-
else:
    $pin = trim($data->pin);
    $token = trim($data->token);

    // CHECKING THE EMAIL FORMAT (IF INVALID FORMAT)
   
    // IF PASSWORD IS LESS THAN 8 THE SHOW THE ERROR
      if(strlen($pin) < 4):
        $returnData = msg(0,422,'Your pin must be at least 6 characters long!');

    // THE USER IS ABLE TO PERFORM THE LOGIN ACTION
    else:
        try{
                                             $curl = curl_init();
                                $data = array ( "api_key" => "TL0TP7GwJxtiaOCDIDyTwaSXxqEo8nKNLuXmFwZ185UCu2CLr4Nsx0tVYsM6mc",
                                             "pin_id" => $token,
                                             "pin" => $pin,
                                            );
                                
                                $post_data = json_encode($data);
                                
                                curl_setopt_array($curl, array(
                                 CURLOPT_URL => "https://api.ng.termii.com/api/sms/otp/verify",
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
                               // echo $response;
                                
                                  $result = json_decode($response);
                            
                                $veri = $result->verified;
                              
                             if($veri===true){
                                            
                                $returnData = [
                                    'success' => 1,
                                    'message' => 'Verified sucessfully.',
                                   
                                ];

                           
                           }else{
                               
                                 $returnData = [
                                    'success' => 0,
                                    'message' => 'You enterd an invalid pin.',
                                    'token' => $token,
                                  
                                ];

                               
                               
                           }
            
                  
                // IF INVALID PASSWORD
               

            // IF THE USER IS NOT FOUNDED BY EMAIL THEN SHOW THE FOLLOWING ERROR
           
        }
        catch(PDOException $e){
            $returnData = msg(0,500,$e->getMessage());
        }

    endif;

endif;

echo json_encode($returnData);