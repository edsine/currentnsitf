<?php
session_start();
 //require_once '';
 require_once 'manage.php';
   //require_once 'db.php';
   
    $query = new Manage();
$errors = [];
//require_once 'sendEmails.php';
//$conn = new mysqli('192.3.204.226', 'navsang', ')7hGTT22z0r:Oc', 'navsang_db');


// Udate User Data

//Profession
if (isset($_POST['info'])) {
   
    if (empty($_POST['q1'])) {
        $errors['q1'] = 'INFO: Full Name is required ';
    }
    
   
    
    if (empty($_POST['q2'])) {
        $errors['q2'] = 'INFO: Email Address is required ';
    }
    
    if (empty($_POST['q3'])) {
        $errors['q3'] = 'INFO:   Mobile Number is required ';
    }
    
    if (empty($_POST['q4'])) {
        $errors['q4'] = 'INFO:  Designation is required ';
    }
    
    if (empty($_POST['q5'])) {
        $errors['q5'] = 'INFO:  Oganisation name is required ';
    }
    
    
    
      $q1 = $query->validateString($_POST['q1']) ;
      $q2 = $query->validateString($_POST['q2']) ;
      $q3 = $query->validateString($_POST['q3']) ;
      $q4 = $query->validateString($_POST['q4']) ;
      $q5 = $query->validateString($_POST['q5']) ;
     
      
      
      // $q6 = $query->validateString($_POST['q6']);
     
       
           
    
   // if (isset($_POST['password']) && $_POST['password'] !== $_POST['passwordConf']) {
        //$errors['passwordConf'] = 'The two passwords do not match';
   // }

    //$username = htmlspecialchars($_POST['username']) ;
   // $ip =  $_SERVER['REMOTE_ADDR'];
  // $iip = inet_ntop($ip);
  //  $email = $_POST['email'];
   // $cat = $_POST['cat'];
    
    
    
    
   // $binary = "11111001";
   //$token = bin2hex(random_bytes(50));// generate unique token
    //$password = password_hash($_POST['password'], PASSWORD_DEFAULT); //encrypt password
 $check = $query->getRows("SELECT * FROM personal_info WHERE email='$q2' LIMIT 1");
    
    if ( $check) {
        $errors['email'] = "INFO: Email already exists";
    }
    // Check if email already exists
     
    if (count($errors) === 0) {
        $result = $query->insert("INSERT INTO personal_info( full_name, designation,email, number,organisation)values('$q1', '$q2', '$q3','$q4','$q5')");
       

        if ($result) {
           $getId = $query->getRow("select u_id from personal_info where designation = '$q2' ");
           

             $_SESSION['id'] =  $getId['u_id'];
           
           $_SESSION['f_email'] = $q2;
       //      $_SESSION['verified'] = false;
            $_SESSION['message'] = 'You are logged in!';
            $_SESSION['type'] = 'alert-success';
            header('location:main');
        } else {
            $_SESSION['error_msg'] = "Database error: Could not register user";
        }
    }
}


if (isset($_POST['policy'])) {
   
    if (empty($_POST['q1'])) {
        $errors['q1'] = 'INFO: question 1 is required ';
    }
       
    if (empty($_POST['q3'])) {
        $errors['q3'] = 'INFO:  question 3 is required ';
    }
    
    if (empty($_POST['q5'])) {
        $errors['q5'] = 'INFO:  question 5 irequired';
    }
    
    if (empty($_POST['q6'])) {
        $errors['q6'] = 'INFO:  question 6 irequired';
    }
    
     if (empty($_POST['q7'])) {
        $errors['q7'] = 'INFO:  question 7 irequired';
    }
    
    
    
      $q1 = $query->validateString($_POST['q1']) ;
     // $q2 = $query->validateString($_POST['q3']) ;
      $q3 = $query->validateString($_POST['q3']) ;
      $q5 = $query->validateString($_POST['q5']) ;
      $q6 = $query->validateString($_POST['q6']) ;
       $q7 = $query->validateString($_POST['q7']) ;
        $totalfiles = count($_FILES['file']['name']);
     
         $user = $_POST['user'];        
               
                
               
 
     
      
      
    if (count($errors) === 0) {
        $result = $query->insert("INSERT INTO policy_answers(user_id,q1,q3,q5,q6,q7)values('$user','$q1','$q3','$q5','$q6','$q7')");
       

        if ($result) {
         
             for($i=0;$i<$totalfiles;$i++){
 $filename = $_FILES['file']['name'][$i];
 
// Upload files and store in database
if(move_uploaded_file($_FILES["file"]["tmp_name"][$i],'../upload_files/'.$filename)){
		// Image db insert sql
		$query->insert("insert into files(user_id, uploaded_file)values('$user','$filename')");
		
	
 
     }}
         
   

            // $_SESSION['id'] =  $getId['u_id'];
           
          // $_SESSION['f_email'] = $q2;
       //      $_SESSION['verified'] = false;
            $_SESSION['message'] = 'You are logged in!';
            $_SESSION['type'] = 'alert-success';
            header('location:technology.php');
        } else {
            $_SESSION['error_msg'] = "Database error: Could not register user";
        }
    }
}

