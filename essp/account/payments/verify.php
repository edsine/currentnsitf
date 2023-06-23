<?php
//check if request was made with the right data
if(!$_SERVER['REQUEST_METHOD'] == 'POST' || !isset($_POST['reference'])){  
  die("Transaction reference not found");
}
 $conn = new mysqli('192.3.204.194', 'artisan6_db', 'U@pFMVNzU6qrQt3', 'artisan6_db');
//set reference to a variable @ref
$reference = $_POST['reference'];

//The parameter after verify/ is the transaction reference to be verified
$url = 'https://api.paystack.co/transaction/verify/'.$reference;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt(
  $ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer sk_test_79e5bc9d96410cf04e1708cab779b0438c1180d7']
);

//send request
$request = curl_exec($ch);
//close connection
curl_close($ch);
//declare an array that will contain the result 
$result = array();


$company = $_SESSION['payment_name'] ;
$lastame = $_SESSION['payment_lname'];
$email = $_SESSION['payment_email'];
$employer = $_SESSION['employerId'];


if ($request) {
  $result = json_decode($request, true);
}
         
      
        
        
if (array_key_exists('data', $result) && array_key_exists('status', $result['data']) && ($result['data']['status'] === 'success')) {
  echo "success kio";
	//Perform necessary action
}else{
  echo "Transaction was unsuccessful";
}
