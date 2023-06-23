<?
session_start();
if(!isset($_SESSION['logging'])){
    header("location:../");
}

require_once '../classes/manage.php';
$query = new Manage();

 $conn = new mysqli('178.159.5.249', 'nsitfmai_ebs2', 'ebs@nsitf', 'nsitfmai_essp');
 


require("PHPMailer_5.2.0/class.phpmailer.php");
require("PHPMailer_5.2.0/class.smtp.php");
require("PHPMailer_5.2.0/class.pop3.php");
 
  $mail = new PHPMailer();
  

$employer = $_SESSION['employerId'] ;

//echo $employer;

$paymentDetails = $query->getRow("select * from employer_tb  where employer_id = $employer"); 

//$regFee = $query->getRow("select p_typeId,  payment_name, amount from payment_type  where p_typeId = 1"); 



$company = $paymentDetails['company_name'];

$pemail = $paymentDetails['c_email'];
$phone = $paymentDetails['desk_phone'];
$lastName = $paymentDetails['desk_surname'];
$branch = $paymentDetails['branchId'];
$inspection = $paymentDetails['inspection_status'];





  


$employeeNum = $query->getRow("select count(employee_id) as recCount from employees where employer_id= $employer"); 


$checkTr = $query->getRow("select * from transactions where employerId= $employer and payment_type=1"); 

$val = $checkTr['payment_status'] ;



if (isset($_POST['gone'])) {
    
          // $_SESSION['paid'] = TRUE;
           
           $employer = $_SESSION['employerId'] ;
           $paymentType = 1 ;
           $amount = 20000;
           $status = 1;
           $time = date("Y/m/d");
           
           $ciemail = "nmibrahim19@gmail.com";
                
                 //$password = $query->validateString($_POST['pass']);
                 
                    $password1 = rand(10000000,99999999);
                  $password = password_hash($password1, PASSWORD_BCRYPT);
                  
                 
                  $pin = rand(100000,999999);
                  $Hashpin =  base64_encode($pin);
              
                    
                       //    $pend = 1;
    
    $_SESSION['paid'] = TRUE;
   //   $farmID = $query->getToken(12);
        
       $query1 = "INSERT INTO transactions SET employerId=?, payment_type = ?,payment_reference = ?, payment_status=?, amount=?, payment_time=? ";
        $stmt = $conn->prepare($query1);
        $stmt->bind_param('ssssss', $employer, $paymentType, $password, $status, $amount, $time );
        $result = $stmt->execute();
        
        
        
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

$mail->Subject = "ECS PAYMENT ,";

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

                             REGISTRATION <span style=\"color: #5caad2;\">PAYMENT RECEIPT</span>

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
$mail->AltBody = "nsitf.gov.ng";

if(!$mail->Send()){
echo "essage Can not be sent";
} 


$msg='<script type="text/javascript">alert("Your registration fee payment is succesful");</script>';
            
            
        }}


//$uploadCount = $query->getRow("select count(rc_uploadId) as upCount from upload_requirement where artisan_id = $artisan"); 

$numEmployees = $employeeNum['recCount'];
//$ucount = $uploadCount['upCount'];

//$prequest = $query->getRows("select a.*, b.* from service_request as a, states as b where a.clientId = b.id and  a.artisanId=$artisan");

?>
<!DOCTYPE html>