if (isset($_POST['tech'])) {
   
    if (empty($_POST['q1'])) {
        $errors['q1'] = 'Technology: question 1 is not answered ';
    }
    
   
    
   
    
    if (empty($_POST['q3'])) {
        $errors['q3'] = 'Technology: question 4 is not answered  ';
    }
    
   
    
    if (empty($_POST['q5'])) {
        $errors['q5'] = 'Technology: question 7 is not answered ';
    }
    
    
     $q1 = $query->validateString($_POST['q1']) ;
     if(!empty($_POST['q2'])) {

        $q6=$query->filter($_POST['q2']);
    //    echo $gender;
           
        }
      $q3 = $query->validateString($_POST['q3']) ;
        
       if(!empty($_POST['q4'])) {

        $q4=$query->filter($_POST['q4']);
    //    echo $gender;
           
        }
        
        
        
      
      $q5 = $query->validateString($_POST['q5']) ;
      
      

        $q7=$query->validateString($_POST['q7']);
    //    echo $gender;
           
       
       
      

        $q8=$query->validateString($_POST['q8']);
    //    echo $gender;
           
        
        
        

        $q9=$query->validateString($_POST['q9']);
    //    echo $gender;
           
        
        
       

        $q10=$query->validateString($_POST['q10']);
    //    echo $gender;
         
        
        
        

        $q11=$query->validateString($_POST['q11']);
    //    echo $gender;
           
        
        
        //$totalfiles = count($_FILES['file']['name']);
    
    
    if(!empty($_POST['q6'])) {

        $q6=$query->filter($_POST['q6']);
    //    echo $gender;
            $q6 = implode(',', $_POST['q6']);
        }
        
    if(!empty($_POST['q12'])) {

        $q12=$query->filter($_POST['q12']);
    //    echo $gender;
            $q12 = implode(',', $_POST['q12']);
        }
         
     
      if(!empty($_POST['q13'])) {

        $q13=$query->filter($_POST['q13']);
    //    echo $gender;
            $q13 = implode(',', $_POST['q13']);
        }
        
        
        if(!empty($_POST['q14'])) {

        $q14=$query->filter($_POST['q14']);
    //    echo $gender;
            $q14 = implode(',', $_POST['q14']);
        }
        
       
        if(!empty($_POST['q15'])) {

        $q15=$query->filter($_POST['q15']);
    //    echo $gender;
            $q15 = implode(',', $_POST['q15']);
        }
        
        
       if(!empty($_POST['q16'])) {

        $q16=$query->filter($_POST['q16']);
    //    echo $gender;
           
        }
      
    
     if(!empty($_POST['q17'])) {

        $q17=$query->filter($_POST['q17']);
    //    echo $gender;
            $q17 = implode(',', $_POST['q17']);
        }
        
        
        
       if(!empty($_POST['q18'])) {

        $q18=$query->filter($_POST['q18']);
    //    echo $gender;
            $q18 = implode(',', $_POST['q18']);
        }  
       
    
      
    $user = $_POST['user'];
    
    
    
    
   // $binary = "11111001";
   //$token = bin2hex(random_bytes(50));// generate unique token
    //$password = password_hash($_POST['password'], PASSWORD_DEFAULT); //encrypt password
 
    // Check if email already exists
     
    if (count($errors) === 0) {
        
        $result = $query->insert("INSERT INTO technology( `user_id`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `q10`, `q11`, `q12`, `q13`, `q14`, `q15`, `q16`, `q17`, q18)"
                ."values( '$user','$q1', '$q2', '$q3','$q4','$q5', '$q6', '$q7','$q8','$q9','$q10','$q11','$q12','$q13','$q14','$q15','$q16','$q17','$q18')");
       
    
        
        
        if ($result) {
         
            

             //$_SESSION['id'] = $user_id;
           
         //  $_SESSION['f_email'] = $q4;
       //      $_SESSION['verified'] = false;
            $_SESSION['message'] = 'You are logged in!';
            $_SESSION['type'] = 'alert-success';
            header('location:human.php');
        } else {
            $_SESSION['error_msg'] = "Database error: Could not register user";
        }
    }
}




