<?php
session_start();


//$username = "";
//$email = "";
$errors = [];
//require_once 'sendEmails.php';
$conn = new mysqli('127.0.0.1', 'root', '', 'sanaa_db');
require_once 'manage.php';
 $query = new Manage();
 
// require("/home/navsang/public_html/(navsa)/PHPMailer_5.2.0/class.phpmailer.php");
//require("/home/navsang/public_html/(navsa)/PHPMailer_5.2.0/class.smtp.php");
//require("/home/navsang/public_html/(navsa)/PHPMailer_5.2.0/class.pop3.php");


   $query =new Manage();
  //$mail = new PHPMailer();


// Artisan reg
if (isset($_POST['join'])) {
    
    
    
   
    $active = $_POST['crm'];
    
 //    $pic = $_POST['pic'];
    
       $name = $_POST['name'];
    $email = $_POST['email'];
    
     $address = $_POST['address'];
     $phone= $_POST['phone'];
     
     $prof = $_POST['srv'];
     
    //  $p= $_POST['srv'];
     
    
    

    $password =  base64_encode($_POST['password']);

    // Check if email already exists
      $check = $query->getRows("SELECT * FROM artisan_tb WHERE email='$email' LIMIT 1");
    
    if ( $check) {
        $errors['email'] = "Email already exists";
    }

     if (count($errors) === 0) {



       $query = "INSERT INTO artisan_tb SET a_name=?, a_address=?, email=?, phone=?, password = ?,ass_status=?,profession_id=? ";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssssss', $name, $address,$email, $phone,$password,$active, $prof);
        $result = $stmt->execute();
       

       if ($result) {
           $user_id = $stmt->insert_id;
           // $stmt->close();
//$mail->IsSMTP();                                      // set mailer to use SMTP
//$mail->Host = "navsa.ng";  // specify main and backup server
//$mail->SMTPAuth = true;     // turn on SMTP authentication
//$mail->Username = "info@navsa.ng";  // SMTP username
//$mail->Password = "@navsa2020"; // SMTP password

//$mail->From = "info@navsa.ng";
//$mail->FromName = "navsa";
//$mail->AddAddress("josh@example.net", "Josh Adams");
//$mail->AddAddress("$email");                  // name is optional
//$mail->AddReplyTo("info@example.com", "Information");

//$mail->WordWrap = 50;                                  // set word wrap to 50 characters
//$mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
//$mail->IsHTML(true);                                  // set email format to HTML

//$mail->Subject = "Dear Member,";

//$mail->Body    = " 
//<center><h1 style='font-family:bauhaus 93; color:green'>Digizens</h1></center><hr style=' border: 8px solid green;
//  border-radius: 5px;'>
//      <p style='font-family:arial unicode MS; font-size:18px;'>Welcome to Digizens Collaborative Initiatives, a community of Digital Citizens committed to promoting inclusive, responsive and equitable cities in Nigeria.</p> 

//<p style='font-family:arial unicode MS; font-size:18px;'>You will be receiving newsletters and other updates on our regular programs and activities. </p>
//<p style='font-family:arial unicode MS; font-size:14px;'> Please visit <a href='https://www.digizens.ng/programs.php'>https://www.digizens.ng/programs.php</a> for more information on how to participate in any of our programs. You may also contact us by phone at <span style='color:green;'>+234 906 000 8772</span> or through email at <span style='color:green'>frontoffice@digizens.ng</span>
//</p>
//<p>Sincerely</p>
//<p>Executive Director</p>
//<hr style=' border:4px solid green;
 // border-radius: 5px;'>
//";
//$mail->AltBody = "navsa.ng";




//$query=$conn->query("insert into materials(category_id,title,material_desc,up_name, material_file)values('$cat_id','$mat_title','$desc','$up_name','$name')");
//if(!$mail->Send()){
//echo "essage Can not be sent";
//}
//else{
//header("location:../index.php?success=1");
//}

        
        

          //  $_SESSION['id'] = $user_id;
           
            $_SESSION['email'] = $email;
            $_SESSION['verified'] = false;
            $_SESSION['message'] = 'You are logged in!';
            $_SESSION['type'] = 'alert-success';
            header('location:account');

        } else {
            $_SESSION['error_msg'] = "Database error: Could not register user";
        }
    }
}
    
    
    
    if (isset($_POST['reg'])) {
    
    
    
   
    $type = $_POST['type'];
    
 //    $pic = $_POST['pic'];
     
     //  $name = $_POST['name'];
    $email = $_POST['email'];
     $password =  base64_encode($_POST['password']);
    
     
     //$address = $_POST['address'];
     //$phone= $_POST['phone'];
     
     
      if(!empty($_POST['srv'])) {

       $prof=$query->filter($_POST['srv']);
      // echo $gender;
           $prof = implode(',', $_POST['srv']);
       }
     
    // $prof = $_POST['srv'];
     
    //  $p= $_POST['srv'];
     
    
    

    $password =  base64_encode($_POST['password']);

    // Check if email already exists
      $check = $query->getRows("SELECT * FROM clients_tb WHERE c_email='$email' LIMIT 1");
    
    if ( $check) {
        $errors['email'] = "Email already exists";
    }

     if (count($errors) === 0) {
//$result = $query->insert("INSERT INTO clients_tb( category,c_email,c_password,services)values('$type', '$email', '$password','$prof')");

   $query1 = "INSERT INTO clients_tb SET category=?, c_email=?, c_password=?, services=? ";
        $stmt = $conn->prepare($query1);
        $stmt->bind_param('ssss',$type, $email,$password,$prof);
        $result = $stmt->execute();
       
        

//$query=$conn->query("insert into materials(category_id,title,material_desc,up_name, material_file)values('$cat_id','$mat_title','$desc','$up_name','$name')");

       

        if ($result) {
            $user_id = $stmt->insert_id;
           $stmt->close();
//$mail->IsSMTP();                                      // set mailer to use SMTP
//$mail->Host = "navsa.ng";  // specify main and backup server
//$mail->SMTPAuth = true;     // turn on SMTP authentication
//$mail->Username = "info@navsa.ng";  // SMTP username
//$mail->Password = "@navsa2020"; // SMTP password

//$mail->From = "info@navsa.ng";
//$mail->FromName = "navsa";
//$mail->AddAddress("josh@example.net", "Josh Adams");
//$mail->AddAddress("$email");                  // name is optional
//$mail->AddReplyTo("info@example.com", "Information");

//$mail->WordWrap = 50;                                  // set word wrap to 50 characters
//$mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
//$mail->IsHTML(true);                                  // set email format to HTML

//$mail->Subject = "Dear Member,";

//$mail->Body    = " 
//<center><h1 style='font-family:bauhaus 93; color:green'>Digizens</h1></center><hr style=' border: 8px solid green;
//  border-radius: 5px;'>
//      <p style='font-family:arial unicode MS; font-size:18px;'>Welcome to Digizens Collaborative Initiatives, a community of Digital Citizens committed to promoting inclusive, responsive and equitable cities in Nigeria.</p> 

//<p style='font-family:arial unicode MS; font-size:18px;'>You will be receiving newsletters and other updates on our regular programs and activities. </p>
//<p style='font-family:arial unicode MS; font-size:14px;'> Please visit <a href='https://www.digizens.ng/programs.php'>https://www.digizens.ng/programs.php</a> for more information on how to participate in any of our programs. You may also contact us by phone at <span style='color:green;'>+234 906 000 8772</span> or through email at <span style='color:green'>frontoffice@digizens.ng</span>
//</p>
//<p>Sincerely</p>
//<p>Executive Director</p>
//<hr style=' border:4px solid green;
 // border-radius: 5px;'>
//";
//$mail->AltBody = "navsa.ng";




//$query=$conn->query("insert into materials(category_id,title,material_desc,up_name, material_file)values('$cat_id','$mat_title','$desc','$up_name','$name')");
//if(!$mail->Send()){
//echo "essage Can not be sent";
//}
//else{
//header("location:../index.php?success=1");
//}

        
        

          //  $_SESSION['id'] = $user_id;
           
            $_SESSION['email'] = $email;
            $_SESSION['verified'] = false;
            $_SESSION['message'] = 'You are logged in!';
            $_SESSION['type'] = 'alert-success';
            header('location:dashboard');

        } else {
            $_SESSION['error_msg'] = "Database error: Could not register user";
        }
    }
}



