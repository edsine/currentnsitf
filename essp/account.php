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



$pstate = $query->getRow("select * from states where id = $pistate"); 
$plocal = $query->getRow("select * from local_governments where id = $plocal"); 
$checkPermit = $query->getRow("select * from c_artisan where cArt_id = $artisan"); 



$pstate = $query->getRow("select * from states where id = $pistate"); 
$logo = $pstate['state_logo'];

$check = $checkPermit['permit_status'];

$sname = $pstate['name'];


$pslocal = $plocal['local_name'];


$serviceDetails = $query->getRow("select * from const_services where service_id = $service"); 

$requirements = $query->getRows("select * from c_requirements where service_id = $service"); 


$recCount = $query->getRow("select count(rec_id) as recCount from c_requirements where service_id = $service"); 



$uploadCount = $query->getRow("select count(rc_uploadId) as upCount from upload_requirement where artisan_id = $artisan"); 

$rcount = $recCount['recCount'];
$ucount = $uploadCount['upCount'];

//echo $rcount.'<br>';
//echo $ucount

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Account</title>
    <!-- MDB icon -->
    <link rel="icon" href="" type="image/x-icon" />
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


  

<section class="" style="background-color: #fff; height:100%; ">

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
          <a class="nav-link" href="#">Home</a>
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
<div class="card" style="width: 18rem;">
  <div class="card-body">

     
     <p class="card-text">
                    <span  style="font-size:23px; color:#16507b;"><?php echo $artName ?></span><br>
              <?php echo $address ?><br>
            +234 <?php echo $artPhone ?><br>
             <?php echo  $email ?><br>
             <span style="font-weight:bold; font-size:18px; color:#16507b;">[<?php echo  $serviceDetails['service_name'] ?>]</span><br>
          </p>
    <a href="#" class="btn btn-primary">logout</a>
    
  </div>
</div>
     
     <br>
              
              <div class="card">
  <div class="card-header"    style="color:#16507b;">Requirements For Permits</div>
  <div class="card-body">
   
   
     <p class="card-text">
     <?php foreach($requirements as $row){ 
                      $id = $row['rec_id'];
                  
                  
 $check = $query->getRow("select * from upload_requirement where artisan_id =$artisan and requirement_id =  $id"); 

                  
                  ?>
                <div class="d-flex flex-row align-items-center mb-4">
                 
                    <div class="form-outline flex-fill mb-0">
                   
                      <label class="form-label" for="form3Example1c"    style="color:#16507b;"><?php echo $row['requirement'] ?> <?if( $check){echo "<span  style='color:green'>uploaded <i class='fas fa-check fa-lg me-3 fa-fw'></i> &nbsp; <a href='' style='color:orange;'>[Change]</a></span>";}else{?> &nbsp; &nbsp; <a href="upload_c?up=<?php echo $id ?>" class="btn btn-primary">Upload</a></label><?php } ?>
                    </div>
                  </div>
                  
                  <?php } ?>
                  
                  </p>
  </div>
</div>
                         
              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex  order-1 order-lg-2">
              <div class="row">
                  
                  
                  
                  
                            <div class="col-sm-6">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Status</h5>
                            
                            <p class="card-text">
                             <strong style="color:#16507b;">Requirement Upload:</strong> <?php if($rcount ==$ucount){ echo "<span style='color:green;'> <i>Done.<i class='fas fa-check fa-lg me-3 fa-fw'></i></i></span>";}else{ ?>
                           <span style='color:red;'>Complete requirement upload...</span> 
                              <?php } ?>
                              
                              
                              <br>
                               <strong style="color:#16507b;">Payment:</strong> <?php if($checkPermit['permit_status'] ==0 and $checkPermit['payment_status'] ==0 ){ echo "<span style='color:red;'> Waiting for approval.</span>";}elseif($checkPermit['payment_status']==0 and $checkPermit['permit_status'] ==2){ ?>
                           <span style='color:orange;'> Approved Waiting for payment...</span>
                            
                            <?php }elseif($checkPermit['payment_status']==1 and $checkPermit['permit_status'] ==2){ ?>
                            
                           <span style='color:green;'> PAID...</span> 
                              <?php } ?>
                              <br>
                              
                               <span style="color:#16507b;"><strong>Permit:</strong></span> <?php if($checkPermit['permit_status'] ==0){ echo "<span style='color:red;'> Waiting for approval.</span>";}elseif($checkPermit['permit_status']==2){ ?>
                           <span style='color:orange;'> Approved  Waiting for payment...</span>
                            
                            <?php }else{ ?>
                            
                           <span style='color:red;'> Waiting for approval...</span> 
                              <?php } ?>
                              </p>
                          
                        </div>
                        </div>
                    </div>
                    
                     <div class="col-sm-6" style="margin-top:5px; margin-bottom:5px">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title" style="color:#16507b;">Permits</h5>
                            <p class="card-text" style="color:#16507b;">View details and slip of your work permission in   <?php echo $sname. '->'. $pslocal  ?> below.</p>
                            <?php if($checkPermit['permit_status'] ==0){ echo "<span style='color:red;'> Waiting for approval.</span>";}elseif($checkPermit['permit_status'] ==2){ ?>
                           <span style='color:orange;'> Approved &nbsp; <a href="certificate" class="btn btn-primary">Make payment</a></span>
                            
                            <?php }else{  ?>
                            <a href="#" class="btn btn-primary">view permit</a>
                            
                            <?php } ?>
                        </div>
                        </div>
                    </div>
                   <!--
                    <div class="col-sm-6">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Payments</h5>
                            <p class="card-text">Make payment for your permission appproval here.</p>
 <?php if($checkPermit['permit_status'] === '0'){ echo "<span style='color:red;'> <i>Waiting for approval...</i></span>";}else{ ?>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                            
                            <?php } ?>
                        </div>
                        </div>
                    </div>
                     <hr>
                     -->
                     
                   
          
                    </div>

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
