<?php 
session_start();

require_once '../classes/manage.php';
$query = new Manage();



$dtaId= $_GET['staff'];

$role = $_SESSION['role'];



$emps = $query->getRow("select a.*, b.* from dta_request as a, staff_tb as b where a.staffId= b.staffId and a.dta_id =$dtaId ");


$reviews = $query->getRows("select * from dta_review where dtaId =$dtaId ");



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
             
        <?php if($role == 9) {?>
              <div class="row">
                <div class="col-md-12">
                  
                  <div class="card mb-4">
                    <h5 class="card-header">DTA Application Supervisor Review/Approval</h5>
                    <!-- Account -->
                    
                    
                    <hr class="my-0" />
                    <div class="card-body">
                      <form id="formAccountSettings" action="processor/dta_review_val" method="POST" >
                          
                       
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">STAFF FULLNAME</label>
                            <input
                    
                            value="<?php echo $emps['firstname'].' '.$emps['middlename'].'  '.$emps['lastname'] ?>" id="html5-date-input"
                              class="form-control"
                              type="text"
                              disabled
                              
                              value=""
                              autofocus
                            />
                          </div>
                          
                           <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">PURPOSE OF TRAVEL</label>
                            <input
                  
                            value="<?php echo $emps['purpose_travel'] ?>" id="html5-date-input"
                              class="form-control"
                              type="text"
                              disabled
                            
                              autofocus
                            />
                          </div>
                         
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">TRAVEL DESTINATION</label>
                            <input
            
                            value="<?php echo $emps['destination'] ?>" id="html5-date-input"
                              class="form-control"
                              type="text"
                              disabled
                            
                              autofocus
                            />
                          </div>
                          
                          <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">NUMBER OF DAYS</label>
                            <input
                              type="number"
                              class="form-control"
                              id="organization"
               
                              placeholder="Number of days"
                              value="<?php echo $emps['number_days'] ?>"
                                   disabled
                            />
                          </div>
                          
                          
                          <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">TRAVEL DATE</label>
                            <input
                              type="text"
                              class="form-control"
                              id="organization"
                  
                              placeholder="Number of days"
                              value="<?php echo $emps['travel_date'] ?>"
                                   disabled
                            />
                          </div>
                          
                          
                          <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">ARRIVAL DATE</label>
                            <input
                              type="date"
                              class="form-control"
                              id="organization"
              
                              placeholder="Number of days"
                              value="<?php echo $emps['arrival_date'] ?>"
                                   disabled
                            />
                          </div>
                          
                     <hr/>
                     <hr/>
                  
                     <input type="hidden" name="officer" value="<?php echo $staff; ?>">
                      <input type="hidden" name="dtaId" value="<?php echo $dtaId; ?>">
                      
                       <input type="hidden" name="review" value="sp">
                     
                       
                          <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Supervisor Comment</label>
                            <textarea type="text" class="form-control" id="address" name="comment" placeholder="House Number" ></textarea>
                          </div>
                 
                          
                          
                        </div>
                        <div class="mt-2">
                          <button type="submit" style="background-color:#50664d; border-color:#50664d;" class="btn btn-primary me-2">Submit</button>
                          <button type="reset" class="btn btn-outline-secondary">Decline</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                  
                </div>
              </div>
            </div>
             <?php }elseif($role == 3){ ?>
             
                           <div class="row">
                <div class="col-md-12">
                  
                  <div class="card mb-4">
                    <h5 class="card-header">DTA Application HOD Review/Approval</h5>
                    <!-- Account -->
                    
                    
                    <hr class="my-0" />
                    <div class="card-body">
                      <form id="formAccountSettings" action="processor/dta_review_val" method="POST" >
                          
                       
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">STAFF FULLNAME</label>
                            <input
                    
                            value="<?php echo $emps['firstname'].' '.$emps['middlename'].'  '.$emps['lastname'] ?>" id="html5-date-input"
                              class="form-control"
                              type="text"
                              disabled
                              
                              value=""
                              autofocus
                            />
                          </div>
                          
                           <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">PURPOSE OF TRAVEL</label>
                            <input
                  
                            value="<?php echo $emps['purpose_travel'] ?>" id="html5-date-input"
                              class="form-control"
                              type="text"
                              disabled
                            
                              autofocus
                            />
                          </div>
                         
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">TRAVEL DESTINATION</label>
                            <input
            
                            value="<?php echo $emps['destination'] ?>" id="html5-date-input"
                              class="form-control"
                              type="text"
                              disabled
                            
                              autofocus
                            />
                          </div>
                          
                          <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">NUMBER OF DAYS</label>
                            <input
                              type="number"
                              class="form-control"
                              id="organization"
               
                              placeholder="Number of days"
                              value="<?php echo $emps['number_days'] ?>"
                                   disabled
                            />
                          </div>
                          
                          
                          <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">TRAVEL DATE</label>
                            <input
                              type="text"
                              class="form-control"
                              id="organization"
                  
                              placeholder="Number of days"
                              value="<?php echo $emps['travel_date'] ?>"
                                   disabled
                            />
                          </div>
                          
                          
                          <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">ARRIVAL DATE</label>
                            <input
                              type="date"
                              class="form-control"
                              id="organization"
              
                              placeholder="Number of days"
                              value="<?php echo $emps['arrival_date'] ?>"
                                   disabled
                            />
                          </div>
                          
                     <hr/>
                     <hr/>
                     
                       <h6 class="card-header">Supervisor Review & Comment</h6>
                       
                       
                  
                     <input type="hidden" name="officer" value="<?php echo $staff; ?>">
                      <input type="hidden" name="dtaId" value="<?php echo $dtaId; ?>">
                      
                       <input type="hidden" name="review" value="hd">
                     
                       
                          <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">HOD Comment</label>
                            <textarea type="text" class="form-control" id="address" name="comment" placeholder="House Number" ></textarea>
                          </div>
                 
                          
                          
                        </div>
                        <div class="mt-2">
                          <button type="submit" style="background-color:#50664d; border-color:#50664d;" class="btn btn-primary me-2">Submit(Approve forward to MD/ED)</button>
                          <button type="reset" class="btn btn-outline-secondary">Decline</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                  
                </div>
              </div>
            </div>
            <?php }elseif($role == 1){ ?>
            
                      <div class="row">
                <div class="col-md-12">
                  
                  <div class="card mb-4">
                    <h5 class="card-header">DTA Application MD/ED Review/Approval</h5>
                    <!-- Account -->
                    
                    
                    <hr class="my-0" />
                    <div class="card-body">
                      <form id="formAccountSettings" action="processor/dta_review_val" method="POST" >
                          
                       
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">STAFF FULLNAME</label>
                            <input
                    
                            value="<?php echo $emps['firstname'].' '.$emps['middlename'].'  '.$emps['lastname'] ?>" id="html5-date-input"
                              class="form-control"
                              type="text"
                              disabled
                              
                              value=""
                              autofocus
                            />
                          </div>
                          
                           <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">PURPOSE OF TRAVEL</label>
                            <input
                  
                            value="<?php echo $emps['purpose_travel'] ?>" id="html5-date-input"
                              class="form-control"
                              type="text"
                              disabled
                            
                              autofocus
                            />
                          </div>
                         
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">TRAVEL DESTINATION</label>
                            <input
            
                            value="<?php echo $emps['destination'] ?>" id="html5-date-input"
                              class="form-control"
                              type="text"
                              disabled
                            
                              autofocus
                            />
                          </div>
                          
                          <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">NUMBER OF DAYS</label>
                            <input
                              type="number"
                              class="form-control"
                              id="organization"
               
                              placeholder="Number of days"
                              value="<?php echo $emps['number_days'] ?>"
                                   disabled
                            />
                          </div>
                          
                          
                          <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">TRAVEL DATE</label>
                            <input
                              type="text"
                              class="form-control"
                              id="organization"
                  
                              placeholder="Number of days"
                              value="<?php echo $emps['travel_date'] ?>"
                                   disabled
                            />
                          </div>
                          
                          
                          <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">ARRIVAL DATE</label>
                            <input
                              type="date"
                              class="form-control"
                              id="organization"
              
                              placeholder="Number of days"
                              value="<?php echo $emps['arrival_date'] ?>"
                                   disabled
                            />
                          </div>
                          
                     <hr/>
                     <hr/>
                     
                       <h6 class="card-header">Supervisor, HOD Reviews & Comment</h6>
                       
                       <?php foreach($reviews  as $row) {?>
                      
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Comments</label>
                            <textarea disabled type="text" class="form-control" id="address" name="comment" placeholder="<?php echo $row['comments']  ?>" value="" ></textarea>
                          </div>
                 
                      
                        
                        <?php } ?>
                       
                  
                     <input type="hidden" name="officer" value="<?php echo $staff; ?>">
                      <input type="hidden" name="dtaId" value="<?php echo $dtaId; ?>">
                      
                       <input type="hidden" name="review" value="md">
                     
                       
                          <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">MD/ED Comment</label>
                            <textarea type="text" class="form-control" id="address" name="comment" placeholder="House Number" ></textarea>
                          </div>
                 
                          
                          
                        </div>
                        <div class="mt-2">
                          <button type="submit" style="background-color:#50664d; border-color:#50664d;" class="btn btn-primary me-2">Submit(Approve forward to MD/ED)</button>
                          <button type="reset" class="btn btn-outline-secondary">Decline</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                  
                </div>
              </div>
            </div>
            <?php }elseif($role == 4) {?>
               <div class="row">
                <div class="col-md-12">
                  
                  <div class="card mb-4">
                    <h5 class="card-header">DTA Application MD/ED Review/Approval</h5>
                    <!-- Account -->
                    
                    
                    <hr class="my-0" />
                    <div class="card-body">
                      <form id="formAccountSettings" action="processor/dta_review_val" method="POST" >
                          
                       
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">STAFF FULLNAME</label>
                            <input
                    
                            value="<?php echo $emps['firstname'].' '.$emps['middlename'].'  '.$emps['lastname'] ?>" id="html5-date-input"
                              class="form-control"
                              type="text"
                              disabled
                              
                              value=""
                              autofocus
                            />
                          </div>
                          
                           <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">PURPOSE OF TRAVEL</label>
                            <input
                  
                            value="<?php echo $emps['purpose_travel'] ?>" id="html5-date-input"
                              class="form-control"
                              type="text"
                              disabled
                            
                              autofocus
                            />
                          </div>
                         
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">TRAVEL DESTINATION</label>
                            <input
            
                            value="<?php echo $emps['destination'] ?>" id="html5-date-input"
                              class="form-control"
                              type="text"
                              disabled
                            
                              autofocus
                            />
                          </div>
                          
                          <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">NUMBER OF DAYS</label>
                            <input
                              type="number"
                              class="form-control"
                              id="organization"
               
                              placeholder="Number of days"
                              value="<?php echo $emps['number_days'] ?>"
                                   disabled
                            />
                          </div>
                          
                          
                          <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">TRAVEL DATE</label>
                            <input
                              type="text"
                              class="form-control"
                              id="organization"
                  
                              placeholder="Number of days"
                              value="<?php echo $emps['travel_date'] ?>"
                                   disabled
                            />
                          </div>
                          
                          
                          <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">ARRIVAL DATE</label>
                            <input
                              type="date"
                              class="form-control"
                              id="organization"
              
                              placeholder="Number of days"
                              value="<?php echo $emps['arrival_date'] ?>"
                                   disabled
                            />
                          </div>
                          
                     <hr/>
                     <hr/>
                     
                       <h6 class="card-header">Supervisor, HOD Reviews & Comment</h6>
                       
                       <?php foreach($reviews  as $row) {?>
                      
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Comments</label>
                            <textarea disabled type="text" class="form-control" id="address" name="comment" placeholder="<?php echo $row['comments']  ?>" value="" ></textarea>
                          </div>
                 
                      
                        
                        <?php } ?>
                       
                  
                     <input type="hidden" name="officer" value="<?php echo $staff; ?>">
                      <input type="hidden" name="dtaId" value="<?php echo $dtaId; ?>">
                      
                       <input type="hidden" name="review" value="ac">
                     
                       
                          <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Account Comment</label>
                            <textarea type="text" class="form-control" id="address" name="comment" placeholder="House Number" ></textarea>
                          </div>
                 
                          
                          
                        </div>
                        <div class="mt-2">
                          <button type="submit" style="background-color:#50664d; border-color:#50664d;" class="btn btn-primary me-2">Approve Payments</button>
                 
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                  
                </div>
              </div>
            </div>
            
            <?php } ?>
            
            
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
