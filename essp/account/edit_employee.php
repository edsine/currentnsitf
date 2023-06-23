<?php
session_start();

if (!isset($_SESSION['logging'])) {
    header('Location:../artisan');
    exit();
}

require_once '../classes/manage.php';
$query = new Manage();
$employer = $_GET['id'];

$employees = $query->getRow(
    "select * from employees where employee_id = $employer"
);
?>
<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Employer Account</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/img/logo1.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    </link>

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
            <?php include 'components/sidebar.php'; ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <?php include 'components/navbar.php'; ?>
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
                                            <div class="card-body" style="height:40%;">

                                                <p class="mb-4" style="font-size:18px;">
                                                    Employee Bulk Upload &nbsp; &nbsp; <a href="./assets/employees.xlsx">Download template</a>
                                                </p>

                                                <div class="card">
                                                    <h5 class="card-header"></h5>
                                                    <div class="card-body">
                                                        <div id="response" class="bg-success text-white"><?php if (!empty($_GET['message'])) {
                                                                                                                echo $_GET['message'];
                                                                                                            } ?></div>
                                                        <form action="../processor/addBulkEmployee.php" method="post" enctype="multipart/form-data">

                                                            <div class="mb-3">
                                                                <label for="formFile" class="form-label">Excel File only (xls,xlsx)</label>
                                                                <input class="form-control" name="file" type="file" id="formFile" accept=".xls,.xlsx" />
                                                            </div>
                                                            <button type="submit" class="btn btn" style="background-color:#50664d; border-color:#50664d; color:#fff;" name="import">upload</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 text-center text-sm-left">
                                            <div class="card-body pb-0 px-0 px-md-4">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 order-1">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <img src="../assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded" />
                                                    </div>

                                                </div>
                                                <span class="fw-semibold d-block mb-1">EMPLOYEES</span>
                                                <h3 class="card-title mb-2"><?php echo $numEmployees; ?></h3>
                                                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> 72,80</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <img src="../assets/img/icons/unicons/wallet-info.png" alt="Credit Card" class="rounded" />
                                                    </div>

                                                </div>
                                                <span>AMOUNT PAID</span>
                                                <h3 class="card-title text-nowrap mb-1">0</h3>
                                                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                        <div class="row">
                            <!-- Order Statistics -->

                            <div class="" style="width:50%;">
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Edit <?php echo $employees['employee_middlename']; ?> Employee</h5>
                                        <small class="text-muted float-end">kk</small>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" , action="../processor/new_employee">

                                            <input type="hidden" name="employer" value="<?php echo $employees['employerId']; ?>" class="form-control" id="basic-icon-default-fullname" placeholder="John Doe" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" />

                                            <div class="mb-3">
                                                <label class="form-label" for="basic-icon-default-fullname">First Name</label>
                                                <div class="input-group input-group-merge">

                                                    <input type="text" name="fname" value="<?php echo $employees['employee_firstname']; ?>" class="form-control" id="basic-icon-default-fullname" placeholder="John Doe" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" />
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="basic-icon-default-fullname">Middle Name</label>
                                                <div class="input-group input-group-merge">

                                                    <input type="text" name="mname" value="<?php echo $employees['employee_middlename']; ?>" class="form-control" id="basic-icon-default-fullname" placeholder="John Doe" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" />
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="basic-icon-default-fullname">Last Name</label>
                                                <div class="input-group input-group-merge">

                                                    <input name="lname" type="text" value="<?php echo $employees['employee_surname']; ?>" class="form-control" id="basic-icon-default-fullname" placeholder="John Doe" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" />
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="basic-icon-default-fullname">Address</label>
                                                <div class="input-group input-group-merge">

                                                    <input name="address" type="text" class="form-control" id="basic-icon-default-fullname" value="<?php echo $employees['employee_address']; ?>" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" />
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label for="html5-date-input" class="col-md-2 col-form-label">Date Of Birth</label>
                                                <div class="col-md-10">
                                                    <input name="dob" class="form-control" type="date" value="<?php echo $employees['dob']; ?>" id="html5-date-input" />
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="defaultSelect" class="form-label">Gender</label>
                                                <select name="gender" id="defaultSelect" class="form-select">
                                                    <option value="Male" <?php $employees['dob'] == 'Male'
                                                                                ? 'selected'
                                                                                : ''; ?>>Male</option>
                                                    <option value="Female" <?php $employees['dob'] ==
                                                                                'Female'
                                                                                ? 'selected'
                                                                                : ''; ?>>Female</option>

                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="defaultSelect" class="form-label">Marital Status</label>
                                                <select name="mstatus" id="defaultSelect" class="form-select">
                                                    <option value="Maried" <?php $employees['dob'] ==
                                                                                'Maried'
                                                                                ? 'selected'
                                                                                : ''; ?>>Married</option>
                                                    <option value="Single" <?php $employees['dob'] ==
                                                                                'Single'
                                                                                ? 'selected'
                                                                                : ''; ?>>Single</option>

                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="basic-icon-default-company">Work ID</label>
                                                <div class="input-group input-group-merge">

                                                    <input name="workId" type="text" id="basic-icon-default-company" class="form-control" value="<?php echo $employees['work_id']; ?>" aria-label="ACME Inc." aria-describedby="basic-icon-default-company2" />
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label for="html5-date-input" class="col-md-2 col-form-label">Employment Date</label>
                                                <div class="col-md-10">
                                                    <input name="emp_date" class="form-control" type="date" <?php echo $employees['employment_date']; ?> id="html5-date-input" />
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="basic-icon-default-email">Email</label>
                                                <div class="input-group input-group-merge">

                                                    <input value="<?php echo $employees['employee_email']; ?>" name="email" type="text" id="basic-icon-default-email" class="form-control" placeholder="john.doe" aria-label="john.doe" aria-describedby="basic-icon-default-email2" />
                                                    <span id="basic-icon-default-email2" class="input-group-text">@example.com</span>
                                                </div>

                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="basic-icon-default-company">Job Title</label>
                                                <div class="input-group input-group-merge">

                                                    <input name="jobT" type="text" id="basic-icon-default-company" class="form-control" value="<?php echo $employees['employee_email']; ?>" aria-label="ACME Inc." aria-describedby="basic-icon-default-company2" />
                                                </div>
                                            </div>




                                            <div class="mb-3">
                                                <label for="defaultSelect" class="form-label">State</label>
                                                <select class="form-select" aria-label="Default select example" id="country-dropdown" name="state">
                                                    <option>-Select State-</option> <?php
                                                                                    require_once '../db.php';
                                                                                    $result = mysqli_query($conn, 'SELECT * FROM states ');
                                                                                    while ($row = mysqli_fetch_array($result)) { ?>
                                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                                    <?php }
                                                    ?>

                                                </select>

                                            </div>

                                            <div class="mb-3">
                                                <label for="defaultSelect" class="form-label">Local Gvt</label>
                                                <select name="service" class="form-select" aria-label="Default select example" id="state-dropdown">

                                                </select>

                                            </div>



                                            <div class="mb-3">
                                                <label class="form-label" for="basic-icon-default-phone">Phone No</label>
                                                <div class="input-group input-group-merge">

                                                    <input type="text" name="phone" id="basic-icon-default-phone" class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-icon-default-phone2" />
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="basic-icon-default-phone">Alternate Phone</label>
                                                <div class="input-group input-group-merge">
                                                    <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-phone"></i></span>
                                                    <input name="altPhone" type="text" id="basic-icon-default-phone" class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-icon-default-phone2" />
                                                </div>
                                            </div>


                                            <div class="mb-3">
                                                <label for="defaultSelect" class="form-label">Mode of Identity</label>
                                                <select name="id_mode" id="defaultSelect" class="form-select">
                                                    <option value="National Identity Card">National Identity Card</option>
                                                    <option value="National Voters Card">National Voters Card</option>

                                                    <option>Driver Licence</option>
                                                    <option value="International Passport">International Passport</option>
                                                    <option value="Organisation ID">Organisation ID</option>

                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="basic-icon-default-company">Identity Number</label>
                                                <div class="input-group input-group-merge">

                                                    <input name="id_num" type="text" id="basic-icon-default-company" class="form-control" aria-label="ACME Inc." aria-describedby="basic-icon-default-company2" />
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label for="html5-date-input" class="col-md-2 col-form-label">Issue Date</label>
                                                <div class="col-md-10">
                                                    <input name="issue_date" class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
                                                </div>
                                            </div>


                                            <div class="mb-3">
                                                <label class="form-label" for="basic-icon-default-company">Next Kin</label>
                                                <div class="input-group input-group-merge">

                                                    <input name="nextkin" type="text" id="basic-icon-default-company" class="form-control" aria-label="ACME Inc." aria-describedby="basic-icon-default-company2" />
                                                </div>
                                            </div>


                                            <div class="mb-3">
                                                <label class="form-label" for="basic-icon-default-company">Next kin Number</label>
                                                <div class="input-group input-group-merge">

                                                    <input name="next_num" type="text" id="basic-icon-default-company" class="form-control" aria-label="ACME Inc." aria-describedby="basic-icon-default-company2" />
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="basic-icon-default-company">Dependants Number </label>
                                                <div class="input-group input-group-merge">

                                                    <input name="dpendant_num" type="text" id="basic-icon-default-company" class="form-control" aria-label="ACME Inc." aria-describedby="basic-icon-default-company2" />
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="basic-icon-default-company">Monthly Remuneration </label>
                                                <div class="input-group input-group-merge">

                                                    <input name="monhtly_rem" type="text" id="basic-icon-default-company" class="form-control" aria-label="ACME Inc." aria-describedby="basic-icon-default-company2" />
                                                </div>
                                            </div>


                                            <button type="submit" class="btn btn-primary">Add</button>
                                        </form>




                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <!-- / Content -->

                    <!-- Footer -->
                    <?php include 'components/footer.php'; ?>
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


<script>
    $(document).ready(function() {
        $('#country-dropdown').on('change', function() {
            var country_id = this.value;
            $.ajax({
                url: "../localGvt.php",
                type: "POST",
                data: {
                    country_id: country_id
                },
                cache: false,
                success: function(result) {
                    $("#state-dropdown").html(result);
                    $('#city-dropdown').html('<option value="">Select Local government</option>');
                }
            });
        });
        $('#states').on('change', function() {
            var state_id = this.value;
            $.ajax({
                url: "localGvt.php",
                type: "POST",
                data: {
                    state_id: state_id
                },
                cache: false,
                success: function(result) {
                    $("#local").html(result);
                }
            });
        });
    });
</script>

<script type="text/javascript" src="js/mdb.min.js"></script>
<!-- Custom scripts -->
<script type="text/javascript"></script>

</html>
