<?php 
session_start();
if(!isset($_SESSION['logging'])){
    header("location:../");
}



$rrr = $_GET['rrr'];
$type = $_GET['type'];


if($type ==1 ){
    $amount = 20000;
    
    
}elseif($type ==2 ){
    $amount = 50000;
}elseif($type ==3 ){
     $amount = 20000;
}else{
    $amount = $_SESSION['pecs'];
}


 $conn = new mysqli('178.159.5.249', 'nsitfmai_ebs2', 'ebs@nsitf', 'nsitfmai_essp');
 
 
 
 
 
 
             $query = "SELECT transactionId,invoice_number FROM transactions ORDER BY transactionId DESC";
            $result = mysqli_query($conn,$query);
            $row = mysqli_fetch_array($result);
            $lastInvoice = $row['invoice_number'];
            
    

                  if(empty($lastInvoice))
                    {
                    $lastInvoice = "NSITF-0000001";
                    }
                    else
                    {
                    $idd = str_replace("NSITF-", "", $lastInvoice);
                    $id = str_pad($idd + 1, 7, 0, STR_PAD_LEFT);
                    $lastInvoice = 'NSITF-'.$id;
                    }



       $employer = $_SESSION['employerId'] ;
           $paymentType = 1 ;
          // $amount = 20000;
           $status = 2;
           $time = date("Y/m/d");
           
           $duration = date('d-m-Y', strtotime('+1 year'));
           
           $ciemail = "nmibrahim19@gmail.com";
                
                 //$password = $query->validateString($_POST['pass']);
                 
                    $password1 = rand(10000000,99999999);
                  $password = password_hash($password1, PASSWORD_BCRYPT);
                  
                 
                  $pin = rand(100000,999999);
                  $Hashpin =  base64_encode($pin);
              
                    
 
          
 
 
 
        $query1 = "INSERT INTO transactions SET employerId=?, payment_type = ?, invoice_rrr=?, invoice_number=?, invoice_duration=?, invoice_generatedAt=?, payment_status=?, amount=?, payment_time=? ";
        $stmt = $conn->prepare($query1);
        $stmt->bind_param('sssssssss', $employer, $type, $rrr, $lastInvoice, $duration, $time, $status, $amount, $time );
        $result = $stmt->execute();
 

     // echo  $lastInvoice;
      
          $_SESSION['pay_type'] = $type;
      $_SESSION['rrr'] = $rrr;
       $_SESSION['ramount'] = $amount;
       $_SESSION['rinvoice'] =  $lastInvoice ;
  
    header("location:pay_invoice");
            