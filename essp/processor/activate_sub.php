<?php
session_start();

$errors = [];
//require_once 'sendEmails.php';
 //$conn = new mysqli('23.94.16.6', 'sanaang', 'Le6o5EB7@]xu1O', 'sanaang_db');
require_once '../classes/manage.php';
 $query = new Manage();
 

  
  
  
   $plan = $_POST['plan'];


//$artisan = $_SESSION['artisan'] ;
//echo $artisan;

 $getSubs = $query->getRow("select * from subs_details where subs_id = $plan");
 
 $planName =  $getSubs['plan'];
 $price  = $getSubs['price'];
 
 $_SESSION['plan']=$plan;

 
    
 if($plan === '1'){




$date = "Pending";//date("Y/m/d");
$expdate  = "Pending";//date('Y/m/d', strtotime('+1 month'));
 
  
       
                  $pin = rand(100000,999999);
                  
                  $map = "#".$pin;
                
               // $subtype = 3;
      
              $_SESSION['invoice'] = $map;    
  
        
            $_SESSION['regDate'] = $date;
             $_SESSION['expDate'] = $expdate;
              $_SESSION['invoice'] =  $map;
               $_SESSION['subType'] = $plan;
          
          
               
          
            header('location:../logJwt/artisan_reg');

       
        
    
}elseif($plan==='2'){
    
   // $artisan = $_POST['artisan'];
$date = "Pending";//date("Y/m/d");
$expdate  = "Pending";//date('Y/m/d', strtotime('+1 month'));
 //$email =  $_SESSION['at_email'];
  
       
                  $pin = rand(100000,999999);
                  
                  $map = "#".$pin;
                
                $subtype = 3;
      
              $_SESSION['invoice'] = $map;    
   $_SESSION['regDate'] = $date;
             $_SESSION['expDate'] = $expdate;
              $_SESSION['invoice'] =  $map;
               $_SESSION['subType'] = $plan;
          
          
            header('location:../logJwt/artisan_reg');

       
       
        
    
    
}elseif($plan ==='3'){
    
  
$date = "Pending";//date("Y/m/d");
$expdate  = "Pending";//date('Y/m/d', strtotime('+1 month'));
 $email =  $_SESSION['at_email'];
  
       
                  $pin = rand(100000,999999);
                  
                  $map = "#".$pin;
                
                $subtype = 3;
      
            $_SESSION['regDate'] = $date;
             $_SESSION['expDate'] = $expdate;
              $_SESSION['invoice'] =  $map;
               $_SESSION['subType'] = $plan;
          
          
            header('location:../logJwt/artisan_reg');

       
}elseif($plan ==='4'){
    

$date = "Pending";//date("Y/m/d");
$expdate  = "Pending";//date('Y/m/d', strtotime('+1 month'));
 $email =  $_SESSION['at_email'];
  
       
                  $pin = rand(100000,999999);
                  
                  $map = "#".$pin;
                
                $subtype = 3;
      
              $_SESSION['invoice'] = $map;    
  
     


 $_SESSION['regDate'] = $date;
             $_SESSION['expDate'] = $expdate;
              $_SESSION['invoice'] =  $map;
               $_SESSION['subType'] = $plan;
          
          
            header('location:../logJwt/artisan_reg');

       
        
    
}elseif($plan ==='5'){
   
$date = date("Y/m/d");
$expdate  = date('Y/m/d', strtotime('+1 month'));
 $email =  $_SESSION['at_email'];
       
                  $pin = rand(100000,999999);
                  
                  $map = "#".$pin;
                
                $subtype = 3;
      
              $_SESSION['invoice'] = $map;    
  
  
         $_SESSION['regDate'] = $date;
             $_SESSION['expDate'] = $expdate;
              $_SESSION['invoice'] =  $map;
               $_SESSION['subType'] = $plan;
          
          
            header('location:../logJwt/artisan_reg');

       

}else{
     header('location:index');
    
}


