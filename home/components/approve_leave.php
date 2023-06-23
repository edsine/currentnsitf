<?php 
session_start();

$conn = new mysqli('178.159.5.249', 'ebs@nsitf', 'nsitfmai_ebs2', 'nsitfmai_essp');




            $cert = $_GET['cert'];
           
   
            $dd = 1;
            
             $query2 = "UPDATE leave_request SET approve_status=? where leaveId =? ";
        $stmt = $conn->prepare($query2);
        $stmt->bind_param('ss', $dd,  $cert );
        $result = $stmt->execute();
        
            header("location:../leave_rquest");
            