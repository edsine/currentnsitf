<?php
session_start();
$username = "";
$email = "";
$errors = [];
require_once 'sendEmails.php';
$conn = new mysqli('127.0.0.1', 'root', '', 'navsang_db');
require_once '../classes/manage.php';
 $query = new Manage();

// SIGN UP USER
if (isset($_POST['signup-btn'])) {
   
    if (empty($_POST['email'])) {
        $errors['email'] = 'Email required';
    }
    
     
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password required';
    }
    
      if (isset($_POST['password']) && $_POST['password'] !== $_POST['cpassword']) {
        $errors['cpassword'] = 'passwords do not match';
    }
   
    $ip =  $_SERVER['REMOTE_ADDR'];
    $iip = inet_ntop($ip);
    $email = $_POST['email'];
    // $cat = $_POST['cat'];
    
    
    
    
    $binary = "11111001";
   $token = bin2hex(random_bytes(50));// generate unique token
    $password =  base64_encode($_POST['password']); //encrypt password

    // Check if email already exists
      $check = $query->getRows("SELECT * FROM farmers_data WHERE f_email='$email' LIMIT 1");
    
    if ( $check) {
        $errors['email'] = "Email already exists";
    }

         if (count($errors) === 0) {
        $result = $query->insert("INSERT INTO farmers_data( f_email, auth_token,password, ip_address)values('$email', '$token', '$password','$ip')");
       

        if ($result) {
            //$user_id = $stmt->insert_id;
           // $stmt->close();

            // TO DO: send verification email to user
        //sendVerificationEmail($email, $token);
                       
        

          //  $_SESSION['id'] = $user_id;
           
            $_SESSION['f_email'] = $email;
            $_SESSION['verified'] = false;
            $_SESSION['message'] = 'You are logged in!';
            $_SESSION['type'] = 'alert-success';
            header('location: ../account');
}
        } else {
            $_SESSION['error_msg'] = "Database error: Could not register user";
        }
    }



