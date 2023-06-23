<?php
include 'RemitaRRRGeneratorAndStatusService.php';
include 'Request/GenerateRRRRequest.php';
include 'Request/RRRStatusRequest.php';
include 'Request/CustomField.php';

function initCredentials()
{
    // SDK Credentials
     $merchantId = "1988717878";
    $apiKey = "145692";
    $serviceTypeId = "529722061";

    $amount = $_POST['amount'];//"100";
    
    $orderId = round(microtime(true) * 1000);

    // Initialize SDK
    $credentials = new Credentials();
    $credentials->url = ApplicationUrl::$liveUrl;
    $credentials->merchantId = $merchantId;
    $credentials->serviceTypeId = $serviceTypeId;
    $credentials->apiKey = $apiKey;
    $credentials->amount = $amount;
    $credentials->orderId = $orderId;

    return $credentials;
}

class TestRRRGeneratorAndStatus
{

    function test()
    {
        $credentials = initCredentials();
        $orderId = round(microtime(true) * 1000);

        //echo "// Generate RRR ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++";
        //echo "\n";
        $generateRRRRequest = new GenerateRRRRequest();
        $generateRRRRequest->serviceTypeId = $credentials->serviceTypeId;//"4430731";
        $generateRRRRequest->amount = $_POST['amount'];//"100";
        $generateRRRRequest->orderId = $_POST['orderId'];//"Regular Payment";
        $generateRRRRequest->payerName = $_POST['payerName'];//"Michelle Alozie";
        $generateRRRRequest->payerEmail = $_POST['payerEmail'];//"alozie@systemspecs.com.ng";
        $generateRRRRequest->payerPhone = $_POST['payerPhone'];//"09062067384";
        $generateRRRRequest->description = $_POST['description'];//"payment for Donation 3";

		$customField1 = new CustomField();
        $customField1->name = "Invoice Number";
        $customField1->value = $_POST['invoiceNumber'];
        $customField1->type = "ALL";

       $customField2 = new CustomField();
       $customField2->name = "ECS Order ID";
       $customField2->value = $_POST['invoiceNumber'];
       $customField2->type = "ALL";

        $generateRRRRequest->customField = array(
            $customField1,
            $customField2
        );

        $generateRRRResponse = RemitaRRRGeneratorAndStatusService::generateRRR($generateRRRRequest, $credentials);
        echo json_encode($generateRRRResponse);

        //echo "\n";
        //echo "\n";
        //echo "// RRR Status ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++";
        //echo "\n";

        //$rrrStatusRequest = new RRRStatusRequest();
        //$rrrStatusRequest->rrr = "240008240803";
        //$rrrStatusResponse = RemitaRRRGeneratorAndStatusService::rrrStatus($rrrStatusRequest, $credentials);
       // echo "\n";
       // echo "rrrStatusResponse: ", json_encode($rrrStatusResponse);
    }
	
	
}

$testRITs = new TestRRRGeneratorAndStatus();
$testRITs->test();
?>

