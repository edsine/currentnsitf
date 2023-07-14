   <?php
    session_start();

    if (!isset($_SESSION['admin-log'])) {
      header("location:../");
    }

    require_once '../classes/manage.php';
    $query = new Manage();

    $der =   $_SESSION['brc'];

    $staff = $_SESSION['staff'];
    $user = $query->getRow("select staffId, firstname, lastname, departmentId, POSITION from staff_tb where staffId=  $staff");

    $staffi = $user['firstname'] . ' ' . $user['lastname'];

    $department = $user['departmentId'];
    $user1 = $query->getRow("SELECT dep_unit FROM departments WHERE department_id=$department");

    $position = $user['POSITION'] ?? 10;
    $user2 = $query->getRow("SELECT position_name FROM positions WHERE position_id=$position");

    ?>

   <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
     <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
       <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
         <i class="bx bx-menu bx-sm"></i>
       </a>
     </div>

     <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
       <!-- Search -->
       <div class="navbar-nav align-items-center">
         <div class="nav-item d-flex align-items-center">
           <i class="bx bx-search fs-4 lh-0"></i>
           <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..." />
         </div>
       </div>
       <!-- /Search -->

       <ul class="navbar-nav flex-row align-items-center ms-auto">
         <!-- Place this tag where you want the button to render. -->
         <!-- <span style="font-weight:bold;"> <?php echo  $staffi ?></span> -->
         <span class="fw-bold fs-5">
           <?php echo  $staffi ?>
           <span class="mx-3 fs-2 fw-normal">|</span>
           <?=$user1['dep_unit']?>
           <span class="mx-3 fs-2 fw-normal">|</span>
           <?= $user2['position_name'] ?>
         </span>

         <!-- User -->
         <li class="nav-item navbar-dropdown dropdown-user dropdown">
           <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
             <div class="avatar avatar-online">
               <i class="bx bx-user fw-bold fs-1 me-2"> </i>
             </div>
           </a>
           <ul class="dropdown-menu dropdown-menu-end">
             <!-- <li>
               <a class="dropdown-item" href="#">
                 <div class="d-flex">
                   <div class="flex-shrink-0 me-3">
                     <div class="avatar avatar-online">

                     </div>
                   </div>
                   <div class="flex-grow-1">
                     <span class="fw-semibold d-block"><?php echo $_SESSION['comp_name'] ?></span>

                   </div>
                 </div>
               </a>
             </li>
             <li>
               <div class="dropdown-divider"></div>
             </li> -->
             <li>
               <a class="dropdown-item" href="user-profile">
                 <i class="bx bx-user me-2"></i>
                 <span class="align-middle">My Profile</span>
               </a>
             </li>
             <li>
               <a class="dropdown-item" href="changePassword">
                 <i class="bx bx-cog me-2"></i>
                 <span class="align-middle">Change Password</span>
               </a>
             </li>

             <li>
               <div class="dropdown-divider"></div>
             </li>
             <li>
               <a class="dropdown-item" href="../">
                 <i class="bx bx-power-off me-2"></i>
                 <span class="align-middle">Log Out</span>
               </a>
             </li>
           </ul>
         </li>
         <!--/ User -->
       </ul>
     </div>

   </nav>