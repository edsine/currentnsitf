<?php 
session_start();

$conn = new mysqli('localhost', 'root', '', 'ebsdb');

    
          
            $cert = $_GET['cert'];
           
   
            $dd = 1;
            
             $query2 = "UPDATE transactions SET approve_status=? where transactionId =? ";
        $stmt = $conn->prepare($query2);
        $stmt->bind_param('ss', $dd,  $cert );
        $result = $stmt->execute();
        
           $_SESSION['payment'] = TRUE;
        
            header("location:../view_payments");
            