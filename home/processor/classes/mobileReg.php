<?php
session_start();

$errors = [];
//require_once 'sendEmails.php';
$conn = new mysqli('192.3.204.226', 'navsang', ')7hGTT22z0r:Oc', 'navsang_db');
require_once '../../(navsa)/classes/manage.php';
 $query = new Manage();

// Udate User Data
if (isset($_POST['reg'])) {
    if (empty($_POST['snames'])) {
        $errors['sname'] = 'Surname is required';
    }
    
     
    if (empty($_POST['fname'])) {
        $errors['fname'] = 'First Name is required';
    }
    if (empty($_POST['phone'])) {
        $errors['phone'] = 'Phone Number is required';
    }
     
     if (empty($_POST['dob'])) {
        $errors['dob'] = 'Date of Birth is required';
    }
    
     if (empty($_POST['gender'])) {
        $errors['gender'] = 'Gender is required';
    }
     
    
    
    
     if (empty($_POST['zone'])) {
        $errors['zone'] = 'Geo-political Zone is required';
    }
     if (empty($_POST['state'])) {
        $errors['state'] = 'State is required';
    }
    
     if (empty($_POST['address'])) {
        $errors['address'] = 'Address is required';
    }
    
     if (empty($_POST['local'])) {
        $errors['local'] = 'Local Govt is required';
    }
    
     if (empty($_POST['city'])) {
        $errors['city'] = 'City is required';
    }
    
    
    
     if (empty($_POST['nin'])) {
        $nin = "NULL";
    } else {
         $nin =$_POST['nin'];
    }
    $password = htmlspecialchars($_POST['phone']);
    $password = base64_encode($_POST['phone']);
       $surname = htmlspecialchars($_POST['snames']) ;
        $fname = htmlspecialchars($_POST['fname']) ;
       
          $order = htmlspecialchars($_POST['onames']) ;
             $phone = htmlspecialchars($_POST['phone']) ;
                $dob = $_POST['dob'];
                 $city = htmlspecialchars($_POST['city']) ;
                  $email = htmlspecialchars($_POST['email']) ;
                
                      //$id = $_POST['user'];
                        $highestQ = htmlspecialchars($_POST['highestQ']) ;
                          $fname = htmlspecialchars($_POST['fname']) ;
                         
                         $zone = $_POST['zone'];
                         $state = $_POST['state'];
                         $address = htmlspecialchars($_POST['address']) ;
                         $gender = $_POST['gender'];
                           $local = $_POST['local'];
                           $pend = 1;
                           $token = bin2hex(random_bytes(50));
                        //  $vcode = mt_rand(0,100,1000,20);
                          $vcode = substr(str_shuffle("0123456789"), 0, 4);
                          
                          $nitda =1;
                          $verified=1;
                          $confirm= 1;
                          
                          $editCode = rand(1000,9999); 
                          
    
      $farmID = $query->getToken(12);
      
          if (empty( $file_name =$_FILES['pic']['name'])) {
        $errors['pic'] = 'Passport is rquired';
    }
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
        
    $check = $query->getRows("SELECT * FROM farmers_data WHERE f_email='$email' LIMIT 1");
    
    if ( $check) {
        $errors['email'] = "Email already exists";
    }
    
   
  if (count($errors) === 0) {
        move_uploaded_file($file_tmp,"../../(navsa)/passport_files/".$file_name);
      
      $query = "INSERT INTO farmers_data SET farmerId=?, f_surname =?, first_name=?, f_oderNames=?,  f_phone=?, f_email=?, gender=?, f_dob=?,password=?, auth_token=?,v_code=?, verified=?, f_passport=?,qualification=?,geo_zone=?,state=?,local_govt=?,city=?,nitda_farmer=?,info_reg=?, editCode=?,f_address=?";
  
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssssssssssssssssssssss',$farmID,$surname,$fname,$order,$phone,$email,$gender,$dob,$password,$token,$vcode,$verified,$file_name,$highestQ,$zone,$state,$local,$city,$nitda,$confirm,$editCode, $address);
        $result = $stmt->execute();

        if ($result) {
            $user_id = $stmt->insert_id;
            $stmt->close();

            // TO DO: send verification email to user
            // sendVerificationEmail($email, $token);

                $_SESSION['edit'] = $editCode;
          //  $_SESSION['username'] = $username;
          //  $_SESSION['email'] = $email;
          //  $_SESSION['verified'] = false;
           // $_SESSION['message'] = 'You are logged in!';
           // $_SESSION['type'] = 'alert-success';
            header('location:../../(navsa)/successful-reg/final.php');
        } else {
            $_SESSION['error_msg'] = "Database error: Could not register user";
        }
    }
}