if (isset($_POST['human'])) {
   
    
    
   
    $q1 = $query->validateString($_POST['q1']) ;
     $q2 = $query->validateString($_POST['q2']) ;
      $q3 = $query->validateString($_POST['q3']) ;
       $q4 = $query->validateString($_POST['q4']) ;
        $q5 = $query->validateString($_POST['q5']) ;
        
    
    
     $q6 = $query->validateString($_POST['q6']) ;
     
     
    
      
    $user = $_POST['user'];
    
    
    
    
   // $binary = "11111001";
   //$token = bin2hex(random_bytes(50));// generate unique token
    //$password = password_hash($_POST['password'], PASSWORD_DEFAULT); //encrypt password
 
    // Check if email already exists
     
    if (count($errors) === 0) {
        
       $result = $query->insert("INSERT INTO human_ans(user_id,q1,q2,q3,q4,q5,q6)values('$user','$q1', '$q2', '$q3', '$q4', '$q5','$q6')");
        
        
        if ($result) {
         
            

             //$_SESSION['id'] = $user_id;
           
         //  $_SESSION['f_email'] = $q4;
       //      $_SESSION['verified'] = false;
            $_SESSION['message'] = 'You are logged in!';
            $_SESSION['type'] = 'alert-success';
            header('location:human.php');
        } else {
            $_SESSION['error_msg'] = "Database error: Could not register user";
        }
    }
}


if (isset($_POST['organisation'])) {
   
    if (empty($_POST['q1'])) {
        $errors['q1'] = 'Technology: question 1 is not answered ';
    }
  
   
    
   
    
    if (empty($_POST['q2'])) {
        $errors['q2'] = 'Technology: question 4 is not answered  ';
    }
    
 
    
    if (empty($_POST['q3'])) {
        $errors['q3'] = 'Technology: question 7 is not answered ';
    }
   
    
     if (empty($_POST['q5'])) {
        $errors['q5'] = 'Technology: question 7 is not answered ';
    }
    
    
    
     if (empty($_POST['q7'])) {
        $errors['q7'] = 'Technology: question 7 is not answered ';
    }
    
   
     
     if (empty($_POST['q9'])) {
        $errors['q9'] = 'Technology: question 7 is not answered ';
    }
    
   
     
      if (empty($_POST['q10'])) {
        $errors['q10'] = 'Technology: question 7 is not answered ';
    }
    
     
    
    
     if(!empty($_POST['q11'])) {

        $q11=$query->filter($_POST['q11']);
    //    echo $gender;
            $q11 = implode(',', $_POST['q11']);
        }
        
        
         if (empty($_POST['q12'])) {
        $errors['q12'] = 'Technology: question 7 is not answered ';
    }
     
    
      
    $user = $_POST['user'];
    
      $q1 = $query->validateString($_POST['q1']) ;
         $q2 = $query->validateString($_POST['q2']) ;
          $q3 = $query->validateString($_POST['q3']) ;
    
    $q4 = $query->validateString($_POST['q4']) ;
    $q5 = $query->validateString($_POST['q5']) ;
    
    $q6 = $query->validateString($_POST['q6']) ;
      $q7 = $query->validateString($_POST['q7']) ;
    
     $q8 = $query->validateString($_POST['q8']) ;
        $q9 = $query->validateString($_POST['q9']) ;
          $q10 = $query->validateString($_POST['q10']) ;
           // $q11 = $query->validateString($_POST['q11']) ;
            
             $q12 = $query->validateString($_POST['q12']) ;
        
   // $binary = "11111001";
   //$token = bin2hex(random_bytes(50));// generate unique token
    //$password = password_hash($_POST['password'], PASSWORD_DEFAULT); //encrypt password
 
    // Check if email already exists
     
    if (count($errors) === 0) {
        
        $result = $query->insert("INSERT INTO organisation_ans( `user_id`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `q10`, `q11`, `q12`)"
                ."values( '$user','$q1', '$q2', '$q3','$q4','$q5','$q6', '$q7','$q8','$q9','$q10','$q11','$q12')");
       
    
        
        
        if ($result) {
         
            

             //$_SESSION['id'] = $user_id;
           
         //  $_SESSION['f_email'] = $q4;
       //      $_SESSION['verified'] = false;
            $_SESSION['message'] = 'You are logged in!';
            $_SESSION['type'] = 'alert-success';
            header('location:human.php');
        } else {
            $_SESSION['error_msg'] = "Database error: Could not register user";
        }
    }
}


