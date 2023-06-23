<?php session_start() ;?>
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

    <title>New Claim</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="" />

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

    <!-- Page CSS -->

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
                <div class="col-md-12">
                  
                  <div class="card mb-4">
                    <h5 class="card-header">Occupational Disease Claim Application</h5>
                    <!-- Account -->
                    
                    <hr class="my-0" />
                    <div class="card-body">
                      <form id="formAccountSettings" action="../processor/claim_proc" method="POST"  enctype="multipart/form-data">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">SELECT EMPLOYEE</label>
                            <select class="form-select" aria-label="Default select example" id="country-dropdown" name="employee">
  <option>-Select State-</option>                                 <?php
  
  $employer = $_SESSION['employerId'] ;
                                                                                        require_once "../db.php";
                                                                                        $result = mysqli_query($conn,"SELECT * FROM employees where employer_id =  $employer ");
                                                                                        while($row = mysqli_fetch_array($result)) {
                                                                                        ?>
                                                                                  <option value="<?php echo $row['employee_id'];?>"><?php echo $row["employee_surname"].' '.$row["employee_firstname"]. ' &nbsp;['.$row["employee_email"].']';?></option>
<?php
}
?>

                    <input type="hidden" name="employer" value="<?php echo $employer ?>">
                                                                                   
</select>
                          </div>
                         
                          <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Nature of Work</label>
                            <input class="form-control" type="text" name="lsalary" id="lastName" value="" placeholder="Nature of Work" />
                          </div>
                          
                          <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">Nature of Disease:</label>
                            <input
                              type="text"
                              class="form-control"
                              id="organization"
                              name="mcontribution"
                              placeholder="Nature of Disease"
                              value=""
                            />
                          </div>
                          
                          
                          
                           <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Date the disease diagnosed</label>
                            <input
                              name="inc_date"
                            value="2021-06-18" id="html5-date-input"
                              class="form-control"
                              type="date"
                              
                              value=""
                              autofocus
                            />
                          </div>
                          
                          
                          
                          
                          
                          
                          
                     
                          
                     
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Suspected cause of disease (State the agent(s) present in the work place and with which he/she had contact that caused the disease; see list of approved diseases and their responsible agent(s) as contained in the first schedule of the ECA for guidance)</label>
                            <textarea type="text" class="form-control" id="address" name="incident_desc" placeholder="Suspected cause of disease" /></textarea>
                          </div>
                          
                           <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label"> For how long was he exposed </label>
                            <input
                              name="inc_date"
                            value="2021-06-18" id=""
                              class="form-control"
                              type="number"
                               placeholder="Years"
                              value=""
                              autofocus
                            />
                            <br>
                            <input
                              name="inc_date"
                            value="2021-06-18" id=""
                              class="form-control"
                              type="number"
                              placeholder="Months"
                              value=""
                              autofocus
                            />
                            <br>
                             <input
                              name="inc_date"
                            value="" id=""
                              class="form-control"
                              type="number"
                              placeholder="days"
                              value=""
                              autofocus
                            />
                          </div>
                          
                          <hr>
                          <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Date Employee reported the disease (dd/mm/yyyy)</label>
                            <input
                              name="inc_date"
                            value="2021-06-18" id="html5-date-input"
                              class="form-control"
                              type="date"
                              
                              value=""
                              autofocus
                            />
                          </div>
                          
                          
                          
                             <div class="mb-3 col-md-6">
                                 
                            <label for="firstName" class="form-label">Did the Employee die as a result of the Occupational Disease?</label>  <br>
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                          <label class="form-check-label" for="flexRadioDefault1">
                              YES
                          </label>
                          
                          
                           <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                          <label class="form-check-label" for="flexRadioDefault2">
                          NO
                          </label>
                          
                          
                          
                          
                          </div>
                            <h4>If yes, name his registered dependant(s) with you: (Attach list if more than one dependent)
</h4>
                          <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Surname</label>
                            <input
                              name="inc_date"
                            value="2021-06-18" id="html5-date-input"
                              class="form-control"
                              type="text"
                              
                              value=""
                              autofocus
                            />
                          </div>
                          
                           <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">FirstName</label>
                            <input
                              name="inc_date"
                            value="2021-06-18" id="html5-date-input"
                              class="form-control"
                              type="text"
                              
                              value=""
                              autofocus
                            />
                          </div>
                          
                           <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Practice Number</label>
                            <input
                              name="inc_date"
                            value="2021-06-18" id="html5-date-input"
                              class="form-control"
                              type="text"
                              
                              value=""
                              autofocus
                            />
                          </div>
                          
                          
                          
                          
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Period in your employment (years)</label>
                            <input
                              name="inc_date"
                            value="2021-06-18" id="html5-date-input"
                              class="form-control"
                              type="number"
                              placeholder="Years "
                              
                              value=""
                              autofocus
                            />
                          </div>
                          
                          
                           <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Period in your employment (Months)</label>
                            <input
                              name="inc_date"
                            value="2021-06-18" id="html5-date-input"
                              class="form-control"
                              type="number"
                              placeholder="Months"
                              value=""
                              autofocus
                            />
                          </div>
                          
                          
                          
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Please, mention the name(s) and address(es) of former employers, if the employee did not contract the disease in your employment</label>
                            <input
                              name="inc_date"
                            value="2021-06-18" id="html5-date-input"
                              class="form-control"
                              type="number"
                              placeholder="write here"
                              value=""
                              autofocus
                            />
                          </div>
                 
                         
                          
                          
                          
                          
                          
                           
                               
                           
            
                         
                         <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Upload PDF File Here</label>
                            <input class="form-control" type="file" name="doc" id="lastName"  accept=".pdf" />
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

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/pages-account-settings-account.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
