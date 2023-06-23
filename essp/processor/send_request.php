<?php
session_start();
require_once '../classes/manage.php';
 $query = new Manage();

  
                



  $employer = $_SESSION['employerId'] ;
  
  $branch = $_SESSION['ranch'] ;
  $amount= 20000;
      

    
      $result = $query->insert("INSERT INTO certificate_request( employer_id, payment_fee,  branch_id )values( '$employer','$amount','$branch ')"); 
     
 $_SESSION['desc'] = $code2;
   header("location:../account/certificate_request");
     

     
      
echo $desc;
//var_dump($getActiveBanks['data']['responseCode']);
var_dump();

            
          