if (isset($_POST['economy'])) {
   
    
    
   
    if(!empty($_POST['q1'])) {

        $q1=$query->filter($_POST['q1']);
    //    echo $gender;
            $q1 = implode(',', $_POST['q1']);
        }
     if(!empty($_POST['q2'])) {

        $q2=$query->filter($_POST['q2']);
    //    echo $gender;
            $q2 = implode(',', $_POST['q2']);
        }
      $q3 = $query->validateString($_POST['q3']) ;
       $q4 = $query->validateString($_POST['q4']) ;
        $q5 = $query->validateString($_POST['q5']) ;
        
    
    
     
    
      
    $user = $_POST['user'];
    
    
    
    
   // $binary = "11111001";
   //$token = bin2hex(random_bytes(50));// generate unique token
    //$password = password_hash($_POST['password'], PASSWORD_DEFAULT); //encrypt password
 
    // Check if email already exists
     
    if (count($errors) === 0) {
        
       $result = $query->insert("INSERT INTO economy_ans(user_id,q1,q2,q3,q4,q5)values('$user','$q1', '$q2', '$q3', '$q4', '$q5')");
        
        
        if ($result) {
         
            

             //$_SESSION['id'] = $user_id;
           
         //  $_SESSION['f_email'] = $q4;
       //      $_SESSION['verified'] = false;
            $_SESSION['message'] = 'You are logged in!';
            $_SESSION['type'] = 'alert-success';
            header('location:general.php');
        } else {
            $_SESSION['error_msg'] = "Database error: Could not register user";
        }
    }
}


if (isset($_POST['general'])) {
   
    
    
     $q1 = $query->validateString($_POST['q1']) ;
       $q2 = $query->validateString($_POST['q2']) ;
        $q3 = $query->validateString($_POST['q3']) ;
         $q4 = $query->validateString($_POST['q4']) ;
       $q5 = $query->validateString($_POST['q5']) ;
        $q6 = $query->validateString($_POST['q6']) ;
          $q7 = $query->validateString($_POST['q7']) ;
    
   
    if(!empty($_POST['q8'])) {

        $q8=$query->filter($_POST['q1']);
    //    echo $gender;
            $q8 = implode(',', $_POST['q8']);
        }
     
        
    
    
     
    
      
    $user = $_POST['user'];
    
    
    
    
   // $binary = "11111001";
   //$token = bin2hex(random_bytes(50));// generate unique token
    //$password = password_hash($_POST['password'], PASSWORD_DEFAULT); //encrypt password
 
    // Check if email already exists
     
    if (count($errors) === 0) {
        
       $result = $query->insert("INSERT INTO general_ans(user_id,q1,q2,q3,q4,q5,q6,q7,q8)values('$user','$q1', '$q2', '$q3', '$q4', '$q5','$q6','$q7','$q8')");
        
        
        if ($result) {
         
            

             //$_SESSION['id'] = $user_id;
           
         //  $_SESSION['f_email'] = $q4;
       //      $_SESSION['verified'] = false;
            $_SESSION['message'] = 'You are logged in!';
            $_SESSION['type'] = 'alert-success';
            header('location:general.php');
        } else {
            $_SESSION['error_msg'] = "Database error: Could not register user";
        }
    }
}

