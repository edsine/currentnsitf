<?php 
session_start();
require_once '../classes/manage.php';
$query = new Manage();

$pistate = $_SESSION['state'];
$plocal = $_SESSION['local'];
$artName = $_SESSION['name'];
$artPhone = $_SESSION['phone'];
$address = $_SESSION['address'];
$service = $_SESSION['service'];
$artisan =  $_SESSION['artisan'];


$rec = $_GET['up'];



$req = $query->getRow("select * from c_requirements where rec_id = $rec"); 

$cc = $req['requirement'];


$requirements = $query->getRows("select * from c_requirements where service_id = $service"); 


$pstate = $query->getRow("select * from states where id = $pistate"); 
$plocal = $query->getRow("select * from local_governments where id = $plocal"); 
$checkPermit = $query->getRow("select * from c_artisan where cArt_id = $artisan"); 



$pstate = $query->getRow("select * from states where id = $pistate"); 
$logo = $pstate['state_logo'];

$check = $checkPermit['permit_status'];

$sname = $pstate['name'];


$pslocal = $plocal['local_name'];


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Account</title>
    <!-- MDB icon -->
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <!-- Google Fonts Roboto -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
    />
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />
  </head>
  <body>


  

<section class="vh-100" style="background-color: #fff; ">

  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius:3px;">
        <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <!-- Container wrapper -->
  <div class="container-fluid">
    <!-- Toggle button -->
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Navbar brand -->
      <a class="navbar-brand mt-2 mt-lg-0" href="#">
        <img
        
    
          src="state-logo/<?php echo $logo ?>"
          height="70"
          alt="MDB Logo"
          loading="lazy"
        />
      </a>
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="#" style="font-weight:bold;"><?php echo $sname.' -> ' .$pslocal?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">File upload</a>
        </li>
        <!--
        <li class="nav-item">
          <a class="nav-link" href="#">Projects</a>
        </li>
        
        -->
      </ul>
      <!-- Left links -->
    </div>
    <!-- Collapsible wrapper -->

    <!-- Right elements -->
    <div class="d-flex align-items-center">
      <!-- Icon -->

      <!-- Notifications -->
      <div class="dropdown">
        <a
          class="text-reset me-3 dropdown-toggle hidden-arrow"
          href="#"
          id="navbarDropdownMenuLink"
          role="button"
          data-mdb-toggle="dropdown"
          aria-expanded="false"
        >
            
          <i class="fas fa-bell"></i>
          <span class="badge rounded-pill badge-notification bg-danger">1</span>
        </a>
        <ul
          class="dropdown-menu dropdown-menu-end"
          aria-labelledby="navbarDropdownMenuLink"
        >
          <li>
            <a class="dropdown-item" href="#">Some news</a>
          </li>
          <li>
            <a class="dropdown-item" href="#">Another news</a>
          </li>
          <li>
            <a class="dropdown-item" href="#">Something else here</a>
          </li>
        </ul>
      </div>
      <!-- Avatar -->
      <div class="dropdown">
        <a
          class="dropdown-toggle d-flex align-items-center hidden-arrow"
          href="#"
          id="navbarDropdownMenuAvatar"
          role="button"
          data-mdb-toggle="dropdown"
          aria-expanded="false"
        >
          <img
            src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp"
            class="rounded-circle"
            height="25"
            alt="Black and White Portrait of a Man"
            loading="lazy"
          />
        </a>
        <ul
          class="dropdown-menu dropdown-menu-end"
          aria-labelledby="navbarDropdownMenuAvatar"
        >
        
          <li>
            <a class="dropdown-item" href="#">Settings</a>
          </li>
          <li>
            <a class="dropdown-item" href="#">Logout</a>
          </li>
        </ul>
      </div>
    </div>
    <!-- Right elements -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

              <p>
             
            
             <strong>Data: <?php echo $cc; ?></strong> <span style="font-weight:bold; font-size:18px;"><?php echo  $serviceDetails['service_name'] ?></span><br>
          </p>

                          <p>  <i class="fas fa- fa-lg me-3 fa-fw"></i>Upload a  pdf format of the above data.</p>
                          <hr>
                <form class="mx-1 mx-md-4" method="post" action="../logJwt/upload_credentials"  enctype="multipart/form-data">

                 
               
                 
               <label class="form-label" for="customFile">Upload cred</label>
                <input type="file" name="file" class="form-control" id="customFile" />
                <input type="hidden"   name="recId" value="<?php echo $rec ?>" />
                                  <br>
                   <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg">Submit</button>
                  </div>

                 
                 

                 
                 
        

                

                

                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
             
                <img src="img/file-upload.svg"
                  class="img-fluid" alt="Sample image">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
  </body>
</html>
