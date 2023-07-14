<?php
session_start();
if (!isset($_SESSION['admin-log'])) {
  header("location:../");
}
require_once '../classes/manage.php';
$query = new Manage();

$account =  $_SESSION['role'];
$der =   $_SESSION['department'];
$branch =  $_SESSION['fbranch'];
$staff = $_SESSION['staff'];


$depar = $query->getRow("select * from departments where department_id = $der");


$folders = $query->getRows("select * from dir_folders where createdBy= $staff");


$staff_files = $query->getRows("select * from document_manager where staffId = $staff limit 15");


$staffs = $query->getRows("select a.*, b.* from staff_tb as a, roles as b where a.roles=b.roles_id ");


$department = $depar['dep_unit'];

$_SESSION['path'] = $department;
?>
<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>EBS</title>

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




  <link rel="stylesheet" href="../fileStyle/css/dashlite.css?ver=3.1.3">
  <link id="skin-default" rel="stylesheet" href="../fileStyle/css/theme.css?ver=3.1.3">

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

          <div class="nk-content nk-content-" style="">
            <div class="container-xl wide-xl">
              <div class="nk-content-inner">
                <div class="nk-content-body">

                  <?php if ($_SESSION['error']) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="danger">
                      <?= $_SESSION['error'] ?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      </button>
                    </div>
                  <?php unset($_SESSION['error']);
                  endif; ?>

                  <?php if ($_SESSION['success']) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="danger">
                      <?= $_SESSION['success'] ?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <!-- <span aria-hidden="true">&times;</span> -->
                      </button>
                    </div>
                  <?php unset($_SESSION['success']);
                  endif; ?>

                  <div class="nk-fmg-body-head d-none d-lg-flex">
                    <div class="nk-fmg-search">
                      <em class="icon ni ni-search"></em>
                      <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search files, folders">
                    </div>
                    <div class="nk-fmg-actions">
                      <ul class="nk-block-tools g-3">
                        <li>
                          <div class="dropdown">
                            <!-- <a href="#" class="btn btn-light" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em> <span>Create</span></a> -->
                            <div class="dropdown-menu dropdown-menu-end">
                              <ul class="link-list-opt no-bdr">

                                <li><a href="#" data-toggle="modal" data-target="#create_folder"><em class="icon ni ni-upload-cloud"></em><span>Folder</span></a></li>
                                <li><a href="#"><em class="icon ni ni-file-plus"></em><span>Create File</span></a></li>
                                <li><a href="#"><em class="icon ni ni-folder-plus"></em><span>Create Folder</span></a></li>
                              </ul>
                            </div>
                          </div>
                        </li>
                        <a href="#" data-toggle="modal" data-target="#create_folder" class="btn btn-light"><em class="icon ni ni-plus"></em> <span>Create Folder</span></a>

                        &nbsp;
                        <a href="#" data-toggle="modal" data-target="#staff_list" class="btn btn-light"><em class="icon ni ni-share"></em> <span>Share File</span></a>

                        <li><a href="#file-upload" class="btn btn-primary" data-toggle="modal" data-target="#upload_doc"><em class="icon ni ni-upload-cloud"></em> <span>Upload</span></a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="nk-fmg-body-content">
                    <div class="nk-block-head nk-block-head-sm">
                      <div class="nk-block-between position-relative">
                        <div class="nk-block-head-content">
                          <h3 class="nk-block-title page-title">Directory: <?php echo  $department; ?></h3>

                        </div>

                        <div class="nk-block-head-content">
                          <ul class="nk-block-tools g-1">
                            <li class="d-lg-none">
                              <a href="#" class="btn btn-trigger btn-icon search-toggle toggle-search" data-target="search"><em class="icon ni ni-search"></em></a>
                            </li>
                            <li class="d-lg-none">
                              <div class="dropdown">
                                <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                <div class="dropdown-menu dropdown-menu-end">
                                  <ul class="link-list-opt no-bdr">
                                    <li><a href="#file-upload" data-bs-toggle="modal"><em class="icon ni ni-upload-cloud"></em><span>Upload File</span></a></li>
                                    <li><a href="#"><em class="icon ni ni-file-plus"></em><span>Create File</span></a></li>
                                    <li><a href="#"><em class="icon ni ni-folder-plus"></em><span>Create Folder</span></a></li>
                                  </ul>
                                </div>
                              </div>
                            </li>
                            <li class="d-lg-none me-n1"><a href="#" class="btn btn-trigger btn-icon toggle" data-target="files-aside"><em class="icon ni ni-menu-alt-r"></em></a></li>
                          </ul>
                        </div>
                        <div class="search-wrap px-2 d-lg-none" data-search="search">
                          <div class="search-content">
                            <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                            <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search by user or message">
                            <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                          </div>
                        </div><!-- .search-wrap -->
                      </div>
                    </div>
                    <div class="nk-fmg-quick-list nk-block">
                      <div class="nk-block-head-xs">
                        <div class="nk-block-between g-2">
                          <div class="nk-block-head-content">
                            <h6 class="nk-block-title title">Folders</h6>
                          </div>
                          <div class="nk-block-head-content">
                            <a href="#" class="link link-primary toggle-opt active" data-target="quick-access">
                              <!-- <div class="inactive-text">Show</div>
                                                            <div class="active-text">Hide</div> -->
                            </a>
                          </div>
                        </div>
                      </div><!-- .nk-block-head -->
                      <div class="toggle-expand-content expanded" data-content="quick-access">
                        <div class="nk-files nk-files-view-grid">
                          <div class="nk-files-list">
                            <?php foreach ($folders as $row) { ?>
                              <div class="nk-file-item nk-file">
                                <div class="nk-file-info">
                                  <a href="#" class="nk-file-link">
                                    <div class="nk-file-title">
                                      <div class="nk-file-icon">
                                        <span class="nk-file-icon-type">
                                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72">
                                            <g>
                                              <rect x="32" y="16" width="28" height="15" rx="2.5" ry="2.5" style="fill:#f29611" />
                                              <path d="M59.7778,61H12.2222A6.4215,6.4215,0,0,1,6,54.3962V17.6038A6.4215,6.4215,0,0,1,12.2222,11H30.6977a4.6714,4.6714,0,0,1,4.1128,2.5644L38,24H59.7778A5.91,5.91,0,0,1,66,30V54.3962A6.4215,6.4215,0,0,1,59.7778,61Z" style="fill:#ffb32c" />
                                              <path d="M8.015,59c2.169,2.3827,4.6976,2.0161,6.195,2H58.7806a6.2768,6.2768,0,0,0,5.2061-2Z" style="fill:#f2a222" />
                                            </g>
                                          </svg>
                                        </span>
                                      </div>
                                      <div class="nk-file-name">
                                        <div class="nk-file-name-text">
                                          <span class="title"><?php echo $row['folder_name'] ?></span>
                                        </div>
                                      </div>
                                    </div>
                                  </a>
                                </div>
                                <div class="nk-file-actions hideable">
                                  <a href="processor/document_delete.php?id=<?php echo $row['folder_id'] ?>&type=fol" class="btn btn-sm btn-icon btn-trigger"><em class="icon ni ni-cross"></em></a>
                                </div>
                              </div>
                            <?php } ?>


                          </div>
                        </div><!-- .nk-files -->
                      </div>
                    </div>


                    <div class="nk-fmg-listing nk-block-lg">
                      <div class="nk-block-head-xs">
                        <div class="nk-block-between g-2">
                          <div class="nk-block-head-content">
                            <h6 class="nk-block-title title">Recent Files</h6>
                          </div>
                          <?php
                          if (isset($_GET['suc'])) {
                            echo "<div class='alert alert-sucess'; role='alert'>Changes Updated Sucessfully</div>";
                          } else {
                            //nothing
                          }
                          ?>

                          <div class="nk-block-head-content">
                            <ul class="nk-block-tools g-3 nav">
                              <li><a data-bs-toggle="tab" href="#file-grid-view" class="nk-switch-icon"><em class="icon ni ni-view-grid3-wd"> </em></a></li>
                              <li><a data-bs-toggle="tab" href="#file-group-view" class="nk-switch-icon"><em class="icon ni ni-view-group-wd"> </em></a></li>
                              <li><a data-bs-toggle="tab" href="#file-list-view" class="nk-switch-icon active"><em class="icon ni ni-view-row-wd"></em></a></li>
                            </ul>
                          </div>
                        </div>
                      </div><!-- .nk-block-head -->
                      <div class="tab-content">
                        <!-- .tab-pane -->
                        <?php include("components/file_list.php"); ?>


                        <!-- .nk-files -->
                      </div><!-- .tab-pane -->


                    </div>




                    <div class="nk-fmg-listing nk-block-lg">
                      <div class="nk-block-head-xs">
                        <div class="nk-block-between g-2">
                          <div class="nk-block-head-content">
                            <h6 class="nk-block-title title">Shared Files</h6>
                          </div>
                          <div class="nk-block-head-content">
                            <ul class="nk-block-tools g-3 nav">
                              <li><a data-bs-toggle="tab" href="#file-grid-view" class="nk-switch-icon"><em class="icon ni ni-view-grid3-wd"></em></a></li>
                              <li><a data-bs-toggle="tab" href="#file-group-view" class="nk-switch-icon"><em class="icon ni ni-view-group-wd"></em></a></li>
                              <li><a data-bs-toggle="tab" href="#file-list-view" class="nk-switch-icon active"><em class="icon ni ni-view-row-wd"></em></a></li>
                            </ul>
                          </div>
                        </div>
                      </div><!-- .nk-block-head -->
                      <div class="tab-content">
                        <!-- .tab-pane -->


                        <?php include("components/shared_files.php"); ?>
                        <!-- .nk-files -->
                      </div><!-- .tab-pane -->


                    </div><!-- .nk-file -->
                    <!-- .nk-file -->
                    <!-- .nk-file -->

                  </div>
                </div><!-- .nk-files -->

              </div><!-- .nk-block -->
            </div><!-- .nk-fmg-body-content -->
          </div><!-- .nk-fmg-body -->
        </div><!-- .nk-fmg -->
      </div>
    </div>
  </div>
  </div>
  </div>
  <!-- / Content -->



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


  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

  <script src="./fileStyle/js/bundle.js?ver=3.1.3"></script>
  <script src="./fileStyle/js/scripts.js?ver=3.1.3"></script>
  <script src="./fileStyle/js/apps/file-manager.js?ver=3.1.3"></script>


  <div class="modal fade" id="upload_doc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Document</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <div style="width:85%; margin:0 auto; padding:20px;">

            <form action="./processor/doc_file.php" method="post" enctype="multipart/form-data">

              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Upload Doc</label>
                <input type="file" name="m_file" class="form-control" id="exampleFormControlInput1" required>
              </div>

              <input type="hidden" name="dpart" value="<?php echo  $der ?>">
              <input type="hidden" name="staffId" value="<?php echo $staff ?>">

              <div class="mb-3">
                <label for="defaultSelect" class="form-label">Choose Folder</label>
                <select name="spath" id="lastName" class="form-control" required>
                  <option value="">Select Folder</option>
                  <?php
                  foreach ($folders as $row) {
                  ?>
                    <option value="<?php echo $row['folder_path']; ?>"><?php echo $row["folder_name"]; ?></option>
                  <?php
                  }
                  ?>
                </select>

              </div>

              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Document Name</label>
                <input type="text" class="form-control" name="doc_name" id="exampleFormControlInput1" placeholder="Memo from MD" required>
              </div>

              <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Document Description</label>
                <textarea class="form-control" name="doc_desc" id="exampleFormControlTextarea1" rows="3" required></textarea>
              </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" value="Save Document">

          </form>
        </div>
      </div>
    </div>
  </div>



  <div class="modal fade" id="create_folder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Folder</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <div style="width:85%; margin:0 auto; padding:20px;">

            <form action="./processor/create_folder.php" method="post" enctype="multipart/form-data">


              <input type="hidden" name="dpart" value="<?php echo  $der ?>">
              <input type="hidden" name="staffId" value="<?php echo $staff ?>" required>

              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Folder Name</label>
                <input type="text" class="form-control" name="folder" id="exampleFormControlInput1" placeholder="Incoming Files" required>
              </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" value="Save Document">

          </form>
        </div>
      </div>
    </div>
  </div>



  <div class="modal fade" id="staff_list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Share File</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="card-body">
          <div style="width:85%; margin:0 auto; padding:20px;">


            <form action="./processor/share_files.php" method="post" enctype="multipart/form-data">



              <div class="mb-3">

                <label for="defaultSelect" class="form-label">Select File to share</label>
                <select name="fileId" id="lastName" class="form-control" required>
                  <option style="color:red;" value=""><span> -Select File <span style="color:red;">*</span></span></option>
                  <?php
                  foreach ($staff_files as $row) {
                  ?>
                    <option value="<?php echo $row['documentId']; ?>"><?php echo $row["document_name"]; ?></option>
                  <?php
                  }
                  ?>
                </select>

              </div>


              <div class="mb-3">

                <label for="defaultSelect" class="form-label">Share With</label>
                <select name="toId" id="lastName" class="form-control" required>
                  <option style="color:red;" value=""><span> -Select Staff/Admin- <span style="color:red;">*</span></span></option>
                  <?php
                  foreach ($staffs as $row) {
                  ?>
                    <option value="<?php echo $row['staffId']; ?>"><?php echo $row["firstname"] . '&nbsp; &nbsp; ' . $row["lastname"] . '&nbsp; &nbsp; &nbsp; &nbsp; [' . $row["role"] . ']'; ?></option>
                  <?php
                  }
                  ?>
                </select>

              </div>

              <input type="hidden" name="fromId" value="<?php echo $staff ?>" required>

              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Description/Comment</label>
                <textarea type="text" class="form-control" name="comment" id="" placeholder="comment here" required></textarea>
              </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" value="Share ">

          </form>
        </div>
      </div>
    </div>
  </div>


  <script>
    $(document).ready(function() {
      $("#MyModal").modal();
    });
  </script>

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>

  <!--Start of Tawk.to Script-->
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