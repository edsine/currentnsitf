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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Employee Claim /</span></h4>

              <div class="row">
                <div class="col-md-12">
                  
                  <div class="card mb-4">
                   
                    <!-- Account -->
                    <div class="card-body">
                       <h5 class="card-header">More Info:</h5>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                      <form id="formAccountSettings" method="POST" onsubmit="return false">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Incident Date</label>
                            <input
                              name="indate"
                            value="2021-06-18" id="html5-date-input"
                              class="form-control"
                              type="date"
                              
                              value=""
                              autofocus
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Incident Time</label>
                            <input
                            
                            value="" id="html5-date-input"
                              class="form-control"
                              type="time"
                              name="intime"
                              value=""
                              autofocus
                            />
                          </div>
                         
                          
                          
                          
                          <h3>Employer Bank Details</h3>
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Employer Account Name</label>
                            <input type="text" class="form-control" id="address" name="emp1_name" placeholder="employer account name" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Employer Account Number</label>
                            <input type="text" class="form-control" id="address" name="emp1_number" placeholder="employer account name" />
                          </div>
                          
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Employer Bank</label>
                            <input type="text" class="form-control" id="address" name="emp1_bank" placeholder="employer Bank" />
                          </div>
                               
                           <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Account Details(Employee Sort Code)</label>
                            <input type="text" class="form-control" id="address" name="sort_code1" placeholder="Address" />
                          </div>
                          
                          <h3>Employee Bank Details</h3>
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Employer Account Name</label>
                            <input type="text" class="form-control" id="address" name="emp2_name" placeholder="Account Name" />
                          </div>
                          
                          
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Employer Account Number</label>
                            <input type="text" class="form-control" id="address" name="emp2_number" placeholder="Employee  account number" />
                          </div>
                          
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Employee Bank</label>
                            <input type="text" class="form-control" id="address" name="emp2_bank" placeholder="Employee Bank" />
                          </div>
                               
                           <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Account Details(Employee Sort Code)</label>
                            <input type="text" class="form-control" id="address" name="emp2_sort" placeholder="emp_sort" />
                          </div>
                         
                         
                         <p>Scan and upload the follwing files in pdf format: (CCF 01,CCF 02,CCF 03,CCF 04, CCF 05,CCF 06, MR 01 Police Report, Health Care Bills / Receipts / Invoices *) </p>
                         
                         <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Employee Letter (PDF only)</label>
                            <input class="form-control" type="file" name="allDoc" id="lastName" value="Doe" accept=".pdf" />
                          </div>
                          
                         
                        <div class="mt-2">
                          <button style="background-color:#50664d; border-color:#50664d;" type="submit" class="btn btn-primary me-2">Save changes</button>
                          <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                  <
                </div>
              </div>
            </div>
            
                    <?php include("components/footer.php"); ?>
       
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
