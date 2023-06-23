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


$targetDir = "../employer_documents/";
$fileName = basename($_FILES["doc"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);



  
  

            //     $nin =  $_POST['nin'];
                
                  $employerId = $_SESSION['employerId']; //$_POST['employer']; 
                $fname =    $_POST['fname'] ;
                  $mname =   $_POST['mname'] ;
                 $lname = $_POST['lname'] ;
                  $address =  $_POST['address'];
                    $dob =  $_POST['dob'];
                      $gender =  $_POST['gender'];
                      
                        $marital =  $_POST['mstatus'];
                        $workId =  $_POST['workId'];
                        $empDate =  $_POST['emp_date'];
                        $email =   $_POST['email'];
                $job =   $_POST['jobT'];
                $state =  $_POST['state'];
                 $lgvt =  $_POST['lgvt'];
                $phone =  $_POST['phone'];
                
                $altPhone =  $_POST['alTphone'];
                 $id_mode =  $_POST['id_mode'];
                
                $id_num =  $_POST['id_num'];
         
                 
                 $issue_date =  $_POST['issue_date'];
                 $nextkin =  $_POST['nextkin'];
                 $next_num =  $_POST['next_num'];
                 $dpendant_num = $_POST['dpendant_num'];
                $monhtly_rem =  $_POST['monhtly_rem'];
                
                    
                
        try{
            

                 $pin = rand(100000,999999);
                  
                  $map = "RC".$pin;
                
                $insert_query = "INSERT INTO `employees`( `employer_Id`, `employee_surname`, `employee_firstname`, `employee_middlename`, `employee_address`, `dob`, `gender`, `marital_status`, `work_id`, `employment_date`, `employee_email`, `job_title`, `state_origin`, `lga`, `contact_phone`, `alternate_phone`, `identity_means`, `identity_number`, `issue_date`, `next_kin`, `next_kin_number`, `dependants_number`, `monthly_remuneration`)VALUES(:employer_Id,:employee_surname,:employee_firstname,
                :employee_middlename,:employee_address, :dob, :gender, :marital_status, :work_id, :employment_date, :employee_email, :job_title, :state_origin, :lga, :contact_phone, :alternate_phone, :identity_means, :identity_number, :issue_date, :next_kin,:next_kin_number, :dependants_number,:monthly_remuneration  )";

                $insert_stmt = $conn->prepare($insert_query);

                // DATA BINDING
                  $insert_stmt->bindValue(':employer_Id', $employerId,PDO::PARAM_INT);
                  
                $insert_stmt->bindValue(':employee_surname', htmlspecialchars(strip_tags( $lname)),PDO::PARAM_STR);
                
                $insert_stmt->bindValue(':employee_middlename', $mname,PDO::PARAM_STR);
                
               $insert_stmt->bindValue(':employee_firstname',  $fname,PDO::PARAM_STR);
               
               $insert_stmt->bindValue(':employee_address', htmlspecialchars(strip_tags($address)),PDO::PARAM_STR);
               
              
                
                 $insert_stmt->bindValue(':dob', htmlspecialchars(strip_tags($dob)),PDO::PARAM_STR);
                 
                $insert_stmt->bindValue(':gender',    $gender,PDO::PARAM_STR);
                
                
                  $insert_stmt->bindValue(':marital_status', htmlspecialchars(strip_tags($marital)),PDO::PARAM_STR);
                  
                  
                   $insert_stmt->bindValue(':work_id', htmlspecialchars(strip_tags($ $workId)),PDO::PARAM_STR);
                   
                    $insert_stmt->bindValue(':employment_date', htmlspecialchars(strip_tags($empDate)),PDO::PARAM_STR);
                    
                     $insert_stmt->bindValue(':employee_email', htmlspecialchars(strip_tags($email)),PDO::PARAM_STR);
                     
                     
                     
                     
                     $insert_stmt->bindValue(':job_title', htmlspecialchars(strip_tags($job)),PDO::PARAM_STR);
                     
                     $insert_stmt->bindValue(':state_origin', htmlspecialchars(strip_tags($state)),PDO::PARAM_STR);
                     
                     
                     $insert_stmt->bindValue(':lga', htmlspecialchars(strip_tags( $lgvt)),PDO::PARAM_STR);
                     
                     
                     $insert_stmt->bindValue(':contact_phone', htmlspecialchars(strip_tags($phone)),PDO::PARAM_STR);
                     
                     
                     $insert_stmt->bindValue(':alternate_phone', htmlspecialchars(strip_tags($altPhone)),PDO::PARAM_STR);
                     
                     
                     $insert_stmt->bindValue(':identity_means', htmlspecialchars(strip_tags($id_mode)),PDO::PARAM_STR);
                     
                     
                     $insert_stmt->bindValue(':identity_number', htmlspecialchars(strip_tags( $id_num)),PDO::PARAM_STR);
                     
                     $insert_stmt->bindValue(':issue_date', htmlspecialchars(strip_tags( $issue_date)),PDO::PARAM_STR);
                     
                     $insert_stmt->bindValue(':next_kin', htmlspecialchars(strip_tags($nextkin)),PDO::PARAM_STR);
                     $insert_stmt->bindValue(':next_kin_number', htmlspecialchars(strip_tags($next_num)),PDO::PARAM_STR);
                     $insert_stmt->bindValue(':dependants_number', htmlspecialchars(strip_tags($dpendant_num)),PDO::PARAM_STR);
                     $insert_stmt->bindValue(':monthly_remuneration', htmlspecialchars(strip_tags($monhtly_rem)),PDO::PARAM_STR);
                     
                     
                     
                 
                 
               $result = $insert_stmt->execute();
                $employer = $conn->lastInsertId();
                $file = 'CAC';
               
               
                
                if($result){
                 
                
            
                  
                  
                 $_SESSION['name'] = $fname;
                   $_SESSION['logging'] =TRUE;
                 
                     
                     
                     
                     
                     
                    $_SESSION['success'] = "New employee record [" . $fname. "] uploaded successfully"; 
                     
                     
                 
    
            header('location:../account/employee');
                    
               }




        }
        catch(PDOException $e){
            $returnData = msg(0,500,'fail',$e->getMessage());
        }
    


echo json_encode($returnData);