<?php
session_start();

$errors = [];
//require_once 'sendEmails.php';
$conn = new mysqli('localhost', 'root', '', 'navsang_db');
require_once '../../(navsa)/classes/manage.php';
 $query = new Manage();
 require 'remita.php';
 
 $rem = new RemitaCon();

// Udate User Data
if (isset($_POST['reg'])) {
    if (empty($_POST['snames'])) {
        $errors['sname'] = 'Surname is required';
    }
   
     if (empty($_POST['dob'])) {
        $errors['dob'] = 'Date of Birth is required';
    }
    
     if (empty($_POST['gender'])) {
        $errors['gender'] = 'Gender is required';
    }
     
     if (empty($_POST['city'])) {
        $errors['city'] = 'City is required';
    }
    
     if (empty($_POST['nin'])) {
        $nin = "NULL";
    } else {
         $nin =$_POST['nin'];
    }
    
  
    
    $password = htmlspecialchars($_POST['pass']);
    $password =  base64_encode($_POST['pass']);
          $surname = htmlspecialchars($_POST['snames']) ;
          $order = htmlspecialchars($_POST['onames']) ;
          $phone = htmlspecialchars($_POST['phone']) ;
          $dob = $_POST['dob'];
          $city = htmlspecialchars($_POST['city']) ;
             if(!empty(($_POST['email']))){
             
                $email = htmlspecialchars($_POST['email']) ;
                    
             }
             
             $dob2 = date_format($dob, "Y/m/d H:i:s");
                      
          $highestQ = htmlspecialchars($_POST['highestQ']) ;
          $fname = htmlspecialchars($_POST['fname']) ;
                         
          $zone = $_POST['zone'];
          $state = $_POST['state'];
          $address = htmlspecialchars($_POST['address']) ;
          $gender = $_POST['gender'];
          $local = $_POST['local'];
          $pend = 1;
          $token = bin2hex(random_bytes(50));
          $vcode = substr(str_shuffle("0123456789"), 0, 4);
          $nitda =1;
          $verified=1;
          $confirm= 1;
          $farmID = substr(str_shuffle("0123456789"), 0, 9);
      
         
                $file_name =$_FILES['pic']['name'];
	        	$file_size =$_FILES['pic']['size'];
		        $file_tmp =$_FILES['pic']['tmp_name'];
	        	$file_type=$_FILES['pic']['type'];	
                $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');
                if(in_array($file_name, $valid_extensions)){   
                $errors['pic'] = 'The file extension is not valid';
                }
                if($file_size > 2097152)    {
                $errors['pic'] = 'Image is too large';
                }
        
  //remita integration
                 
                
        $url = 'https://remitademo.net/remita/exapp/api/v1/send/api/paymentsvc/remitawallet/open';
        $data = 
        ['requestId' => $nitda,
	'firstName' => $_POST['first_name'],
	'lastName' => $_POST['title'],
	'otherName' =>$_POST['institution'],
	'email'     => $_POST['age'],
	'phoneNumber' => $_POST['email'],
        'dateOfBirth' => $_POST['email'],
        'customerId' => $_POST['email'],
        'accountTypeId' => $_POST['email'],
        'gender' => $_POST['email'],
         
        ];
        
        $head = $rem->getHeader($requestId);
        
    
   
              if (count($errors) === 0) {
                  
              move_uploaded_file($file_tmp,"../../(navsa)/passport_files/".$file_name);
              $query = "INSERT INTO farmers_data SET farmerId=?, f_surname =?, first_name=?, f_oderNames=?,  f_phone=?, f_email=?, gender=?, f_dob=?,password=?, auth_token=?,v_code=?, verified=?, f_passport=?,qualification=?,geo_zone=?,state=?,local_govt=?,city=?,nitda_farmer=?,info_reg=?,f_address=?";
  
             $stmt = $conn->prepare($query);
             $stmt->bind_param('sssssssssssssssssssss',$farmID,$surname,$fname,$order,$phone,$email,$gender,$dob,$password,$token,$vcode,$verified,$file_name,$highestQ,$zone,$state,$local,$city,$nitda,$confirm,$address);
             $result = $stmt->execute();
                    
                  $result = $rem1->remPost($url, $head, $data);
             if ($result) {
            $user_id = $stmt->insert_id;
            $stmt->close();

            // TO DO: send verification email to user
            // sendVerificationEmail($email, $token);

          //  $_SESSION['id'] = $user_id;
          //  $_SESSION['username'] = $username;
          //  $_SESSION['email'] = $email;
          //  $_SESSION['verified'] = false;
           // $_SESSION['message'] = 'You are logged in!';
           // $_SESSION['type'] = 'alert-success';
            header('location:../../(navsa)/successful-reg');
        } else {
            $_SESSION['error_msg'] = "Database error: Could not register user";
        }
    }
}