// LOGIN

//User Login
if(isset($_POST['login-btn'])){
           if (empty($_POST['email'])) {
        $errors['email'] = 'Username or email required';
              }
        if (empty($_POST['password'])) {
        $errors['password'] = 'Password required';
         }
              
        $email = $_POST['email'];
        $pass = $_POST['password'];
                 
        if (!empty($email) and !empty($pass)){
            
            
            
               $row = $query->getArtisan($email);

    if ( base64_encode($pass) ==$row['password']) {
            //    $_SESSION['id'] = $row['farmer_id'];
            //    $_SESSION['username'] = $row['full_name'];
            //    $_SESSION['email'] = $row['f_email'];
               // $_SESSION['verified'] = $row['verified'];
              //  $_SESSION['message'] = 'You are logged in!';
             ///   $_SESSION['type'] = 'alert-success';
                if($row['verified'] != 1){
                    header('location: ../account');  
                } else {
                  header('location:v_account/');  
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

if (isset($_POST['change'])) {
   
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password required';
    }
    if (isset($_POST['password']) && $_POST['password'] !== $_POST['cpassword']) {
        $errors['cpassword'] = 'The two passwords do not match';
    }

   
   // $binary = "11111001";
      $email = $_SESSION['email'];
  
    $password =  base64_encode($_POST['password']); //encrypt password

    // Check if email already exists
 
    if (count($errors) === 0) {
        $query = "UPDATE farmers_data SET password=? WHERE f_email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss',  $email, $password);
        $result = $stmt->execute();

        if ($result) {
           
            header('location: ../resetConfirm');
        } else {
            $_SESSION['error_msg'] = "Database error: Could not register user";
        }
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
           if (empty($_POST['email'])) {
        $errors['email'] = 'Username or email required';
              }
        if (empty($_POST['password'])) {
        $errors['pass'] = 'Password required';
         }
              
        $email = $_POST['email'];
        $pass = $_POST['password'];
                 
        if (!empty($email) and !empty($pass)){
            
            
            
               $row = $query->getArtisan($email);

    if ( base64_encode($pass) ==$row['password']) {
                $_SESSION['id'] = $row['farmer_id'];
                $_SESSION['username'] = $row['full_name'];
                $_SESSION['email'] = $row['f_email'];
                $_SESSION['verified'] = $row['verified'];
                $_SESSION['message'] = 'You are logged in!';
                $_SESSION['type'] = 'alert-success';
                if($row['verified'] != 1){
                    header('location: ../account');  
                } else {
                  header('location:v_account/');  
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

if (isset($_POST['change'])) {
   
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password required';
    }
    if (isset($_POST['password']) && $_POST['password'] !== $_POST['cpassword']) {
        $errors['cpassword'] = 'The two passwords do not match';
    }

   
   // $binary = "11111001";
      $email = $_SESSION['email'];
  
    $password =  base64_encode($_POST['password']); //encrypt password

    // Check if email already exists
 
    if (count($errors) === 0) {
        $query = "UPDATE farmers_data SET password=? WHERE f_email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss',  $email, $password);
        $result = $stmt->execute();

        if ($result) {
           
            header('location: ../resetConfirm');
        } else {
            $_SESSION['error_msg'] = "Database error: Could not register user";
        }
    }
}



if(isset($_POST['login'])){
           if (empty($_POST['mail'])) {
        $errors['mail'] = ' email required';
              }
        if (empty($_POST['pass11'])) {
        $errors['pass2'] = 'Password required';
         }
              
        $email = $_POST['mail'];
        $pass = $_POST['pass11'];
                 
        if (!empty($email) and !empty($pass)){
            
            
            
               $row = $query->getClients($email);

    if (base64_encode($pass)== $row['c_password']) {
           //     $_SESSION['id'] = $row['farmer_id'];
              //  $_SESSION['username'] = $row['full_name'];
                //$_SESSION['email'] = $row['f_email'];
               // $_SESSION['verified'] = $row['verified'];
               // $_SESSION['message'] = 'You are logged in!';
               // $_SESSION['type'] = 'alert-success';
                if($row['verified'] != 1){
                    header('location: ../account');  
                } else {
                  header('location:v_account/');  
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
    
?>



