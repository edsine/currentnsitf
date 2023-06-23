<?php
session_start();

$conn = new mysqli('178.159.5.249', 'ebs@nsitf', 'nsitfmai_ebs2', 'nsitfmai_essp');






       $certId  =  $_GET['cert'];

 
            $dd = 1;
            
             $query2 = "UPDATE certificate_request SET processing_status=? where request_id =? ";
        $stmt = $conn->prepare($query2);
        $stmt->bind_param('ss', $dd,  $certId );
        $result = $stmt->execute();
        
        if($result){
            
            
                  $_SESSION['cert_request'] = TRUE;
header("location:../pending_certificates");}