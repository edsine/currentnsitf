<?php
session_start();
if (!isset($_SESSION['admin-log'])) {
    header("location:../");
}

$account =  $_SESSION['role'];

$branch =  $_SESSION['fbranch'];

$staff_id = $_SESSION['staff'];

require_once '../classes/database.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();

$stmt = $conn->prepare("SELECT * FROM staff_tb WHERE staffId=:staff_id LIMIT 1");
$stmt->bindValue(':staff_id', $staff_id, PDO::PARAM_STR);
$stmt->execute();

if ($stmt->rowCount()) {
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $profile = $stmt->fetch();

    //get role
    require_once '../classes/manage.php';
    $query = new Manage();

    $myrol = $query->getRow("select * from roles where roles_id = $account");

    $profile_role = $myrol['role'];
} else {
    header("location: home");
}
?>
<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>NSITF EBS</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="" />

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

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="jquery/dataTables.bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    </link>

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

                <?php include("components/navbar.php"); ?>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">

                        <div class="container-xxl flex-grow-1 container-p-y">

                            <div class="row mb-4">
                                <div class="col-3">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <img src="../assets/img/avatars/11.png" alt="" srcset="" class="" style="width: 100%; max-width: 100% !important; height: auto !important; aspect-ratio: 3/3;border: solid 1px #eee;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="card">
                                        <div class="card-header">
                                            <h2>My Profile</h2>
                                            <hr>
                                        </div>
                                        <div class="card-body">

                                            <div class="row mb-3">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label class="label">First Name:</label>
                                                        <span class="form-control"><?= $profile['firstname'] ?? '&nbsp;' ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label class="label">Middle Name:</label>
                                                        <span class="form-control"><?= $profile['middlename'] ?? '&nbsp;' ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label class="label">Last Name:</label>
                                                        <span class="form-control"><?= $profile['lastname'] ?? '&nbsp;' ?></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label class="label">Gender:</label>
                                                        <span class="form-control"><?= $profile['gender'] ?? '&nbsp;' ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label class="label">Email:</label>
                                                        <span class="form-control"><?= $profile['staff_email'] ?? '&nbsp;' ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label class="label">Phone:</label>
                                                        <span class="form-control"><?= $profile['phone'] ?? '&nbsp;' ?></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="">Role:</label>
                                                        <span class="form-control"><?= $profile_role ?? '&nbsp;' ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="">Branch - Region:</label>
                                                        <span class="form-control"><?= $profile['branch'] ?? '&nbsp;' ?> - <?= $profile['region'] ?? '&nbsp;' ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="">Status:</label>
                                                        <span class="form-control"><?= $profile['STATUS'] ?? '&nbsp;' ?></span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
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


    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/5c5aed266cb1ff3c14cb5c37/default';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
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