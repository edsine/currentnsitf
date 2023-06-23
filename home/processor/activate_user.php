 <?php   
   if(empty($_SESSION['key']))
   $_SESSION['key'] = bin2hex(random_bytes(32));
 //  echo $_SESSION['key'];
 
 $csrf = hash_hmac('sha256', 'this is some string:index.php ', $_SESSION['key']);        
 
 if (isset($_POST['create'])) {
     if(hash_equals($csrf, $_POST['csrf'])){
        
    
       $name = $query->validateString($_POST['name']) ;
        $lastname = $query->validateString($_POST['lname']) ;
        
          $phone = $query->validateString($_POST['phone']) ;
         
          $email = $query->validateString($_POST['email']) ;
           
           $fullname =  $name. ' '. $lastname;
           $priv =  $_POST['priv'];
           
           
                
                 //$password = $query->validateString($_POST['pass']);
                 
                    $password1 = rand(10000000,99999999);
                  $password = password_hash($password1, PASSWORD_BCRYPT);
                  
                 
                  $pin = rand(100000,999999);
                  $Hashpin =  base64_encode($pin);
              
                    
                       //    $pend = 1;
    
    
   //   $farmID = $query->getToken(12);
  
  $check = $query->getRows("SELECT * FROM app_admin WHERE admin_email='$email' LIMIT 1");
 
    
    if ( $check) {
        $errors['email'] = "Email already exists";
        // $state = $query->getRows("select * from state");
    }
     if (count($errors) === 0) {
         
        
       $query1 = "INSERT INTO app_admin SET fullname=?, admin_email = ?,admin_phone = ?, privilege=?, password=? ";
        $stmt = $conn->prepare($query1);
        $stmt->bind_param('sssss', $fullname, $email,$phone, $priv, $password );
        $result = $stmt->execute();
        
         
                        
                        
    $mail->IsSMTP();                                      // set mailer to use SMTP
$mail->Host = "navsa.ng";  // specify main and backup server
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Username = "info@navsa.ng";  // SMTP username
$mail->Password = "@navsa2020"; // SMTP password

$mail->From = "info@navsa.ng";
$mail->FromName = "navsa";
//$mail->AddAddress("josh@example.net", "Josh Adams");
$mail->AddAddress("$email");                  // name is optional
$mail->AddReplyTo("info@navsa.ng", "Information");

$mail->WordWrap = 50;                                  // set word wrap to 50 characters
//$mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
$mail->IsHTML(true);                                  // set email format to HTML

$mail->Subject = "NAVSA ADMIN,";

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
    <span class=\"preheader\">NAVSA NEW ADMIN NOTIFICATION</span>
    <table class=\"email-wrapper\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" role=\"presentation\">
      <tr>
        <td align=\"center\">
          <table class=\"email-content\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" role=\"presentation\">
            <tr>
              <td class=\"email-masthead\">
                <a href=\"https://www.navsa.ng\" class=\"f-fallback email-masthead_name\">
                               NAVSA
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
                        <h1>Hello $fullname,</h1>
                        <p>You're now a NAVSA ADMIN LEVEL :   $priv.</p>
                         <p>you can now login to the NAVSA admin using the following password <span style='font-size:28px; color:green;'>$password1</span> .
</p>
                       
                        <!-- Action -->
                       
                       
                        <p>If you have any challenge, feel free to contact NAVSA
                               <a href=\"{{support_url}}\">support team</a> for help.</p>
                        <p>Thank you ,
                          <br>NAVSA Support Team</p>
                        <!-- Sub copy -->
                       
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table class=\"email-footer\" align=\"center\" width=\"570\" cellpadding=\"0\" cellspacing=\"0\" role=\"presentation\">
                  <tr>
                    <td class=\"content-cell\" align=\"center\">
                      <p class=\"f-fallback sub align-center\">&copy; 2020 NAVSA. All rights reserved.</p>
                      <p class=\"f-fallback sub align-center\">
                        National Adopted Village for Smart Agriculture
                        <br>No. 28, Port Harcourt Crescent.
                        <br>Off Gimbiya Street,
                                <br> Area 11 Garki, Abuja, Nigeria.
                      </p>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </body>
</html>;
";
$mail->AltBody = "navsa.ng";




//$query=$conn->query("insert into materials(category_id,title,material_desc,up_name, material_file)values('$cat_id','$mat_title','$desc','$up_name','$name')");
if(!$mail->Send()){
echo "essage Can not be sent";
}     
  
        
       
        $_SESSION['email'] = $email;
     header("location:user created");
     }
}else{
     header("location:index");
     
}
}
           
            
            
  if (isset($_POST['farmer'])) {
           
           //$cat = $_POST['cat'];
           $state = $_POST['active'];
           
           
         //  $_SESSION['cat'] = $cat;
            $_SESSION['state'] = $state;
            
            
            
            if(  $state == 'all'){
                
                header("location:all farmers");
                
            }else{
                 header("location:farmers");
            }
           
           
       }
       
       
       
                   
  if (isset($_POST['sinput'])) {
           
           //$cat = $_POST['cat'];
           $supplier = $_POST['supplier'];
           
           
         //  $_SESSION['cat'] = $cat;
            $_SESSION['s_id'] = $supplier;
            
            
            
                header("location:remita/src/compAccount");
                
        
       }
       
       
       
       
       if (isset($_POST['transfer'])) {
           
           $credit = $_POST['credit'];
           $debit = $_POST['debit'];
           $amount = $_POST['amount'];
        
            if(!empty($credit) && !empty($debit) && !empty($amount)){
                
                  $_SESSION['amount'] = $amount;
                    $_SESSION['credit'] = $credit;
                      $_SESSION['debit'] = $debit;
                
                header("location:direct transfer");
                
            }else{
                 //header("location:");
            }
           
           
       }
       
       
       
        if (isset($_POST['transF'])) {
           
           $dash = $_POST['dash'];
        
            if(!empty($dash) ){
                
                  $_SESSION['dash'] = $dash;
                 
                
                header("location:trans_ref");
                
            }else{
                 //header("location:");
            }
           
           
       }
       
       
       
       
       
        if (isset($_POST['request'])) {
           
           $rqst = $_POST['rqst'];
            $state = $_POST['state'];
            
            $batch = $_POST['batch'];
           $_SESSION['batch'] = $batch;
            
            if( $rqst == 'approved'){
                
                  $_SESSION['state'] = $state;
                header("location:request.approved");
                
            }elseif($rqst == 'decline'){
                  $_SESSION['state'] = $state;
                 header("location:decline");
                 
            }elseif($rqst == 'pending'){
                  $_SESSION['state'] = $state;
                
                 header("location:pending");
                
            }
           
           
       }