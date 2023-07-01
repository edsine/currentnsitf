<?php 
session_start();

require_once '../classes/manage.php';
$query = new Manage();
$today = date('Y-m-d');






  $staff =   $_SESSION['staff'] ;


  
  $staffEmail = $query->getRow("select staffId, staff_email from staff_tb where staffId= $staff");
  
  
  $der =   $_SESSION['department'] ;
   $superv = $query->getRow("select staffId, staff_email from staff_tb where departmentId = $der and roles = 9");
  
  
  $email = $staffEmail['staff_email'];
  
   $superbEm =    $superv['staff_email'];
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
             
        
              <div class="row">
                <div class="col-md-12">
                  
                  <div class="card mb-4">
                    <h5 class="card-header">Leave Application</h5>
                    <!-- Account -->
                    
                    
                    <hr class="my-0" />
                    <div class="card-body">
                      <form id="formAccountSettings" action="processor/new_leave" method="POST"  enctype="multipart/form-data">
                          
                          <input type="hidden" name="staff" value="<?php echo  $staff ?>" />
                        <div class="row">
                            <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Select Leave Type</label>
                             <select  name="type" id="lastName" class="form-control" required autofocus/>
                    <option value="">Select Leave Type</option>
                     <?php
                                                                                        require_once "db.php";
                                                                                        $result = mysqli_query($conn,"SELECT * FROM types_leave where status =1 ");
                                                                                        while($row = mysqli_fetch_array($result)) {
                                                                                        ?>
                                                                                  <option value="<?php echo $row['leaveT_id'];?>"><?php echo $row["leave_name"];?></option>
<?php
}
?>
                                                                               
                    
                    </select>
                          </div>
                         
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label"></label>
                            <input
                              name=""
                            value="2021-06-18" id="html5-date-input"
                              class="form-control"
                              type="hidden"
                              
                              value=""
                              autofocus
                              required
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Date Resume From Last Leave</label>
                            <input
                              name="last_leave"
                            value="<?php echo $today; ?>" id="html5-date-input"
                              class="form-control"
                              type="date"
                              
                              value=""
                              autofocus
                              required
                            />
                          </div>
                         
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Date Requested To Commence Present Leave</label>
                            <input
                              name="new_leave"
                            value="<?php echo $today; ?>" id="html5-date-input"
                              class="form-control"
                              type="date"
                              
                              value=""
                              autofocus
                              required
                            />
                          </div>
                          
                          <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">Number Of Days</label>
                            <input
                              type="number"
                              class="form-control"
                              id="organization"
                              name="n_days"
                              placeholder="10"
                              value=""
                              required
                            />
                          </div>
                          
                     
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Home Address</label>
                            <textarea type="text" class="form-control" id="address" name="h_address" placeholder="Home Address" required /></textarea>
                          </div>
                          
                         
                          <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">House Number</label>
                            <input type="text" class="form-control" id="address" name="houseNum" placeholder="House Number" required/>
                          </div>
                 
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Street Name/Number</label>
                            <input type="text" class="form-control" id="address" name="st_number" placeholder="Street Name/Number" required/>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">District</label>
                            <input type="text" class="form-control" id="address" name="district" placeholder="District" required/>
                          </div>
                          
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Local Council</label>
                            <input type="text" class="form-control" id="address" name="lcouncil" placeholder="Local Council" required/>
                          </div>
                               
                           <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">State</label>
                            <input type="text" class="form-control" id="address" name="state" placeholder="State" required/>
                          </div>
                        
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="address" name="phone" placeholder="Phone Number" required/>
                          </div>
                          
                          
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Name Of Officer To Relieve</label>
                            <input type="text" class="form-control" id="address" name="officeR" placeholder="Officer to relive" required/>
                          </div>
                          
                          
                          
            
                         
                         <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Upload Signature</label>
                            <input class="form-control" type="file" name="sign" id="lastName"  accept="" required/>
                          </div>
                          
                         
                
                          
                          
                          
                        </div>
                        <div class="mt-2">
                          <button type="submit" style="background-color:#50664d; border-color:#50664d;" class="btn btn-primary me-2">Submit</button>
                          <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                  
                </div>
              </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
                    <?php include("components/footer.php"); ?>
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
