<?php
session_start();
  $_SESSION['subType'] = $plan;
function msg($success,$status,$user,$message,$extra = []){
    return array_merge([
        'success' => $success,
        'status' => $status,
         'user' => $user,
        'message' => $message
    ],$extra);
}



require __DIR__.'/classes/Database.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();




require("/home2/artisan6/public_html/demo/client/PHPMailer_5.2.0/class.phpmailer.php");
require("/home2/artisan6/public_html/demo/client/PHPMailer_5.2.0/class.smtp.php");
require("/home2/artisan6/public_html/demo/client/PHPMailer_5.2.0/class.pop3.php");


 //$query =new Manage();
  $mail = new PHPMailer();


  $emp = 3;
  echo $emp;
$check_phone = "SELECT * FROM employees WHERE employee_id=:employee";
            $check_email_stmt = $conn->prepare($check_phone);
            $check_email_stmt->bindValue(':employee', $emp,PDO::PARAM_STR);
          $employee =  $check_email_stmt->execute();
          
          
          
          $firsname =  $employee['employee_firstname'] ;
          
           $surname =  $employee['employee_surname'] ;
           $middlename =  $employee['employee_middlename'] ;
           
           
           
           echo $surname;
           
           
           
           
          