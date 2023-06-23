<?php
    $merchantId = "2547916";
    $apiKey = "1946";
    $serviceTypeId = "4430731";
	$rrr = '320796266420';//$_REQUEST['rrr'];
	//$amount = $_REQUEST['amount'];
    //$orderId = $_REQUEST['orderId'];//round(microtime(true) * 1000);
	
$apiHash = hash('sha512', $rrr . $apiKey . $merchantId);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://remitademo.net/remita/exapp/api/v1/send/api/echannelsvc/'.$merchantId.'/'.$rrr.'/'.$apiHash.'/status.reg',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: remitaConsumerKey='.$merchantId.',remitaConsumerToken='.$apiHash.''
  ),
));

$response = curl_exec($curl);
$error = curl_error($curl);

curl_close($curl);
echo $response;


$data = json_decode( $response);

$amount = $data->amount;


$status = $data->status;
    if($status === "00"){
   $pstatus = 1;
 $update = $query->updateRow("update transactions set payment_reference=?, payment_status=? where staffId = ?", ["$reference","$pstatus", "$rrr"]);
 
}else{
     $pstatus = 0;
     $update = $query->updateRow("update transactions set payment_reference=?, payment_status=? where staffId = ?", ["$reference","$pstatus", "$rrr"]);
}