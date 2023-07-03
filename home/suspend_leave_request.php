<?php
session_start();
if(!isset($_SESSION['admin-log'])){
    header("location:../");

}
require_once '../classes/manage.php';
$query = new Manage();




$leaveId= $_GET['cert'];

$staff = $_SESSION['staff'];
$logged_in_user = $query->getRow("select roles as role from staff_tb where staffId = $staff"); 
$logged_in_user_role = $logged_in_user["role"]; /*The role of the user reviewing the leave request*/

$comp = $query->getRow("select a.*, b.* ,c.* from leave_request as a, staff_tb as b, types_leave as c where a.staff_id = b.staffId and a.type = c.leaveT_id and a.leaveId =$leaveId "); 

$user_role = $comp["roles"];

//$empNumm = $query->getRow("select count(*) as totalEmp from employees where employer_id = $leaveId"); 

//$numbeOfemp = $empNumm['totalEmp'];
//$comp_nam= $comp['company_name'];
//$ecsnum = $comp['ecs'];
//$contactName = $comp['desk_surname']. ' ' .$comp['desk_firstname'];

echo $emp;




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

    <title>NSITF ebs new staff</title>

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
<?php include("components/sidebar.php"); ?>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

        <?php  include("components/navbar.php")?>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              
              <div class="row" style="font-weight:bold;">
                <!-- Order Statistics -->
                  <div class="" style="width:70%;">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                         <h3 class="mb-0">Would you like to proceed and suspend this leave request?</h3>
                        
                    
                      <p></p>
                   
                    </div>

                    <div class="card-body">
                        <br>
                      <form action="./processor/cancel_leave_request" method="POST" enctype="multipart/form-data">
                          
                    <p>Staff FullName : &nbsp;<?php echo $comp['firstname'].'&nbsp; '.$comp['lastname'].' &nbsp;'.$comp['middlename'] ?></p> 
                      <hr/>
                      
                       <h5 class="mb-0">Leave Info</h5>
                       <br>
                     <p>Last Leave :  <?php echo $comp['date_last_leave'] ?></p>
                     <p>Leave Comence Date : <?php echo $comp['date_start_new'] ?></p>
                       <p>Requested Number Of Days: <?php echo $comp['num_days'] ?></p>

                         <hr>
                        <?php if(isset($_SESSION['success'])){ ?>
                        <p style="font-size:18px; color:green;">Leave request sent successfully </p>
                        
                        <?php } ?>
                      <input type = "hidden" value="<?php echo $staff ?>" name="officer" />
                      
                        <input type = "hidden" value="sup" name="review" />
                      
                      <input type = "hidden" value="<?php echo $leaveId ?>" name="leaveId" />
                      <input type = "hidden" value="<?php echo $logged_in_user_role ?>" name="logged_in_user_role" />
                        <div class="mb-3">
                        <label for="defaultSelect" class="form-label">Remarks</label>
                        <textarea name="comment" id="" class="form-control" rows="3" cols="80"></textarea>
                      </div>

                        <button type="submit" class="btn btn-primary">Suspend</button>
                      </form>
                    </div>
                  </div>
                </div>
              
              </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
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
</html>