<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Employer Account</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/img/logo1.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->
    
    
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="jquery/dataTables.bootstrap.min.css" />
  <link rel="stylesheet" type="text/css"    href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css"></link>

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <?php include("components/sidebar.php") ?>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

        <?php include("components/navbar.php") ?>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
   <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                  <?php if($val == 0){ ?>
                <div class="col-lg-8 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-9">
                        <div class="card-body" style="">
                          <h5 class="card-title " style="font-size:20px;font-weight:bold; color:black;"> <?php echo $_SESSION['comp_name'] ?><br> Welcome to NSITF Employer Self Service Dashboard  </h5>
                          <p class="mb-4" style="font-size:18px;">
                            Complete  <span class="fw-bold">N20,000 registration fee payment </span>
                          </p>
                          
                          
                           <form class="form" id="pay-form" method="post" action="">
       
       
         
            <input class="form-control" id="firstname" value="<?php echo $company ?>" type="hidden" placeholder="Your First name (optional)" />
        
       
            <input class="form-control" value="<?php echo $lastName ?>" id="lastname" type="hidden" placeholder="Your Last name (optional)" />
         
       
            <input class="form-control" id="email" value="<?php echo $pemail ?>" required="required" type="hidden" placeholder="Your Email Address" />
         
    
         
          
              <input class="form-control" value="20000" id="amount-in-naira" required="required" type="hidden" step="100" placeholder="Amount" />
              
        
        <fieldset class="form-group row">
          <div class="col-sm-offset-3 col-sm-9">
            <button class="btn btn-secondary" type="button" onclick="validateAndPay()"> Pay Now</button>  Or  <button class="btn btn-secondary" type="submit" name="gone"> Verify Payment </button>
          </div>
          
          
        </fieldset>
        
          
 
      </form>
         
                    
                    
                      
    <script src="https://js.paystack.co/v1/inline.js"></script>
<script src="payments/cv.js"></script>

        </div>
                      </div>
                      <div class="col-sm-3 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php }else{
                
                
                
?>

     <div class="col-lg-8 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-9">
                        <div class="card-body" style="">
                          <h5 class="card-title " style="font-size:20px;font-weight:bold; color:black;">NISTF  Employer Dashboard  </h5>
                          <p class="mb-4" style="font-size:18px;">
                            Registration fee payment was successful</span>
                          </p>
                          
                          
                          
                          <?php if($inspection == 0){ ?>
                          <p class="mb-4" style="font-size:18px; color:orange;">
                            <span style="color:green">NOTE</span>: Your ECS company Inspection status is pending</span>
                          </p>
                          
                          <?php } ?>
                          
                          
                           <form class="form" id="pay-form" method="post" action="">
       
       
         
            <input class="form-control" id="firstname" value="<?php echo $company ?>" type="hidden" placeholder="Your First name (optional)" />
        
       
            <input class="form-control" value="<?php echo $lastName ?>" id="lastname" type="hidden" placeholder="Your Last name (optional)" />
         
       
            <input class="form-control" id="email" value="<?php echo $pemail ?>" required="required" type="hidden" placeholder="Your Email Address" />
         
    
         
          
              <input class="form-control" value="20000" id="amount-in-naira" required="required" type="hidden" step="100" placeholder="Amount" />
              
        
          
 
      </form>
         
                    
                    
                      
    <script src="https://js.paystack.co/v1/inline.js"></script>
<script src="payments/cv.js"></script>

        </div>
                      </div>
                      <div class="col-sm-3 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


<?php  } ?>
                <div class="col-lg-4 col-md-4 order-1">
                  <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                             <img
                                src="../assets/img/icons/unicons/wallet-info.png"
                                alt="Credit Card"
                                class="rounded"
                              />
                            </div>
                           
                          </div>
                          <span class="fw-semibold d-block mb-1">EMPLOYEES</span>
                          <h3 class="card-title mb-2"><?php echo $numEmployees ?></h3>
                          <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +0.80%</small>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="../assets/img/icons/unicons/wallet-info.png"
                                alt="Credit Card"
                                class="rounded"
                              />
                            </div>
                            
                          </div>
                          <span>AMOUNT PAID</span>
                          <h3 class="card-title text-nowrap mb-1">0</h3>
                          <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +0.0%</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Total Revenue -->
                <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                  <div class="card">
                    <div class="row row-bordered g-0">
                      <div class="col-md-8">
                        <h5 class="card-header m-0 me-2 pb-3">Your Payments</h5>
                        <div id="totalRevenueChart" class="px-2"></div>
                      </div>
                      <div class="col-md-4">
                        
                        <div id="growthChart"></div>
                        <div class="text-center fw-semibold pt-3 mb-2">62% Company Growth <? echo $branch ?></div>

                        <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                          <div class="d-flex">
                            <div class="me-2">
                              <span class="badge bg-label-primary p-2"><i class="bx  text-primary"></i></span>
                            </div>
                            <div class="d-flex flex-column">
                              <small>2022</small>
                              <h6 class="mb-0">32.5k</h6>
                            </div>
                          </div>
                          <div class="d-flex">
                            <div class="me-2">
                              <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
                            </div>
                            <div class="d-flex flex-column">
                              <small>2021</small>
                              <h6 class="mb-0">41.2k</h6>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Total Revenue -->
                
              </div>
              <div class="row">
                <!-- Order Statistics -->
                
                
                    <?php include("components/employee_list.php")  ?>
                
              
              </div>
            </div>
            <!-- / Content -->

    <?php include("components/footer.php") ?>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

   

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- Datatables -->
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<!-- Bootstrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
      $(document).ready(function() {
        $('#tabulka_kariet1').DataTable();
      });
    </script>
    
    
   
<? echo $msg; ?>

</html>