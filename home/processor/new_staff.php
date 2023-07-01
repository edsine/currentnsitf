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




require("PHPMailer_5.2.0/class.phpmailer.php");
require("PHPMailer_5.2.0/class.smtp.php");
require("PHPMailer_5.2.0/class.pop3.php");
 
  $mail = new PHPMailer();

require __DIR__.'/classes/database.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();


            //     $nin =  $_POST['nin'];
                
                  $branch = $_POST['branch'] ;
                  $depart = $_POST['department'] ;
                  $unit = $_POST['unit'];
                $fname =    $_POST['fname'] ;
                  $mname =   $_POST['mname'] ;
                 $lname = $_POST['lname'] ;
                $phone =   $_POST['phone'];
                $cemail =   $_POST['cemail'];
                  $gendar =   $_POST['gender'];
                   $region =   $_POST['region'];
                   
                  
                   
                   $dash = 1;
                $role = $_POST['role'];
                
                
                if($role == 8){
                    
                    $roli = "USER";
                }elseif($role == 1){
                    
                    $roli = "SUPER ADMIN";
                }elseif($role == 4){
                    $roli = "ACCOUNT & FINANCE";
                }elseif($role == 2){
                    
                    $roli = "INSPECTION";
                }elseif($role == 3){
                    
                    $roli = "HUMAN RESOURCE";
                }elseif($role == 5){
                    
                    $roli = "HEALTH";
                }elseif($role == 6){
                    
                    $roli = "ADMINISTRATION";
                }
                
               
                    
                
        try{
            
            
                   $check_phone = "SELECT staff_email FROM staff_tb WHERE staff_email=:email";
            $check_email_stmt = $conn->prepare($check_phone);
            $check_email_stmt->bindValue(':email', $cemail,PDO::PARAM_STR);
            $check_email_stmt->execute();
             



                 
             $iemail = "nmibrahim19@gmail.com";

            if($check_email_stmt->rowCount()){
              $_SESSION['errors'] = "Staff already exist on the platform";
              
                    header("location:../new_staff");
            
           } else{
            
        
          
          
          
          $userId =  rand(10000000,99999999);
        
               $password1 = rand(10000000,99999999);
                  
                  $password = "nsitf@". $password1;
                
                 $insert_query = "INSERT INTO `staff_tb`( roles, departmentId, `dash_type`, `firstname`, `middlename`, `lastname`, staff_id, `gender`, `branchId`, `region`, `phone`, unit, `staff_email`, `security_key` )VALUES(:roles,:department,:dash_type,
                :firstname,:middlename, :lastname,:staff_id, :gender, :branchId, :region, :phone, :unit, :staff_email, :security_key )";

                $insert_stmt = $conn->prepare($insert_query);

                // DATA BINDING
                  $insert_stmt->bindValue(':roles',  $role,PDO::PARAM_INT);
                  
                   $insert_stmt->bindValue(':department',  $depart,PDO::PARAM_INT);
                  
                  

                    
                $insert_stmt->bindValue(':dash_type', htmlspecialchars(strip_tags( $dash)),PDO::PARAM_INT);
                
                $insert_stmt->bindValue(':firstname',   $fname,PDO::PARAM_STR);
                
                $insert_stmt->bindValue(':staff_id',   $userId,PDO::PARAM_STR);
                
               $insert_stmt->bindValue(':middlename',$mname,PDO::PARAM_STR);
               
               $insert_stmt->bindValue(':lastname', htmlspecialchars(strip_tags( $lname)),PDO::PARAM_STR);
               
                $insert_stmt->bindValue(':gender', $gendar,PDO::PARAM_STR);
                
                 
                $insert_stmt->bindValue(':region', $region,PDO::PARAM_STR);
                
                  $insert_stmt->bindValue(':branchId',  $branch,PDO::PARAM_INT);
                
                
                  $insert_stmt->bindValue(':phone', htmlspecialchars(strip_tags($phone)),PDO::PARAM_STR);

                  $insert_stmt->bindValue(':unit', htmlspecialchars(strip_tags($unit)),PDO::PARAM_STR);
                  
                  
                  
                   $insert_stmt->bindValue(':staff_email', $cemail,PDO::PARAM_STR);
            
                    $insert_stmt->bindValue(':security_key', password_hash($password, PASSWORD_DEFAULT),PDO::PARAM_STR);
                 
              
                 
                 
               $result = $insert_stmt->execute();
                $employer = $conn->lastInsertId();
                $file = 'CAC';
               
               
                
                if($result){
                    
                    
                      $mail->IsSMTP();                                      // set mailer to use SMTP
$mail->Host = "nsitf.gov.ng";  // specify main and backup server
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Username = "ebs@nsitf.gov.ng";  // SMTP username
$mail->Password = "2338@hajara"; // SMTP password

$mail->From = "ebs@nsitf.gov.ng";
$mail->FromName = "nsitf";
//$mail->AddAddress("josh@example.net", "Josh Adams");
$mail->AddAddress("$cemail");                  // name is optional
$mail->AddReplyTo("ebs@nsitf.gov.ng", "Information");

$mail->WordWrap = 50;                                  // set word wrap to 50 characters
//$mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
$mail->IsHTML(true);                                  // set email format to HTML

$mail->Subject = "NSITF EBS LOGIN CREDENTIALS,";

$mail->Body    = "
<html xmlns=\"http://www.w3.org/1999/xhtml\">
  <head>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />
    <meta name=\"x-apple-disable-message-reformatting\" />
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
    <meta name=\"color-scheme\" content=\"light dark\" />
    <meta name=\"supported-color-schemes\" content=\"light dark\" />
    <title></title>
    <style type=\"text/css\" rel=\"stylesheet\" media=\"all\">
    /* Base ------------------------------ */
    
    @import url(\"https://fonts.googleapis.com/css?family=Nunito+Sans:400,700&display=swap\");
    body {
      width: 100% !important;
      height: 100%;
      margin: 0;
      -webkit-text-size-adjust: none;
    }
    
    a {
      color: #3869D4;
    }
    
    a img {
      border: none;
    }
    
    td {
      word-break: break-word;
    }
    
    .preheader {
      display: none !important;
      visibility: hidden;
      mso-hide: all;
      font-size: 1px;
      line-height: 1px;
      max-height: 0;
      max-width: 0;
      opacity: 0;
      overflow: hidden;
    }
    /* Type ------------------------------ */
    
    body,
    td,
    th {
      font-family: \"Nunito Sans\", Helvetica, Arial, sans-serif;
    }
    
    h1 {
      margin-top: 0;
      color: #333333;
      font-size: 22px;
      font-weight: bold;
      text-align: left;
    }
    
    h2 {
      margin-top: 0;
      color: #333333;
      font-size: 16px;
      font-weight: bold;
      text-align: left;
    }
    
    h3 {
      margin-top: 0;
      color: #333333;
      font-size: 14px;
      font-weight: bold;
      text-align: left;
    }
    
    td,
    th {
      font-size: 16px;
    }
    
    p,
    ul,
    ol,
    blockquote {
      margin: .4em 0 1.1875em;
      font-size: 16px;
      line-height: 1.625;
    }
    
    p.sub {
      font-size: 13px;
    }
    /* Utilities ------------------------------ */
    
    .align-right {
      text-align: right;
    }
    
    .align-left {
      text-align: left;
    }
    
    .align-center {
      text-align: center;
    }
    /* Buttons ------------------------------ */
    
    .button {
      background-color: #3869D4;
      border-top: 10px solid #3869D4;
      border-right: 18px solid #3869D4;
      border-bottom: 10px solid #3869D4;
      border-left: 18px solid #3869D4;
      display: inline-block;
      color: #FFF;
      text-decoration: none;
      border-radius: 3px;
      box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);
      -webkit-text-size-adjust: none;
      box-sizing: border-box;
    }
    
    .button--green {
      background-color: #22BC66;
      border-top: 10px solid #22BC66;
      border-right: 18px solid #22BC66;
      border-bottom: 10px solid #22BC66;
      border-left: 18px solid #22BC66;
    }
    
    .button--red {
      background-color: #FF6136;
      border-top: 10px solid #FF6136;
      border-right: 18px solid #FF6136;
      border-bottom: 10px solid #FF6136;
      border-left: 18px solid #FF6136;
    }
    
    @media only screen and (max-width: 500px) {
      .button {
        width: 100% !important;
        text-align: center !important;
      }
    }
    /* Attribute list ------------------------------ */
    
    .attributes {
      margin: 0 0 21px;
    }
    
    .attributes_content {
      background-color: #F4F4F7;
      padding: 16px;
    }
    
    .attributes_item {
      padding: 0;
    }
    /* Related Items ------------------------------ */
    
    .related {
      width: 100%;
      margin: 0;
      padding: 25px 0 0 0;
      -premailer-width: 100%;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
    }
    
    .related_item {
      padding: 10px 0;
      color: #CBCCCF;
      font-size: 15px;
      line-height: 18px;
    }
    
    .related_item-title {
      display: block;
      margin: .5em 0 0;
    }
    
    .related_item-thumb {
      display: block;
      padding-bottom: 10px;
    }
    
    .related_heading {
      border-top: 1px solid #CBCCCF;
      text-align: center;
      padding: 25px 0 10px;
    }
    /* Discount Code ------------------------------ */
    
    .discount {
      width: 100%;
      margin: 0;
      padding: 24px;
      -premailer-width: 100%;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
      background-color: #F4F4F7;
      border: 2px dashed #CBCCCF;
    }
    
    .discount_heading {
      text-align: center;
    }
    
    .discount_body {
      text-align: center;
      font-size: 15px;
    }
    /* Social Icons ------------------------------ */
    
    .social {
      width: auto;
    }
    
    .social td {
      padding: 0;
      width: auto;
    }
    
    .social_icon {
      height: 20px;
      margin: 0 8px 10px 8px;
      padding: 0;
    }
    /* Data table ------------------------------ */
    
    .purchase {
      width: 100%;
      margin: 0;
      padding: 35px 0;
      -premailer-width: 100%;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
    }
    
    .purchase_content {
      width: 100%;
      margin: 0;
      padding: 25px 0 0 0;
      -premailer-width: 100%;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
    }
    
    .purchase_item {
      padding: 10px 0;
      color: #51545E;
      font-size: 15px;
      line-height: 18px;
    }
    
    .purchase_heading {
      padding-bottom: 8px;
      border-bottom: 1px solid #EAEAEC;
    }
    
    .purchase_heading p {
      margin: 0;
      color: #85878E;
      font-size: 12px;
    }
    
    .purchase_footer {
      padding-top: 15px;
      border-top: 1px solid #EAEAEC;
    }
    
    .purchase_total {
      margin: 0;
      text-align: right;
      font-weight: bold;
      color: #333333;
    }
    
    .purchase_total--label {
      padding: 0 15px 0 0;
    }
    
    body {
      background-color: #F4F4F7;
      color: #51545E;
    }
    
    p {
      color: #51545E;
    }
    
    p.sub {
      color: #6B6E76;
    }
    
    .email-wrapper {
      width: 100%;
      margin: 0;
      padding: 0;
      -premailer-width: 100%;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
      background-color: #F4F4F7;
    }
    
    .email-content {
      width: 100%;
      margin: 0;
      padding: 0;
      -premailer-width: 100%;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
    }
    /* Masthead ----------------------- */
    
    .email-masthead {
      padding: 25px 0;
      text-align: center;
    }
    
    .email-masthead_logo {
      width: 94px;
    }
    
    .email-masthead_name {
      font-size: 16px;
      font-weight: bold;
      color: #A8AAAF;
      text-decoration: none;
      text-shadow: 0 1px 0 white;
    }
    /* Body ------------------------------ */
    
    .email-body {
      width: 100%;
      margin: 0;
      padding: 0;
      -premailer-width: 100%;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
      background-color: #FFFFFF;
    }
    
    .email-body_inner {
      width: 570px;
      margin: 0 auto;
      padding: 0;
      -premailer-width: 570px;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
      background-color: #FFFFFF;
    }
    
    .email-footer {
      width: 570px;
      margin: 0 auto;
      padding: 0;
      -premailer-width: 570px;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
      text-align: center;
    }
    
    .email-footer p {
      color: #6B6E76;
    }
    
    .body-action {
      width: 100%;
      margin: 30px auto;
      padding: 0;
      -premailer-width: 100%;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
      text-align: center;
    }
    
    .body-sub {
      margin-top: 25px;
      padding-top: 25px;
      border-top: 1px solid #EAEAEC;
    }
    
    .content-cell {
      padding: 35px;
    }
    /*Media Queries ------------------------------ */
    
    @media only screen and (max-width: 600px) {
      .email-body_inner,
      .email-footer {
        width: 100% !important;
      }
    }
    
    @media (prefers-color-scheme: dark) {
      body,
      .email-body,
      .email-body_inner,
      .email-content,
      .email-wrapper,
      .email-masthead,
      .email-footer {
        background-color: #333333 !important;
        color: #FFF !important;
      }
      p,
      ul,
      ol,
      blockquote,
      h1,
      h2,
      h3 {
        color: #FFF !important;
      }
      .attributes_content,
      .discount {
        background-color: #222 !important;
      }
      .email-masthead_name {
        text-shadow: none !important;
      }
    }
    
    :root {
      color-scheme: light dark;
      supported-color-schemes: light dark;
    }
    </style>
    <!--[if mso]>
    <style type=\"text/css\">
      .f-fallback  {
        font-family: Arial, sans-serif;
      }
    </style>
  <![endif]-->
  </head>
  <body>
    <span class=\"preheader\">NATIONAL SOCIAL INSURANCE TRUST FUND EBS LOGIN CREDENTIALS</span>
    <table class=\"email-wrapper\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" role=\"presentation\">
      <tr>
        <td align=\"center\">
          <table class=\"email-content\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" role=\"presentation\">
            <tr>
              <td class=\"email-masthead\">
                <a href=\"https://www.navsa.ng\" class=\"f-fallback email-masthead_name\">
                              <img src =\"https://ebs.nsitf.gov.ng/ikl.png \" style=\"width:100px\">
              </a>
              </td>
            </tr>
            <!-- Email Body -->
            <tr>
              <td class=\"email-body\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">
                <table class=\"email-body_inner\" align=\"centerv\" width=\"570\" cellpadding=\"0\" cellspacing=\"0\" role=\"presentation\">
                  <!-- Body content -->
                  <tr>
                    <td class=\"content-cell\">
                      <div class=\"f-fallback\">
                       
                        <p></p>
                        <p>Congratulations! Your EBS account has been created.
You now have access to a wide range of resources that will simply your day-to-day tasks. 
   </p>
                         <p>Your login credentials are as follows: <br></p>
                         
                         <ul>
                        <li>Email: $cemail</li> 
                        
                          <li>Password: $password</li> 
                        
                         
                       </u>
              <p><a href=\"https://ebs.nsitf.gov.ng\"> Login here</a></p>
                       
                        <!-- Action -->
                       
                       
                        <p>Please log in now to change your password. Note that it is your responsibility to keep your login credentials secure.
                             </p>
                          
                          <p>The ICT Department is available to provide all the support you require.
.
                               <a href=\"{{support_url}}\">support team</a> for help.</p>
                        <p>Thank you ,
                          <br>Best Regards

                          EBS Support Team</p>
                        <!-- Sub copy -->
                       
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
               
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </body>
</html>;
";
$mail->AltBody = "ebs@nsitf.gov.ng";




//$query=$conn->query("insert into materials(category_id,title,material_desc,up_name, material_file)values('$cat_id','$mat_title','$desc','$up_name','$name')");
if(!$mail->Send()){
echo "essage Can not be sent";
}     
  
                
              
    
            header('location:../user_roles');
                    
               }


        }
        
    


        }
        catch(PDOException $e){
            $returnData = msg(0,500,'fail',$e->getMessage());
        }
    


echo json_encode($returnData);