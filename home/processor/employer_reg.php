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



require __DIR__.'/../../classes/Database.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();


$targetDir = "../DOCUMENTS/";
$fileName = basename($_FILES["doc"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);



require("/home2/artisan6/public_html/demo/client/PHPMailer_5.2.0/class.phpmailer.php");
require("/home2/artisan6/public_html/demo/client/PHPMailer_5.2.0/class.smtp.php");
require("/home2/artisan6/public_html/demo/client/PHPMailer_5.2.0/class.pop3.php");


 //$query =new Manage();
  $mail = new PHPMailer();


            //     $nin =  $_POST['nin'];
                
                  $branch = $_POST['branch'] ;
                $fname =    $_POST['fname'] ;
                  $mname =   $_POST['mname'] ;
                 $lname = $_POST['lname'] ;
                $phone =   $_POST['phone'];
                $cemail =   $_POST['cemail'];
                $position =  $_POST['position'];
                $nin =  $_POST['nin'];
                $password = $_POST['password'];
                  $state =  $_POST['state'];
                 $lgvt =  $_POST['lgvt'];
                 $companyName =  $_POST['compName'];
                 $rcnumber =  $_POST['rcnumber'];
                 $cacDate =  $_POST['cacDate'];
                 $bussi = $_POST['bussi'];
                $address =  $_POST['address'];
         
                    
                
        try{
            
            
             $check_phone = "SELECT c_email FROM employer_tb WHERE c_email=:email";
            $check_email_stmt = $conn->prepare($check_phone);
            $check_email_stmt->bindValue(':email', $cemail,PDO::PARAM_STR);
            $check_email_stmt->execute();

            if($check_email_stmt->rowCount()){
              $_SESSION['errors'] = "Employer with the following email address already exist";
                    header("location:../register");
            
           } else{
            
              
            
           $allowTypes = array('jpg','png','jpeg','pdf');
          if(in_array($fileType, $allowTypes)){
      
        if(move_uploaded_file($_FILES["doc"]["tmp_name"], $targetFilePath)){
 

                 $pin = rand(100000,999999);
                  
                  $map = "RC".$pin;
                
                $insert_query = "INSERT INTO `employer_tb`(`company_name`, `rc_number`, `cac_date`,address, postal_address, state, local_gvt, c_email, password, desk_surname,`desk_middlename`, `desk_firstname`, `desk_phone`, `desk_position`, `nin`, `bussiness_area`, `branchId`, regionId )VALUES(:cname,
                :rcnum,:cacDate, :address, :postal, :state, :local, :cemail, :password, :deskS, :deskM, :deskF,:dphone, :dposition, :nin, :busA, :branch, :region )";

                $insert_stmt = $conn->prepare($insert_query);

                // DATA BINDING
                
                $insert_stmt->bindValue(':cname', htmlspecialchars(strip_tags( $companyName)),PDO::PARAM_STR);
                $insert_stmt->bindValue(':rcnum',  $rcnumber,PDO::PARAM_STR);
               $insert_stmt->bindValue(':cacDate',$cacDate,PDO::PARAM_STR);
               
               $insert_stmt->bindValue(':address', htmlspecialchars(strip_tags($address)),PDO::PARAM_STR);
                $insert_stmt->bindValue(':postal', $address,PDO::PARAM_STR);
                
                 $insert_stmt->bindValue(':state', htmlspecialchars(strip_tags($state)),PDO::PARAM_STR);
                $insert_stmt->bindValue(':local', $lgvt,PDO::PARAM_STR);
                
                
                  $insert_stmt->bindValue(':cemail', htmlspecialchars(strip_tags($cemail)),PDO::PARAM_STR);
                  
                  
            
                    $insert_stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT),PDO::PARAM_STR);
                
                 $insert_stmt->bindValue(':deskS',  $lname,PDO::PARAM_STR);
                   $insert_stmt->bindValue(':deskM',   $mname,PDO::PARAM_STR);
                   $insert_stmt->bindValue(':deskF',   $fname,PDO::PARAM_STR);
                    
                    
                     $insert_stmt->bindValue(':dphone',  $phone,PDO::PARAM_STR);
                      $insert_stmt->bindValue(':dposition',  $position,PDO::PARAM_STR);
                       $insert_stmt->bindValue(':nin',  $nin,PDO::PARAM_STR);
                       
                       
                       
                         $insert_stmt->bindValue(':busA',  $bussi,PDO::PARAM_STR);
                      $insert_stmt->bindValue(':branch',  $branch,PDO::PARAM_STR);
                       $insert_stmt->bindValue(':region',  $branch,PDO::PARAM_STR);
           
              
              
                 
                 
               $result = $insert_stmt->execute();
                $employer = $conn->lastInsertId();
                $file = 'CAC';
               
               
                
                if($result){
                 
                
                    $insert_query = "INSERT INTO `employer_doc`(`employerId`,`file_type`,`file_name`) VALUES(:empId,:file,:fileName)";
                     $insert_stmt = $conn->prepare($insert_query);

             // DATA BINDING
               $insert_stmt->bindValue(':empId',$employer,PDO::PARAM_INT);
               $insert_stmt->bindValue(':file',$file,PDO::PARAM_STR);
               $insert_stmt->bindValue(':fileName', $fileName,PDO::PARAM_STR);
              
           $insert_stmt->execute();
 
              
              
              
               
               
                  // $returnData = msg(1,201,$user,'You have successfully registered.');
                  
             
                  
            $mail->IsSMTP();                                      // set mailer to use SMTP
$mail->Host = "artisanpro.ng";  // specify main and backup server
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Username = "info@artisanpro.ng";  // SMTP username
$mail->Password = "2338@Sanaa"; // SMTP password

$mail->From = "info@artisanpro.ng";
$mail->FromName = "artisanpro";
//$mail->AddAddress("josh@example.net", "Josh Adams");
$mail->AddAddress("$cemail");                  // name is optional
$mail->AddReplyTo("info@artisanpro.ng", "Information");

$mail->WordWrap = 50;                                  // set word wrap to 50 characters
//$mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
$mail->IsHTML(true);                                  // set email format to HTML

$mail->Subject = "Wellcome Message,";

$mail->Body    = "

<html xmlns:v=\"urn:schemas-microsoft-com:vml\">

<head>
    <meta http-equiv= \"Content-Type\" content=\"text/html; charset=UTF-8 \" />
    <meta name=\"viewport\" content=\"width=device-width; initial-scale=1.0; maximum-scale=1.0;\" />
    <!--[if !mso]--><!-- -->
    <link href='https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700' rel=\"stylesheet\">
    <link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel=\"stylesheet\">
    <!-- <![endif]-->

    <title>Material Design for Bootstrap</title>

    <style type=\"text/css\">
        body {
            width: 100%;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            mso-margin-top-alt: 0px;
            mso-margin-bottom-alt: 0px;
            mso-padding-alt: 0px 0px 0px 0px;
        }
        
        p,
        h1,
        h2,
        h3,
        h4 {
            margin-top: 0;
            margin-bottom: 0;
            padding-top: 0;
            padding-bottom: 0;
        }
        
        span.preheader {
            display: none;
            font-size: 1px;
        }
        
        html {
            width: 100%;
        }
        
        table {
            font-size: 14px;
            border: 0;
        }
        /* ----------- responsivity ----------- */
        
        @media only screen and (max-width: 640px) {
            /*------ top header ------ */
            .main-header {
                font-size: 20px !important;
            }
            .main-section-header {
                font-size: 28px !important;
            }
            .show {
                display: block !important;
            }
            .hide {
                display: none !important;
            }
            .align-center {
                text-align: center !important;
            }
            .no-bg {
                background: none !important;
            }
            /*----- main image -------*/
            .main-image img {
                width: 440px !important;
                height: auto !important;
            }
            /* ====== divider ====== */
            .divider img {
                width: 440px !important;
            }
            /*-------- container --------*/
            .container590 {
                width: 440px !important;
            }
            .container580 {
                width: 400px !important;
            }
            .main-button {
                width: 220px !important;
            }
            /*-------- secions ----------*/
            .section-img img {
                width: 320px !important;
                height: auto !important;
            }
            .team-img img {
                width: 100% !important;
                height: auto !important;
            }
        }
        
        @media only screen and (max-width: 479px) {
            /*------ top header ------ */
            .main-header {
                font-size: 18px !important;
            }
            .main-section-header {
                font-size: 26px !important;
            }
            /* ====== divider ====== */
            .divider img {
                width: 280px !important;
            }
            /*-------- container --------*/
            .container590 {
                width: 280px !important;
            }
            .container590 {
                width: 280px !important;
            }
            .container580 {
                width: 260px !important;
            }
            /*-------- secions ----------*/
            .section-img img {
                width: 280px !important;
                height: auto !important;
            }
        }
    </style>
    <!-- [if gte mso 9]><style type=”text/css”>
        body {
        font-family: arial, sans-serif!important;
        }
        </style>
    <![endif]-->
</head>


<body class=\"respond\" leftmargin=\"0\" topmargin=\"0\" marginwidth=\"0\" marginheight=\"0\">
    <!-- pre-header -->
    <table style=\"display:none!important;\">
        <tr>
            <td>
                <div style=\"overflow:hidden;display:none;font-size:1px;color:#ffffff;line-height:1px;font-family:Arial;maxheight:0px;max-width:0px;opacity:0;\">
                    Pre-header for the newsletter template
                </div>
            </td>
        </tr>
    </table>
    <!-- pre-header end -->
    <!-- header -->
    <table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"ffffff\">

        <tr>
            <td align=\"center\">
                <table border=\"0\" align=\"center\" width=\"590\" cellpadding=\"0\" cellspacing=\"0\" class=\"container590\">

                    <tr>
                        <td height=\"25\" style=\"font-size: 25px; line-height: 25px;\">&nbsp;</td>
                    </tr>

                    <tr>
                        <td align=\"center\">

                            <table border=\"0\" align=\"center\" width=\"590\" cellpadding=\"0\" cellspacing=\"0\" class=\"container590\">

                                <tr>
                                    <td align=\"center\" height=\"70\" style=\"height:70px;\">
                                        <a href=\"\" style=\"display: block; border-style: none !important; border: 0 !important;\"><img width=\"100\" border=\"0\" style=\"display: block; width: 100px;\" src=\"https://sanaa.ng/certification/assets/img/artisanPro.png\" alt=\"\" /></a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td height=\"25\" style=\"font-size: 25px; line-height: 25px;\">&nbsp;</td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
    <!-- end header -->

    <!-- big image section -->
    <table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"ffffff\" class=\"bg_color\">

        <tr>
            <td align=\"center\">
                <table border=\"0\" align=\"center\" width=\"590\" cellpadding=\"0\" cellspacing=\"0\" class=\"container590\">
                    <tr>

                        <td align=\"center\" class=\"section-img\">
                            <a href=\"\" style=\" border-style: none !important; display: block; border: 0 !important;\"><img src=\"https://mdbootstrap.com/img/Mockups/Lightbox/Original/img (67).jpg\" style=\"display: block; width: 590px;\" width=\"590\" border=\"0\" alt=\"\" /></a>




                        </td>
                    </tr>
                    <tr>
                        <td height=\"20\" style=\"font-size: 20px; line-height: 20px;\">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align=\"center\" style=\"color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;\" class=\"main-header\">


                            <div style=\"line-height: 35px\">

                                WELLCOME <span style=\"color: #5caad2;\">TO ARTISANPRO</span>

                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td height=\"10\" style=\"font-size: 10px; line-height: 10px;\">&nbsp;</td>
                    </tr>

                    <tr>
                        <td align=\"center\">
                            <table border=\"0\" width=\"40\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"eeeeee\">
                                <tr>
                                    <td height=\"2\" style=\"font-size: 2px; line-height: 2px;\">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td height=\"20\" style=\"font-size: 20px; line-height: 20px;\">&nbsp;</td>
                    </tr>

                    <tr>
                        <td align=\"center\">
                            <table border=\"0\" width=\"400\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"container590\">
                                <tr>
                                    <td align=\"center\" style=\"color: #888888; font-size: 16px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;\">


                                        <div style=\"line-height: 24px\">

                                       Go from a novice to a high-earning artisan with leading industry certifications and government issued permits...
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td height=\"25\" style=\"font-size: 25px; line-height: 25px;\">&nbsp;</td>
                    </tr>

                    <tr>
                        <td align=\"center\">
                            <table border=\"0\" align=\"center\" width=\"160\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"5caad2\" >

                                <tr>
                                    <td height=\"10\" style=\"font-size: 10px; line-height: 10px;\">&nbsp;</td>
                                </tr>

                                <tr>
                                    <td align=\"center\" style=\"color: #ffffff; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 26px;\">


                                        <div style=\"line-height: 26px;\">
                                            <a href=\"https://sanaa.ng/certification/cdash\" style=\"color: #ffffff; text-decoration: none;\">GOTO DASHBOARD</a>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td height=\"10\" style=\"font-size: 10px; line-height: 10px;\">&nbsp;</td>
                                </tr>

                            </table>
                        </td>
                    </tr>


                </table>

            </td>
        </tr>

    </table>
    <!-- end section -->

    <!-- contact section -->
    <table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"ffffff\" class=\"bg_color\">

        <tr class=\"hide\">
            <td height=\"25\" style=\"font-size: 25px; line-height: 25px;\">&nbsp;</td>
        </tr>
        <tr>
            <td height=\"40\" style=\"font-size: 40px; line-height: 40px;\">&nbsp;</td>
        </tr>

        <tr>
            <td height=\"60\" style=\"border-top: 1px solid #e0e0e0;font-size: 60px; line-height: 60px;\">&nbsp;</td>
        </tr>

        <tr>
            <td align=\"center\">
                <table border=\"0\" align=\"center\" width=\"590\" cellpadding=\"0\" cellspacing=\"0\" class=\"container590 bg_color\">

                    <tr>
                        <td>
                            <table border=\"0\" width=\"300\" align=\"left\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;\" class=\"container590\">

                                <tr>
                                    <!-- logo -->
                                    <td align=\"left\">
                                        <a href=\"\" style=\"display: block; border-style: none !important; border: 0 !important;\"><img width=\"80\" border=\"0\" style=\"display: block; width: 80px;\" src=\"https://sanaa.ng/certification/assets/img/artisanPro.png\" alt=\"\" /></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td height=\"25\" style=\"font-size: 25px; line-height: 25px;\">&nbsp;</td>
                                </tr>

                                <tr>
                                    <td align=\"left\" style=\"color: #888888; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 23px;\" class=\"text_color\">
                                        <div style=\"color: #333333; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; font-weight: 600; mso-line-height-rule: exactly; line-height: 23px;\">

                                            Email us: <br/> <a href=\"mailto:info@sanaa.ng\" style=\"color: #888888; font-size: 14px; font-family: 'Hind Siliguri', Calibri, Sans-serif; font-weight: 400;\">info@sanaa.ng</a>

                                        </div>
                                    </td>
                                </tr>

                            </table>

                            <table border=\"0\" width=\"2\" align=\"left\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;\" class=\"container590\">
                                <tr>
                                    <td width=\"2\" height=\"10\" style=\"font-size: 10px; line-height: 10px;\"></td>
                                </tr>
                            </table>

                            <table border=\"0\" width=\"200\" align=\"right\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;\" class=\"container590\">

                                <tr>
                                    <td class=\"hide\" height=\"45\" style=\"font-size: 45px; line-height: 45px;\">&nbsp;</td>
                                </tr>



                                <tr>
                                    <td height=\"15\" style=\"font-size: 15px; line-height: 15px;\">&nbsp;</td>
                                </tr>

                                <tr>
                                    <td>
                                        <table border=\"0\" align=\"right\" cellpadding=\"0\" cellspacing=\"0\">
                                            <tr>
                                                <td>
                                                    <a href=\"https://www.facebook.com/mdbootstrap\" style=\"display: block; border-style: none !important; border: 0 !important;\"><img width=\"24\" border=\"0\" style=\"display: block;\" src=\"http://i.imgur.com/Qc3zTxn.png\" alt=\"\"></a>
                                                </td>
                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                <td>
                                                    <a href=\"https://twitter.com/MDBootstrap\" style=\"display: block; border-style: none !important; border: 0 !important;\"><img width=\"24\" border=\"0\" style=\"display: block;\" src=\"http://i.imgur.com/RBRORq1.png\" alt=\"\"></a>
                                                </td>
                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                <td>
                                                    <a href=\"https://plus.google.com/u/0/b/107863090883699620484/107863090883699620484/posts\" style=\"display: block; border-style: none !important; border: 0 !important;\"><img width=\"24\" border=\"0\" style=\"display: block;\" src=\"http://i.imgur.com/Wji3af6.png\" alt=\"\"></a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td height=\"60\" style=\"font-size: 60px; line-height: 60px;\">&nbsp;</td>
        </tr>

    </table>
    <!-- end section -->

    <!-- footer ====== -->
    <table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"f4f4f4\">

        <tr>
            <td height=\"25\" style=\"font-size: 25px; line-height: 25px;\">&nbsp;</td>
        </tr>

        <tr>
            <td align=\"center\">

                <table border=\"0\" align=\"center\" width=\"590\" cellpadding=\"0\" cellspacing=\"0\" class=\"container590\">

                    <tr>
                        <td>
                            <table border=\"0\" align=\"left\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;\" class=\"container590\">
                                <tr>
                                    <td align=\"left\" style=\"color: #aaaaaa; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;\">
                                        <div style=\"line-height: 24px;\">

                                            <span style=\"color: #333333;\">Sana'a ArtisanPro</span>

                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <table border=\"0\" align=\"left\" width=\"5\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;\" class=\"container590\">
                                <tr>
                                    <td height=\"20\" width=\"5\" style=\"font-size: 20px; line-height: 20px;\">&nbsp;</td>
                                </tr>
                            </table>

                            <table border=\"0\" align=\"right\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;\" class=\"container590\">

                                <tr>
                                    <td align=\"center\">
                                        <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
                                            <tr>
                                                <td align=\"center\">
                                                    <a style=\"font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;color: #5caad2; text-decoration: none;font-weight:bold;\" href=\"{{UnsubscribeURL}}\">UNSUBSCRIBE</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>

        <tr>
            <td height=\"25\" style=\"font-size: 25px; line-height: 25px;\">&nbsp;</td>
        </tr>

    </table>
    <!-- end footer ====== -->

</body>

</html>;
";
$mail->AltBody = "artisanpro.ng";

if(!$mail->Send()){
echo "essage Can not be sent";
} 
                  
                  
                  
                  
                 $_SESSION['name'] = $fname;
                   $_SESSION['logging'] =TRUE;
                  $_SESSION['pstate'] = $pstate;
                   $_SESSION['plocal'] = $plocal;
                  $_SESSION['address'] = $address;
                  $_SESSION['phone'] = $phone;
                   $_SESSION['state']=$state;
                 $_SESSION['comp_name'] = $companyName;
                     $_SESSION['email']=$email;
                     $_SESSION['employerId'] =  $employer;
                     
                     
                     
                     
                     
                     
                     
                     
                 
    
            header('location:../account/');
                    
               }


        }
        
    
}
}
        }
        catch(PDOException $e){
            $returnData = msg(0,500,'fail',$e->getMessage());
        }
    


echo json_encode($returnData);