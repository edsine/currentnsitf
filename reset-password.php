<?php
session_start();
$hash = $_GET['hash'];

$_SESSION['error'] = $_SESSION['success'] = [];

if (isset($hash) && !empty($hash) && strlen($hash) == 36) {
  require_once 'classes/database.php';
  $db_connection = new Database();
  $conn = $db_connection->dbConnection();

  //test if hash is valid and get user
  $stmt = $conn->prepare("SELECT staffId, staff_email, security_key FROM staff_tb WHERE security_key LIKE :hash LIMIT 1");
  $stmt->bindValue(':hash', $hash . '%', PDO::PARAM_STR);
  $stmt->execute();

  if ($stmt->rowCount()) {
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetch();

    //get has and expiry date
    $sk = explode(',', $result['security_key']);
    $hash = $sk[0];
    $expDate = $sk[1];

    //set Email
    $staff_email = $result['staff_email'];

    //get and compare hash
    if ($hash !== md5($result['staff_email']) . substr($hash, -4, strlen($hash))) {
      $_SESSION['error'] = "Expired or Invalid reset link!";
      header("Location: forgot-password");
    }

    //if user has supplied new password credentials
    if (isset($_POST) && !empty($_POST)) {
      $new_pass = $_POST['new-password'];
      $con_pass = $_POST['confirm-password'];


      if (!$new_pass && !$con_pass) {
        //ensure fields are provided
        $_SESSION['error'] = "Password and confirmation is required!";
      } elseif (strlen($new_pass) < 6) {
        //passwords length
        $_SESSION['error'] = "Password must have at least 8 characters!";
      } elseif ($new_pass != $con_pass) {
        //equal passwords
        $_SESSION['error'] = "Password do not match!";
      } else {
        //update password
        $password = password_hash($new_pass, PASSWORD_DEFAULT);

        $update_query = "UPDATE staff_tb SET security_key=:hash WHERE staffId=:staff_id";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bindValue(':hash', $password, PDO::PARAM_STR);
        $update_stmt->bindValue(':staff_id', $result['staffId'], PDO::PARAM_STR);

        $result = $update_stmt->execute();
        if ($result) {
          $_SESSION['success'] = "Password has been reset successfully!";
          header("location: index");
          exit;
        } else {
          $_SESSION['error'] = "Error reseting password!";
        }
      }
    }
  } else {
    $_SESSION['error'] = "Expired or Invalid reset link!";
    header("location: forgot-password");
    exit;
  }
} else {
  $_SESSION['error'] = "Expired or Invalid reset link!";
  header("location: forgot-password");
  exit;
}

?>
<!DOCTYPE html>

<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>NSITF Forget Passoword</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <!-- Page CSS -->
  <!-- Page -->
  <link rel="stylesheet" href="assets/vendor/css/pages/page-auth.css" />
  <!-- Helpers -->
  <script src="assets/vendor/js/helpers.js"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="assets/js/config.js"></script>
</head>

<body>
  <!-- Content -->

  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-4">
        <!-- Forgot Password -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <a href="index.html" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                  <img src="ikl.png" style="width:100px;">
                </span>

              </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">Reset Password</h4>
            <p class="mb-4">Enter a password and confirm to reset your account <b>[<?= $staff_email ?>]</b></p>

            <?php if ($_SESSION['error']) : ?>
              <div class="alert alert-danger" role="danger">
                <?= $_SESSION['error'] ?>
              </div>
            <?php unset($_SESSION['error']);
            endif; ?>

            <?php if ($_SESSION['success']) : ?>
              <div class="alert alert-success" role="danger">
                <?= $_SESSION['success'] ?>
              </div>
            <?php unset($_SESSION['success']);
            endif; ?>

            <form id="formAuthentication" class="mb-3" action="" method="POST" autocomplete="off">
              <input type="hidden" name="staff_email" value="<?= $staff_email ?>">
              <div class="mb-3">
                <label for="new-password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="new-password" name="new-password" placeholder="Enter your new password" autofocus />
              </div>
              <div class="mb-3">
                <label for="confirm-password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm your new password" autofocus />
              </div>
              <button class="btn btn-primary d-grid w-100">Reset Password</button>
            </form>
            <div class="text-center">
              <a href="index" class="d-flex align-items-center justify-content-center">
                <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                Back to login
              </a>
            </div>
          </div>
        </div>
        <!-- /Forgot Password -->
      </div>
    </div>
  </div>

  <!-- / Content -->

  <div class="buy-now">
    <a href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/" target="_blank" class="btn btn-danger btn-buy-now">Upgrade to Pro</a>
  </div>

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="assets/vendor/libs/jquery/jquery.js"></script>
  <script src="assets/vendor/libs/popper/popper.js"></script>
  <script src="assets/vendor/js/bootstrap.js"></script>
  <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

  <script src="assets/vendor/js/menu.js"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->

  <!-- Main JS -->
  <script src="assets/js/main.js"></script>

  <!-- Page JS -->

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>