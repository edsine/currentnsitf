<?php 
session_start();

require_once '../../classes/manage.php';
$query = new Manage();



require("PHPMailer_5.2.0/class.phpmailer.php");
require("PHPMailer_5.2.0/class.smtp.php");
require("PHPMailer_5.2.0/class.pop3.php");
 
  $mail = new PHPMailer();
  
  
  
            $cert = $_GET['id'];
            
    
     
      $update = $query->delete("delete from  staff_tb where staffId = ?", ["$cert"]);
   
    
             $_SESSION['delete'] = TRUE;
            header("location:../user_roles");
            
            
            