// LOGIN
if (isset($_POST['login-n'])) {
    if (empty($_POST['username'])) {
        $errors['username'] = 'Username or email required';
    }
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password required';
    }
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (count($errors) === 0) {
        $query = "SELECT * FROM farmers_data WHERE username=? OR email=? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $username, $password);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) { // if password matches
                $stmt->close();
                  // $_SESSION['phone'] = $user['f_phone'];
                $_SESSION['id'] = $user['farmer_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['verified'] = $user['verified'];
                $_SESSION['message'] = 'You are logged in!';
                $_SESSION['type'] = 'alert-success';
                header('location: test.php');
                exit(0);
            } else { // if password does not match
                $errors['login_fail'] = "Wrong username / password";
            }
        } else {
            $_SESSION['message'] = "Database error. Login failed!";
            $_SESSION['type'] = "alert-danger";
        }
    }
}
//User Login
if(isset($_POST['login-btn'])){
           if (empty($_POST['mail'])) {
        $errors['mail'] = 'Username or email required';
              }
        if (empty($_POST['pass'])) {
        $errors['pass'] = 'Password required';
         }
              
        $email = $_POST['mail'];
        $pass = $_POST['pass'];
                 
        if (!empty($email) and !empty($pass)){
            
            
            
               $row = $query->getFarmers($email);

    if ( base64_encode($pass) == $row['password']) {
                $_SESSION['id'] = $row['farmer_id'];
                $_SESSION['username'] = $row['full_name'];
                $_SESSION['email'] = $row['f_email'];
                $_SESSION['verified'] = $row['verified'];
                $_SESSION['message'] = 'You are logged in!';
                $_SESSION['type'] = 'alert-success';
                if($row['verified'] != 1){
                    header('location: ../account');  
                } else {
                  header('location: ../v_account');  
                  exit(0);
                }
               
                

       
    
        
        
        
        } else { // if password does not match
                $errors['login_fail'] = "Wrong username / password";
            }
       
     } else {
            $_SESSION['message'] = "Database error. Login failed!";
            $_SESSION['type'] = "alert-danger";
        }


    }  
    
    
    //forget pass
    
    if (isset($_POST['passReset'])) {
   
    $email = $_POST['emailR'];
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
         $errors['emailR'] = 'Email address is not valid';
        
    }
    
    if(empty($email)){
          $errors['emailR'] = '';
    }
    
    if (count($errors) === 0) {
        $query = "SELECT * FROM farmers_data WHERE f_email=? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s',$email);

        if ($stmt->execute()) {
           $result = $stmt->get_result();
           $user = $result->fetch_assoc();
           
                $remail =$user['f_email'];
                $rtoken = $user['auth_token'];
               //  echo $remail;
                $_SESSION['email'] = $user['f_email'];
                        $mail->IsSMTP();                                      // set mailer to use SMTP
                        $mail->Host = "navsa.ng";  // specify main and backup server
                        $mail->SMTPAuth = true;     // turn on SMTP authentication
                        $mail->Username = "info@navsa.ng";  // SMTP username
                        $mail->Password = "@navsa2019"; // SMTP password
                        
                        $mail->From = "info@navsa.ng";
                        $mail->FromName = "NAVSA";
                        //$mail->AddAddress("josh@example.net", "Josh Adams"); 
                        $mail->AddAddress("$email");                  // name is optional
                        //$mail->AddReplyTo("info@example.com", "Information");
                        
                        $mail->WordWrap = 50;                                  // set word wrap to 50 characters
                        //$mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
                        //$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
                        $mail->IsHTML(true);                                  // set email format to HTML
                        
                        $mail->Subject = "Dear User,";
                        
                        $mail->Body    = " 
                        <center><h2 style='font-family:aeriel; color:green'>NAVSA</h2></center>
                             <center> <p style='font-family:aeriel; font-size:25px;'>PASSWORD RESET</p> </center>
                        
                      
                      <center>  <p style='font-family:arial unicode MS; font-size:14px;'>Welcome to NAVSA password reset. Please click on the link below to reset your password:.
                        
                        </p></center>
                        <center> <a href=\"navsa.ng/resetPass.php?token=$rtoken\">Verify Email!</a></center>
                          <br>
                         <center><span> or </span></center>
                         <br>
                       <center>  copy this and paste in your browser <span>https://navsa.ng/resetPass.php?token=$rtoken</span></center>
                        
                       <center> <p>navsa.ng</p></center>
                        <center>  <p>No. 28, Port Harcourt Crescent, Off Gimbiya Street,<br> P.M.B 564, Area 11 Garki, Abuja, Nigeria.</p></center>
                      
                        ";
                        $mail->AltBody = "navsa.ng";
                        
                         if(!$mail->Send()){
echo "essage Can not be sent";
}else{
        
          header('location:../passwordRecovery');
                exit(0);
                
}
                        
                
             
          
        } else {
            $_SESSION['message'] = "Database error. Login failed!";
            $_SESSION['type'] = "alert-danger";
        }
    }
}

//reset password vall

if (isset($_POST[''])) {
   
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password required';
    }
    if (isset($_POST['password']) && $_POST['password'] !== $_POST['passwordConf']) {
        $errors['passwordConf'] = 'The two passwords do not match';
    }

   
   // $binary = "11111001";
      $email = $_SESSION['email'];
   $token = bin2hex(random_bytes(50));// generate unique token
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); //encrypt password

    // Check if email already exists
 
    if (count($errors) === 0) {
        $query = "UPDATE farmers_data SET password=? WHERE email = '$email'   ";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssss', $username, $email, $token, $password);
        $result = $stmt->execute();

        if ($result) {
           
            header('location: ../v_account');
        } else {
            $_SESSION['error_msg'] = "Database error: Could not register user";
        }
    }
}
?>
