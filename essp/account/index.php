<?
session_start();
if(!isset($_SESSION['logging'])){
    header("location:../");
}


 session_unset($_SESSION['done']);
  session_unset($_SESSION['pay_type']);
   session_unset($_SESSION['ramount']);
    session_unset($_SESSION['rinvoice']);
     session_unset($_SESSION['rrr']);
      session_unset($_SESSION['pecs']);
     
     

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


$_SESSION['val'] =$val;

$regFee = 20000;

 $_SESSION['pamount'] =$regFee ;
  $_SESSION['company'] =$company ;



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
                          
         
                          <form onsubmit="makePayment()" id="payment-form">
                          
                         
        
            <input type="hidden" id="js-firstName" value="checking" name="firstName" class="field-divided" placeholder="First"/>&nbsp;
            <input type="hidden" id="js-lastName" name="lastName" value="<?php echo $company ?>"  class="field-divided" placeholder="Last"/>
    
      
            <input type="hidden" id="js-email" value="<?php echo $phone ?>" name="phone" value class="field-long"/>
              <input type="hidden" id="js-email" value="<?php echo $pemail ?>" name="email" value class="field-long"/>
        
        
            <input type="hidden" id="js-narration" value="Registration Fee" name="narration" class="field-long"/>
      
           
            <input type="hidden" id="js-amount" value="<?php echo $regFee ?>" name="amount" class="field-long"/>
      
       
        
        
        
         <fieldset class="form-group row">
          <div class="col-sm-offset-3 col-sm-9">
            <button class="btn btn-secondary" type="button" onclick="makePayment()" value="Pay"> Generate Invoice (Remita RRR)</button> 
          </div>
          
          
        </fieldset>
    
</form>
                    
                    
  
 <script>



  function makePayment() {
      
      var form = document.querySelector("#payment-form");
      

const newValues = {
			amount:form.querySelector('input[name="amount"]').value,
			payerName:form.querySelector('input[name="lastName"]').value,
			payerEmail:form.querySelector('input[name="email"]').value,
			payerPhone:form.querySelector('input[name="phone"]').value,
			description:form.querySelector('input[name="narration"]').value,
		};
	
$.ajax({
          url: "remita/generateInvoice.php",
          method:'POST',
          dataType: "json",
		  data: newValues ,
          beforeSend: function() {
          alert('loading... Genarating Remita RRR, click OK to continue ');
         },
          success: function(data) {
              
             
              
			 
            var datas1 = JSON.parse(JSON.stringify(data));
            alert(
             "RRR Generated:"+datas1.RRR+" Click Ok to save Invoice and make payment"
             )
            
         //  window.location.href = encodeURIComponent("testR.php?pf="+datas1.RRR) 
         
           window.location.href="saveRRR.php?rrr="+datas1.RRR +"&type=1"
          //  window.location.replace("http://www.w3schools.com");

          },
          error: function(xhr, status, err) {
          alert('error// '+err);//test for unsuccessful ajax request
          console.log(err);
          }
       });
	   
  }
</script>
        </div>
                      </div>
                      <div class="col-sm-3 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php }elseif($val == 1){
                
                
                
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


<?php  }else{ ?>



<?php 


   $getRRR = $query->getRow("select * from transactions  where employerId = $employer and payment_type=1 "); 
   
   
   $rr =$getRRR['invoice_rrr'];
   $invoice =$getRRR['invoice_number'];
   
   $amount =$getRRR['amount'];
   
   
   
   $_SESSION['pay_type'] =1;
    $_SESSION['ramount'] =$amount;
  
   $_SESSION['rinvoice'] =  $invoice;
   
     $_SESSION['rrr']=$rr;

?>
                         <div class="col-lg-8 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-9">
                        <div class="card-body" style="">
                            <p class="mb-4" style="font-size:18px;">
                            Complete  <span class="fw-bold">N20,000 registration fee payment </span>
                          </p>
                          <h5 class="card-title " style="font-size:20px;font-weight:bold; color:black;">RRR Generated: <?php echo $rr ?></h5>

                         <h5 class="card-title " style="font-size:20px;font-weight:bold; color:black;">Invoice Number: <?php echo $invoice ?></h5>                          
                          
         
                          <form onsubmit="makePayment()" id="payment-form">

        
            <input type="hidden" id="js-firstName" value="checking" name="firstName" class="field-divided" placeholder="First"/>&nbsp;
            <input type="hidden" id="js-lastName" name="lastName" value="<?php echo $company ?>"  class="field-divided" placeholder="Last"/>
    
      
            <input type="hidden" id="js-email" value="<?php echo $phone ?>" name="email" value class="field-long"/>
        
        
            <input type="hidden" id="js-narration" value="Registration Fee" name="narration" class="field-long"/>
      
           
            <input type="hidden" id="js-amount" value="20000" name="amount" class="field-long"/>
      
       
        
        
        
         <fieldset class="form-group row">
          <div class="col-sm-offset-3 col-sm-9">
            <a href="pay_invoice" class="btn btn-secondary" type="button" > Pay Now</a> 
          </div>
          
          
        </fieldset>
    
</form>
                    
                    
  
 
        </div>
                      </div>
                      <div class="col-sm-3 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
<?php } ?>
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
                          <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +0.0%</small>
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