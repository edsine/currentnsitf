<?
session_start();
if(!isset($_SESSION['logging'])){
    header("location:../");
}

require_once '../classes/manage.php';
$query = new Manage();

 $conn = new mysqli('178.159.5.249', 'nsitfmai_ebs2', 'ebs@nsitf', 'nsitfmai_essp');
 
 $rrr = $_SESSION['rrr'];
 $type = $_SESSION['pay_type'] ;
  $amount = $_SESSION['ramount'];
  
  $lastInvoice =  $_SESSION['rinvoice']  ;

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
                  
                <div class="col-lg-8 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-9">
                        <div class="card-body" style="">
                 
                           <h5 class="card-title " style="font-size:20px;font-weight:bold; color:black;"> RRR: <?php echo  $rrr ?></h5>
                           <h5 class="card-title " style="font-size:20px;font-weight:bold; color:black;">Invoice No: <?php echo $lastInvoice ?> </h5>
                           <h5 class="card-title " style="font-size:20px;font-weight:bold; color:black;">Amount: <?php echo $amount ?></h5>
                          
                          <form onsubmit="makePayment()" id="payment-form">
  
       
            
            <input type="hidden" id="js-firstName" value="checking" name="firstName" class="field-divided" placeholder="First"/>&nbsp;
            <input type="hidden" id="js-lastName" name="rrr" value="<?php echo $rrr ?>"   class="field-divided" placeholder="Last"/>
        
            <input type="hidden" id="js-email" value="local@gmail.com" name="email" value class="field-long"/>
        
            <input type="hidden" id="js-narration" value="local saying" name="narration" class="field-long"/>
        
            <input type="hidden" id="js-amount" value="20000" name="amount" class="field-long"/>
       
        
         <fieldset class="form-group row">
          <div class="col-sm-offset-3 col-sm-9">
            <button class="btn btn-secondary" style="background-color:#50664d; border-color:#50664d;" type="button" onclick="makePayment()"> Pay Now</button>  &nbsp; &nbsp;<a href="index" class="btn btn-secondary" style="background-color:#50664d; border-color:#50664d;" type="button" > Close</a>  
          </div>
          
          
        </fieldset>
    
</form>
                         
  
  
  <script>

  

    function makePayment() {
       var randomnumber = Math.floor(Math.random() * 1101233);
        var form = document.querySelector("#payment-form");
        var paymentEngine = RmPaymentEngine.init({
            key:"TlNJVEZ8NDEwOTU1Njl8ZGJjMWFkOGIwMjY4OGI1MmIzNWE5ZWIzZmI3OTYxOGEyZDM4NzIxNTI5YzBmMDRkMGRiYjFmMzA0NzUxYTRmMjAyZjQxMmM5ZWMyNzNiMzRmOGY4YTI1ZTlkOTE2MGMzOGZkNTlmYzU1ZTdlNWYzZTgzNDdhOGFlOWQxZGI0OTQ=",
            processRrr: true,
            transactionId: randomnumber, //you are expected to generate new values for the transactionId for each transaction processing.
            extendedData: { 
                customFields: [ 
                    { 
                        name: "rrr", 
                        value: form.querySelector('input[name="rrr"]').value, //rrr to be processed.
                    } 
                 ]
            },
            onSuccess: function (response) {
                
                $.ajax({
          url:"remita/verify_payment.php",
          method:'POST',
          dataType: "json",
		   data: {
             rrr:form.querySelector('input[name="rrr"]').value,
             reference:response.paymentReference,
            }, 
            
             success: function() {
                  window.location.href="view_payments"
                 
             }
                })
            
                console.log('callback Successful Response', response);
                
            },
            onError: function (response) {
                console.log('callback Error Response', response);
            },
            onClose: function () {
                console.log("closed");
            }
        });
         paymentEngine.showPaymentWidget();
    }


   
</script>
<script type="text/javascript" src="https://login.remita.net/payment/v1/remita-pay-inline.bundle.js"></script>                       
                         
                         
                         
                         

        </div>
                      </div>
                      <div class="col-sm-3 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          
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