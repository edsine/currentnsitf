<?php 
session_start();

require_once '../classes/manage.php';
$query = new Manage();







$branch = trim($_SESSION['branch']);
//var_dump($_SESSION);

$branchD = $query->getRow("select * from all_branch where branch_id = $branch"); 

// $dsn = "mysql:host=localhost;dbname=ebs";
// $username = "root";
// $password = "Mkpanama1";

// try {
//     $pdo = new PDO($dsn, $username, $password);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     echo "Database connection failed: " . $e->getMessage();
//     exit();
// }

// Execute the query and fetch a single value
// $getbranch = "select * from all_branch where branch_id = $branch";
// $stmt = $pdo->query($getbranch);
// $branchD = $stmt->fetchColumn();

$myBranch = $branchD['branch_name'];


  $der =   $_SESSION['department'] ;
  
  $depart = $query->getRow("select * from departments where department_id = $der");
  
  $myDepartment = $depart['dep_unit'];

$role = $_SESSION['role'];


 $myrol = $query->getRow("select * from roles where roles_id = $role");
 
 $myRole = $myrol['role'];


?>

<?php if($role == 1 || $role == 12 ){ ?>
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index" class="">
              <span class="app-brand-logo demo">
          
              </span>
       <img src="../ikl.png" style="width:50px; margin:0 auto;"  >
            </a>
          

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item " style="background-color:#50664d; border-color:#50664d;">
              <a href="index" class="menu-link">
                <i  style="color:#fff;" class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics" style="color:#fff;">Dashboard</div>
              </a>
            </li>
            
            <li class="menu-item">
              <a href="index" class="menu-link">
               
                 <div data-i18n="Analytics" style="font-size:15px; font-weight:bold;"><?php echo  $myDepartment.' &nbsp; &nbsp;<br>'.$myRole  ?></div>
                
              </a>
              
               <a href="index" class="menu-link">
               
                <div data-i18n="Analytics" style="font-size:12px;"><?php echo $myBranch ?></div>
                
              </a>
            </li>

            <!-- User interface -->

            
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Administration</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="employer" class="menu-link">
                    <div data-i18n="Account" >New Employer</div>
                  </a>
                  
                  
                </li>
                <li class="menu-item">
                  <a href="view-employers" class="menu-link">
                    <div data-i18n="Notifications" >All Employers</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="approved_employers" class="menu-link">
                    <div data-i18n="Connections">Approved Employers</div>
                  </a>
                </li>
                
                 <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Accordion" >All Branch</div>
                  </a>
                </li>
               
                
                
                <li class="menu-item">
                  <a href="unapproved_employers" class="menu-link">
                    <div data-i18n="Connections" >Unapproved Employers</div>
                  </a>
                </li>
               
               
                
                 <li class="menu-item">
                  <a href="view-employers" class="menu-link">
                    <div data-i18n="Connections" >View Employers</div>
                  </a>
                </li>
              </ul>
            </li>
            
               <!-- User interface -->
               
                  
             <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" style="">DTA/OPE Applications</div>
              </a>
             <ul class="menu-sub">
                <li class="menu-item">
                  <a href="sp_dta_review" class="menu-link">
                    <div data-i18n="Account" >DTA Review Requests</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="dtas_reviewed" class="menu-link">
                    <div data-i18n="Notifications" >Reviewed DTA</div>
                  </a>
                </li>
                
              </ul>
            </li>
            
           <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" style="">Memos</div>
              </a>
             <ul class="menu-sub">
                <li class="menu-item">
                  <a href="new_memo" class="menu-link">
                    <div data-i18n="Account" >New Memo</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="all-memos" class="menu-link">
                    <div data-i18n="Notifications" >All Memo</div>
                  </a>
                </li>
               
              </ul>
            </li>

            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings"  >External correspondence</div>
              </a>
              <ul class="menu-sub">
               
                <li class="menu-item">
                  <a href="incoming_doc" class="menu-link">
                    <div data-i18n="Notifications" >Incoming Document</div>
                  </a>
                </li>
                
                 
              </ul>
            </li>
            
            
             <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings"  >Finance & Accounts</div>
              </a>
              <ul class="menu-sub">
               
                <li class="menu-item">
                  <a href="view_payments" class="menu-link">
                    <div data-i18n="Notifications" >Payments Approval</div>
                  </a>
                </li>
                
                 <li class="menu-item">
                  <a href="pending_payments" class="menu-link">
                    <div data-i18n="Notifications" >Approved Payments</div>
                  </a>
                </li>
                
                <li class="menu-item">
                  <a href="view_payments" class="menu-link">
                    <div data-i18n="Connections" >All Payments</div>
                  </a>
                </li>
              </ul>
            </li>
            
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Compliance Certificate</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="approved_employers" class="menu-link">
                    <div data-i18n="Account" >Employers</div>
                  </a>
                </li>
                <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >Certificate Processing</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="pending_certificates" class="menu-link">
                    <div data-i18n="Account" >Pending Request</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="issued_certificate" class="menu-link">
                    <div data-i18n="Notifications" >issued Certificates</div>
                  </a>
                </li>
                
               
              </ul>
            </li>
              </ul>
            </li>
            
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >Claims Notification</div>
              </a>
              <ul class="menu-sub">
               
                <li class="menu-item">
                  <a href="claims" class="menu-link">
                    <div data-i18n="Notifications" >View Claim Notifications</div>
                  </a>
                </li>
                
              </ul>
            </li>
              
              
                     
            <!-- User interface -->
            <li class="menu-item">
              <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="User interface" >Inspection</div>
              </a>
              <ul class="menu-sub">
                  
                  <li class="menu-item">
                  <a href="ins_pending" class="menu-link">
                    <div data-i18n="Accordion" >Pending Employers</div>
                  </a>
                </li>
                  
                <li class="menu-item">
                  <a href="inspected_emp" class="menu-link">
                    <div data-i18n="Accordion" >Inspected Employers</div>
                  </a>
                </li>
               
               
                
                
            
                
              </ul>
            </li>
            
         
            
            
            
             <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >HR</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="new_staff" class="menu-link">
                    <div data-i18n="Account" >New Staff</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="manage_staff" class="menu-link">
                    <div data-i18n="Badges" >Manage Staff</div>
                  </a>
                </li>
                 
                <li class="menu-item">
                  <a href="hrm_leave_request" class="menu-link">
                    <div data-i18n="Badges" >New Request</div>
                  </a>
                </li>
                
               
                
              
                
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Notifications" >Reviewed Leaves</div>
                  </a>
                </li>
                
                 <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Notifications" >Approved Leaves</div>
                  </a>
                </li>
           
                
             
                
                 <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Notifications" >Projects</div>
                  </a>
                </li>
               
              </ul>
            </li>
            
             <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >Document Manager</div>
              </a>
             <ul class="menu-sub">
                <li class="menu-item">
                  <a href="md_home" class="menu-link">
                    <div data-i18n="Account" >Home</div>
                  </a>
                </li>
                
              </ul>
            </li>


     <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                <div data-i18n="Authentications" >Authorization</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                    <li class="menu-item">
                  <a href="new_staff" class="menu-link" >
                    <div data-i18n="Basic" >New Staff</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="user_roles" class="menu-link" >
                    <div data-i18n="Basic">Update Staff Role</div>
                  </a>
                </li>
                
                <li class="menu-item">
                  <a href="pre_users.php" class="menu-link" >
                    <div data-i18n="Basic">Pre Activated Users</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Basic" >View User Roles</div>
                  </a>
                </li>
                
              </ul>
            </li>
            <!-- Extended components -->
            

           
            
           
            <!-- Tables -->
            
           
            <li class="menu-item">
             
            </li>
          </ul>
        </aside>
        
        <?php }elseif($role == 2){ ?>
        
         <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="" class="app-brand-link">
              <span class="app-brand-logo demo">
          
              </span>
             <span class="app-brand-text  " style="color:#618f64; font-size:23px; font-weight:bold;">     e-NSITF    </span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item " style="background-color:#50664d; border-color:#50664d;">
              <a href="index" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics" style="color:#fff;">Dashboard</div>
              </a>
            </li>
            
            <li class="menu-item">
              <a href="index" class="menu-link">
               
                <div data-i18n="Analytics">INSPECTION</div>
              </a>
            </li>

      
           

            
         
            
            <li class="menu-item">
              <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="User interface" >Inspection</div>
              </a>
              <ul class="menu-sub">
                  
                  <li class="menu-item">
                  <a href="ins_pending" class="menu-link">
                    <div data-i18n="Accordion" >Pending Employers</div>
                  </a>
                </li>
                  
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Accordion" >Approved Employers</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Alerts">Declined Employers</div>
                  </a>
                </li>
                
               
                
                
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Alerts">Displine & Recomendations</div>
                  </a>
                </li>
             
                
                
              </ul>
            </li>
            </li>
            
             <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >Document Manager</div>
              </a>
             <ul class="menu-sub">
                <li class="menu-item">
                  <a href="md_home" class="menu-link">
                    <div data-i18n="Account" >Home</div>
                  </a>
                </li>
                
              </ul>
            </li>

              
              
              <!---        
              <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >Health & Safety</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Account" >New HSE Notification</div>
                  </a>
                </li>
                
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Account" >New HSE Rehabilitation</div>
                  </a>
                </li>
                 <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Account" >New OSH Awareness</div>
                  </a>
                </li>
                
                 <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Account" >New OSH Audit</div>
                  </a>
                </li>
                
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Account" >View HSE Notifications</div>
                  </a>
                </li>
                
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Account" >View HSE Rehabilitation</div>
                  </a>
                </li>
                
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Account" >View OSH Awareness</div>
                  </a>
                </li>
                
                  <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Account" >View OSH Audit</div>
                  </a>
                </li>
            
              </ul>
            </li>
             --->
            
             <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >HR</div>
              </a>
              <ul class="menu-sub">
               
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Badges" >Attendance</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Notifications" >Leave</div>
                  </a>
                </li>
               
               
               <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Notifications" >Projects</div>
                  </a>
                </li>
               
              </ul>
            </li>
            
            
           
            <!-- Components -->
         
            
            
            <!-- Extended components -->
            

           
            
           
            <!-- Tables -->
            
          
          </ul>
        </aside>
        <?php  }elseif($role == 3){ ?>
         <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index" class="app-brand-link">
              <span class="app-brand-logo demo">
                   <img src="../ikl.png" style="width:70px; margin:0 auto;"  >
              </span>
             
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item " style="background-color:#50664d; border-color:#50664d;">
              <a href="index" class="menu-link">
                <i style="color:#fff" class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics" style="color:#fff;">Dashboard</div>
              </a>
            </li>
            
            <li class="menu-item">
              <a href="index" class="menu-link">
               
               <div data-i18n="Analytics" style="font-size:18px; font-weight:bold;"><?php echo  $myDepartment.' &nbsp; &nbsp;'.$myRole  ?></div>
              </a>
            </li>

      
           <?php if($der == 2){ ?>
        <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle active">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >Leave Request Approval</div>
              </a>
              <ul class="menu-sub">
                
                
                <li class="menu-item">
                  <a href="hrm_leave_request" class="menu-link">
                    <div data-i18n="Badges" >New Request</div>
                  </a>
                </li>
              
               
                
              
                
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Notifications" >Reviewed Leaves</div>
                  </a>
                </li>
                
                 <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Notifications" >Approved Leaves</div>
                  </a>
                </li>
           
                
               
               
              </ul>
            </li>
             <?php  } ?>
             
             
               <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >Claims Notification</div>
              </a>
              <ul class="menu-sub">
               
                <li class="menu-item">
                  <a href="claim_review" class="menu-link">
                    <div data-i18n="Notifications" >View Claim Notifications</div>
                  </a>
                </li>
                
                
                <li class="menu-item">
                  <a href="claims" class="menu-link">
                    <div data-i18n="Notifications" >Reviewed Claims</div>
                  </a>
                </li>
                
              </ul>
            </li>
            
            
                       
 <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle active">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >Apply For Leave</div>
              </a>
              <ul class="menu-sub">
                
               
                <li class="menu-item">
                  <a href="leave_rquest" class="menu-link">
                    <div data-i18n="Account" >Annual Leave</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="other_leave" class="menu-link">
                    <div data-i18n="Notifications" >Others</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="leave_status" class="menu-link">
                    <div data-i18n="Connections" >My leave status</div>
                  </a>
                </li>
               
              </ul>
            </li>
            
            
            
              
             <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" style="font-weight:bold;">DTA/OPE Applications</div>
              </a>
             <ul class="menu-sub">
                <li class="menu-item">
                  <a href="sp_dta_review" class="menu-link">
                    <div data-i18n="Account" >DTA Review Requests</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="dtas_reviewed" class="menu-link">
                    <div data-i18n="Notifications" >Reviewed DTA</div>
                  </a>
                </li>
                
              </ul>
            </li>
            
            
                 
             <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle active">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >Staff Management</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="new_staff" class="menu-link">
                    <div data-i18n="Account" >New Staff</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="manage_staff" class="menu-link">
                    <div data-i18n="Badges" >Manage Staff</div>
                  </a>
                </li>
                
             
                <li class="menu-item">
                  <a href="contact" class="menu-link">
                    <div data-i18n="Notifications" >Staff Contact</div>
                  </a>
                </li>
                
              
              </ul>
            </li>
            
             <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >Document Manager</div>
              </a>
             <ul class="menu-sub">
                <li class="menu-item">
                  <a href="md_home" class="menu-link">
                    <div data-i18n="Account" >Home</div>
                  </a>
                </li>
                
              </ul>
            </li>

            
            
      
            
            
            
            
           
         
            <!-- User interface -->
           <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" style="font-weight:bold;">Memos</div>
              </a>
             <ul class="menu-sub">
                <li class="menu-item">
                  <a href="leave_rquest" class="menu-link">
                    <div data-i18n="Account" >New Memo</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="create_document" class="menu-link">
                    <div data-i18n="Notifications" >Viewed Memo</div>
                  </a>
                </li>
               
              </ul>
            </li>

            
            
             
            
           
            <!-- Extended components -->
            

           
            
           
            <!-- Tables -->
            
            
           
          </ul>
        </aside>
        <?php }elseif($role == 4){
        ?>
         <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index" class="app-brand-link">
              <span class="app-brand-logo demo">
                   <img src="../ikl.png" style="width:55px; margin:0 auto;"  >
              </span>
             
            </a>
            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
           <li class="menu-item " style="background-color:#50664d; border-color:#50664d;">
              <a href="index" class="menu-link">
                <i  style="color:#fff;" class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics" style="color:#fff;">Dashboard</div>
              </a>
            </li>
            
            <li class="menu-item">
              <a href="index" class="menu-link">
               
                 <div data-i18n="Analytics" style="font-size:15px; font-weight:bold;"><?php echo  $myDepartment.' &nbsp; &nbsp;<br>'.$myRole  ?></div>
                
              </a>
              
               <a href="index" class="menu-link">
               
                <div data-i18n="Analytics" style="font-size:12px;"><?php echo $myBranch ?> Branch</div>
                
              </a>
            </li>

      
           

           
            
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings"  >Finance & Accounts</div>
              </a>
              <ul class="menu-sub">
                
                <li class="menu-item">
                  <a href="Payments" class="menu-link">
                    <div data-i18n="Notifications" >Successful Payments</div>
                  </a>
                </li>
                
                 <li class="menu-item">
                  <a href="pending_payments" class="menu-link">
                    <div data-i18n="Notifications" >Pending Payments</div>
                  </a>
                </li>
                
                <li class="menu-item">
                  <a href="view_payments" class="menu-link">
                    <div data-i18n="Connections" >All Payments</div>
                  </a>
                </li>
              </ul>
            </li>
            
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Compliance Certificate</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="approved_employers" class="menu-link">
                    <div data-i18n="Account" >Employers</div>
                  </a>
                </li>
                <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >Certificate Processing</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="pending_certificates" class="menu-link">
                    <div data-i18n="Account" >Pending Request</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="issued_certificate" class="menu-link">
                    <div data-i18n="Notifications" >issued Certificates</div>
                  </a>
                </li>
                
               
              </ul>
            </li>
              </ul>
            </li>
            
            
              
                      
             
            
            
            
             <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" style="font-weight:bold;">Leave</div>
              </a>
             <ul class="menu-sub">
                <li class="menu-item">
                  <a href="leave_rquest" class="menu-link">
                    <div data-i18n="Account" >Annual Leave</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="other_leave" class="menu-link">
                    <div data-i18n="Notifications" >Others</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="leave_status" class="menu-link">
                    <div data-i18n="Connections" >My leave status</div>
                  </a>
                </li>
              </ul>
            </li>
            
            
              <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" style="font-weight:bold;">DTA/OPE Applications</div>
              </a>
             <ul class="menu-sub">
                <li class="menu-item">
                  <a href="sp_dta_review" class="menu-link">
                    <div data-i18n="Account" >DTA Review Requests</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="dtas_reviewed" class="menu-link">
                    <div data-i18n="Notifications" >Reviewed DTA's</div>
                  </a>
                </li>
                
              </ul>
            </li>
            
                
                   <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" style="font-weight:bold;">Memos</div>
              </a>
             <ul class="menu-sub">
                <li class="menu-item">
                  <a href="leave_rquest" class="menu-link">
                    <div data-i18n="Account" >New Memo</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="create_document" class="menu-link">
                    <div data-i18n="Notifications" >Viewed Memo</div>
                  </a>
                </li>
               
              </ul>
            </li>
 
            
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >Document Manager</div>
              </a>
             <ul class="menu-sub">
                <li class="menu-item">
                  <a href="md_home" class="menu-link">
                    <div data-i18n="Account" >Home</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="create_document" class="menu-link">
                    <div data-i18n="Notifications" >Create File</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Connections" >Notifications</div>
                  </a>
                </li>
              </ul>
            </li>
           
    
            <!-- Extended components -->
            

           
            
           
            <!-- Tables -->
            
           
            
          </ul>
        </aside>
         <?php }elseif($role == 5){
        ?>
             <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
              <span class="app-brand-logo demo">
          
              </span>
              <span class="app-brand-text  " style="color:#618f64; font-size:23px; font-weight:bold;">     e-NSITF    </span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item active" style="background-color:#37a33f; border-color:#37a33f;">
              <a href="index" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle" style="color:#fff;" ></i>
                <div data-i18n="Analytics" style="color:#fff;">Dashboard</div>
              </a>
            </li>
            
            <li class="menu-item">
              <a href="index" class="menu-link">
               
                <div data-i18n="Analytics">HEALTH </div>
              </a>
            </li>

      
           

            <li class="menu-header small text-uppercase">
              <span class="menu-header-text" >Proc</span>
            </li>
          
            
            
            
              
                      <!--
              <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >Health & Safety</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="pages-account-settings-account.html" class="menu-link">
                    <div data-i18n="Account" >New HSE Notification</div>
                  </a>
                </li>
                
                <li class="menu-item">
                  <a href="pages-account-settings-account.html" class="menu-link">
                    <div data-i18n="Account" >New HSE Rehabilitation</div>
                  </a>
                </li>
                 <li class="menu-item">
                  <a href="pages-account-settings-account.html" class="menu-link">
                    <div data-i18n="Account" >New OSH Awareness</div>
                  </a>
                </li>
                
                 <li class="menu-item">
                  <a href="pages-account-settings-account.html" class="menu-link">
                    <div data-i18n="Account" >New OSH Audit</div>
                  </a>
                </li>
                
                <li class="menu-item">
                  <a href="pages-account-settings-account.html" class="menu-link">
                    <div data-i18n="Account" >View HSE Notifications</div>
                  </a>
                </li>
                
                <li class="menu-item">
                  <a href="pages-account-settings-account.html" class="menu-link">
                    <div data-i18n="Account" >View HSE Rehabilitation</div>
                  </a>
                </li>
                
                <li class="menu-item">
                  <a href="pages-account-settings-account.html" class="menu-link">
                    <div data-i18n="Account" >View OSH Awareness</div>
                  </a>
                </li>
                
                  <li class="menu-item">
                  <a href="pages-account-settings-account.html" class="menu-link">
                    <div data-i18n="Account" >View OSH Audit</div>
                  </a>
                </li>
            
              </ul>
            </li>
            
            
            -->
           
             
            
             <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >HR</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Account" > leave</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Badges" >Attendance</div>
                  </a>
                </li>
                
               
              </ul>
            </li>
            
             <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >Document Manager</div>
              </a>
             <ul class="menu-sub">
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Account" >New Doc(File)</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="create_document" class="menu-link">
                    <div data-i18n="Notifications" >My Doc</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Connections" >Shared Files</div>
                  </a>
                </li>
              </ul>
            </li>
    
            <!-- Extended components -->
            

           
            
           
            <!-- Tables -->
            
           
          
          </ul>
        </aside>
        
        
        <?php }elseif($role == 6){ ?>
          <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
              <span class="app-brand-logo demo">
          
              </span>
               <span class="app-brand-text  " style="color:#618f64; font-size:23px; font-weight:bold;">     e-NSITF    </span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
        
            <!-- Dashboard -->
           <li class="menu-item " style="background-color:#50664d; border-color:#50664d;">
              <a href="index" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics" style="color:#fff;">Dashboard</div>
              </a>
            </li>
            
            <li class="menu-item">
              <a href="index" class="menu-link">
               
                <div data-i18n="Analytics">ADMINISTRATION</div>
              </a>
            </li>

      
    
            
            <!-- User interface -->
            <li class="menu-item">
              <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="User interface" >Administration</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Accordion" >New Branch</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Alerts">Branch Staff</div>
                  </a>
                </li>
                
                 <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Alerts">Branch Info</div>
                  </a>
                </li>
                
                
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Alerts">Displine & Recomendations</div>
                  </a>
                </li>
             
                
                
              </ul>
            </li>
           

            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Registration</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="employer" class="menu-link">
                    <div data-i18n="Account" >New Employer</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="view-employers" class="menu-link">
                    <div data-i18n="Notifications" >All Employers</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="approved_employers" class="menu-link">
                    <div data-i18n="Connections">Approved Employers</div>
                  </a>
                </li>
                
                <li class="menu-item">
                  <a href="unapproved_employers" class="menu-link">
                    <div data-i18n="Connections" >Unapproved Employers</div>
                  </a>
                </li>
               
               
                
                 <li class="menu-item">
                  <a href="view-employers" class="menu-link">
                    <div data-i18n="Connections" >View Employers</div>
                  </a>
                </li>
              </ul>
            </li>
            
            
            
          
            
           
              
                      <!--
              <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >Health & Safety</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="pages-account-settings-account.html" class="menu-link">
                    <div data-i18n="Account" >New HSE Notification</div>
                  </a>
                </li>
                
                <li class="menu-item">
                  <a href="pages-account-settings-account.html" class="menu-link">
                    <div data-i18n="Account" >New HSE Rehabilitation</div>
                  </a>
                </li>
                 <li class="menu-item">
                  <a href="pages-account-settings-account.html" class="menu-link">
                    <div data-i18n="Account" >New OSH Awareness</div>
                  </a>
                </li>
                
                 <li class="menu-item">
                  <a href="pages-account-settings-account.html" class="menu-link">
                    <div data-i18n="Account" >New OSH Audit</div>
                  </a>
                </li>
                
                <li class="menu-item">
                  <a href="pages-account-settings-account.html" class="menu-link">
                    <div data-i18n="Account" >View HSE Notifications</div>
                  </a>
                </li>
                
                <li class="menu-item">
                  <a href="pages-account-settings-account.html" class="menu-link">
                    <div data-i18n="Account" >View HSE Rehabilitation</div>
                  </a>
                </li>
                
                <li class="menu-item">
                  <a href="pages-account-settings-account.html" class="menu-link">
                    <div data-i18n="Account" >View OSH Awareness</div>
                  </a>
                </li>
                
                  <li class="menu-item">
                  <a href="pages-account-settings-account.html" class="menu-link">
                    <div data-i18n="Account" >View OSH Audit</div>
                  </a>
                </li>
            
              </ul>
            </li>
            
            
            
           -->
          
            
            
             <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >Branch Management</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Account" >Manage Branch</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="ui-badges.html" class="menu-link">
                    <div data-i18n="Badges" >Broadcast Message</div>
                  </a>
                </li>
               
              </ul>
            </li>
            
             <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >HR</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Account" >Account</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Badges" >Attendance</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Notifications" >Notifications</div>
                  </a>
                </li>
               
              </ul>
            </li>
            
             <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" style="font-weight:bold;">Document Manager</div>
              </a>
             <ul class="menu-sub">
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Account" >All files (working on)</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="create_document" class="menu-link">
                    <div data-i18n="Notifications" >Create File</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Connections" >Notifications</div>
                  </a>
                </li>
              </ul>
            </li>
            <!-- Extended components -->
            

           
            
           
            <!-- Tables -->
            
           
            <li class="menu-item">
              <a
                href=""
                class="menu-link"
              >
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Documentation">Documentation</div>
              </a>
            </li>
          </ul>
        </aside>
        
        <?php }elseif($role == 7){ ?>
          <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
              <span class="app-brand-logo demo">
          
              </span>
              <span class="app-brand-text demo menu-text fw-bolder ms-2">     e-NSITF    </span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item " style="background-color:#50664d; border-color:#50664d;">
              <a href="index" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics" style="color:#fff;">Dashboard</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="index" class="menu-link">
               
                <div data-i18n="Analytics">Super Admin</div>
              </a>
            </li>

      
           

            <li class="menu-header small text-uppercase">
              <span class="menu-header-text" >Proc</span>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Registration</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="employer" class="menu-link">
                    <div data-i18n="Account" >New Employer</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="view-employers" class="menu-link">
                    <div data-i18n="Notifications" >All Employers</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="approved_employers" class="menu-link">
                    <div data-i18n="Connections">Approved Employers</div>
                  </a>
                </li>
                
                <li class="menu-item">
                  <a href="unapproved_employers" class="menu-link">
                    <div data-i18n="Connections" >Unapproved Employers</div>
                  </a>
                </li>
               
               
                
                 <li class="menu-item">
                  <a href="view-employers" class="menu-link">
                    <div data-i18n="Connections" >View Employers</div>
                  </a>
                </li>
              </ul>
            </li>
            
            
             <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings"  >Finance & Accounts</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="generate_invoice" class="menu-link">
                    <div data-i18n="Account" >Generate Invoice</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="view_payments" class="menu-link">
                    <div data-i18n="Notifications" >View Payments</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="legacy_payments" class="menu-link">
                    <div data-i18n="Connections" >Legacy Payments</div>
                  </a>
                </li>
              </ul>
            </li>
            
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Complience Certificate</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="approved_employers" class="menu-link">
                    <div data-i18n="Account" >Approved  Employers</div>
                  </a>
                </li>
                <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >View Request</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="pending_certificate" class="menu-link">
                    <div data-i18n="Account" >Pending Request</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="unissued_certificates" class="menu-link">
                    <div data-i18n="Notifications" >Unissued Certificates</div>
                  </a>
                </li>
                
                <li class="menu-item">
                  <a href="issued_certificates" class="menu-link">
                    <div data-i18n="Notifications" >issued Certificates</div>
                  </a>
                </li>
                
                 <li class="menu-item">
                  <a href="decline_request" class="menu-link">
                    <div data-i18n="Notifications" >Decline Request</div>
                  </a>
                </li>
                
              </ul>
            </li>
              </ul>
            </li>
            
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >Claims Notification</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Account" >New Claim Notification</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Notifications" >View Claims</div>
                  </a>
                </li>
                
              </ul>
            </li>
              
              
                      <!--
              <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >Health & Safety</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="pages-account-settings-account.html" class="menu-link">
                    <div data-i18n="Account" >New HSE Notification</div>
                  </a>
                </li>
                
                <li class="menu-item">
                  <a href="pages-account-settings-account.html" class="menu-link">
                    <div data-i18n="Account" >New HSE Rehabilitation</div>
                  </a>
                </li>
                 <li class="menu-item">
                  <a href="pages-account-settings-account.html" class="menu-link">
                    <div data-i18n="Account" >New OSH Awareness</div>
                  </a>
                </li>
                
                 <li class="menu-item">
                  <a href="pages-account-settings-account.html" class="menu-link">
                    <div data-i18n="Account" >New OSH Audit</div>
                  </a>
                </li>
                
                <li class="menu-item">
                  <a href="pages-account-settings-account.html" class="menu-link">
                    <div data-i18n="Account" >View HSE Notifications</div>
                  </a>
                </li>
                
                <li class="menu-item">
                  <a href="pages-account-settings-account.html" class="menu-link">
                    <div data-i18n="Account" >View HSE Rehabilitation</div>
                  </a>
                </li>
                
                <li class="menu-item">
                  <a href="pages-account-settings-account.html" class="menu-link">
                    <div data-i18n="Account" >View OSH Awareness</div>
                  </a>
                </li>
                
                  <li class="menu-item">
                  <a href="pages-account-settings-account.html" class="menu-link">
                    <div data-i18n="Account" >View OSH Audit</div>
                  </a>
                </li>
            
              </ul>
            </li>
            
            -->
            
           
            <!-- Components -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Management</span></li>
            <!-- Cards -->
            
            <!-- User interface -->
            <li class="menu-item">
              <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="User interface" >Administration</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Accordion" >New Branch</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Alerts">Branch Staff</div>
                  </a>
                </li>
                
                 <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Alerts">Branch Info</div>
                  </a>
                </li>
                
                
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Alerts">Displine & Recomendations</div>
                  </a>
                </li>
             
                
                
              </ul>
            </li>
            
            
             <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >Branch Management</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Account" >Manage Branch</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="ui-badges.html" class="menu-link">
                    <div data-i18n="Badges" >Broadcast Message</div>
                  </a>
                </li>
               
              </ul>
            </li>
            
             <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >HR</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Account" >Account</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Badges" >Attendance</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Notifications" >Notifications</div>
                  </a>
                </li>
               
              </ul>
            </li>
            
             <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" style="font-weight:bold;">Document Manager</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Account" >Account</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Notifications" >Notifications</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Connections" >Connections</div>
                  </a>
                </li>
              </ul>
            </li>

    
            <!-- Extended components -->
            

           
            
           
            <!-- Tables -->
            
           
            <li class="menu-item">
              <a
                href=""
                class="menu-link"
              >
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Documentation">Documentation</div>
              </a>
            </li>
          </ul>
        </aside>
        <?php }elseif($role == 8){ ?>
           <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index" class="app-brand-link">
              <span class="app-brand-logo demo">
          
              </span>
               <img src="../ikl.png" style="width:60px; margin:0 auto;"  >
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
       
            <li class="menu-item " style="background-color:#50664d; border-color:#50664d;">
              <a href="index" class="menu-link">
                <i style="color:#fff;" class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics" style="color:#fff;">Dashboard</div>
              </a>
            </li>
            
            <li class="menu-item">
              <a href="index" class="menu-link">
               
               <div data-i18n="Analytics" style="font-size:16px; font-weight:bold;"><?php echo  $myDepartment.' &nbsp; &nbsp; <br>'.$myRole  ?></div>
              </a>
            </li>

      
           
             
        
            
          
            
             <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" style="">Leave</div>
              </a>
             <ul class="menu-sub">
                <li class="menu-item">
                  <a href="leave_rquest" class="menu-link">
                    <div data-i18n="Account" >Annual Leave</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="other_leave" class="menu-link">
                    <div data-i18n="Notifications" >Others</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="leave_status" class="menu-link">
                    <div data-i18n="Connections" >My leave status</div>
                  </a>
                </li>
              </ul>
            </li>


<li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" style="">Memos</div>
              </a>
             <ul class="menu-sub">
                <li class="menu-item">
                  <a href="view_memos" class="menu-link">
                    <div data-i18n="Account" >View Memos</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="create_document" class="menu-link">
                    <div data-i18n="Notifications" >All Memos</div>
                  </a>
                </li>
               
              </ul>
            </li>
            
            
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" style="">DTA & OPE's</div>
              </a>
             <ul class="menu-sub">
                <li class="menu-item">
                  <a href="new_dta" class="menu-link">
                    <div data-i18n="Account" >New DTA Request</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="submitted_dtas" class="menu-link">
                    <div data-i18n="Notifications" >Viewed DTA</div>
                  </a>
                </li>
               
              </ul>
            </li>

            
            
           
    
              
              
            
           
            
            
             <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >Document Manager</div>
              </a>
             <ul class="menu-sub">
                <li class="menu-item">
                  <a href="md_home" class="menu-link">
                    <div data-i18n="Account" >Home</div>
                  </a>
                </li>
                
              </ul>
            </li>



    
            <!-- Extended components -->
            

           
            
           
            <!-- Tables -->
            
           
          
          </ul>
        </aside>
        <?php }elseif($role == 9){ ?>
        
        
         <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index" class="app-brand-link">
              <span class="app-brand-logo demo">
            <img src="../ikl.png" style="width:60px; align-item:center;"  >
              </span>
               
            </a>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
        
            <!-- Dashboard -->
           <li class="menu-item " style="background-color:#50664d; border-color:#50664d;">
              <a href="index" class="menu-link">
                <i style="color:#fff" class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics" style="color:#fff;">Dashboard</div>
              </a>
            </li>
            
            <li class="menu-item">
              <a href="index" class="menu-link">
               
                <div data-i18n="Analytics" style="font-size:15px; font-weight:bold;"><?php echo  $myDepartment.' &nbsp; &nbsp;<br>'.$myRole  ?></div>
                
              </a>
              <hr>
            </li>

      
    
            
            
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" style="font-weight:bold;">Leave Request</div>
              </a>
             <ul class="menu-sub">
                <li class="menu-item">
                  <a href="requested_leave" class="menu-link">
                    <div data-i18n="Account" >New Leave Request</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="s_reviewed" class="menu-link">
                    <div data-i18n="Notifications" >Reviewed Leaves</div>
                  </a>
                </li>
                
              </ul>
            </li>
            
            
             <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" style="font-weight:bold;">DTA/OPE Applications</div>
              </a>
             <ul class="menu-sub">
                <li class="menu-item">
                  <a href="sp_dta_review" class="menu-link">
                    <div data-i18n="Account" >DTA Review Requests</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="dtas_reviewed" class="menu-link">
                    <div data-i18n="Notifications" >Reviewed DTA's</div>
                  </a>
                </li>
                
              </ul>
            </li>

            
            
             <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" style="font-weight:bold;">Leave</div>
              </a>
             <ul class="menu-sub">
                <li class="menu-item">
                  <a href="leave_rquest" class="menu-link">
                    <div data-i18n="Account" >Annual Leave</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="other_leave" class="menu-link">
                    <div data-i18n="Notifications" >Others</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="leave_status" class="menu-link">
                    <div data-i18n="Connections" >My leave status</div>
                  </a>
                </li>
              </ul>
            </li>


<li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" style="font-weight:bold;">Memos</div>
              </a>
             <ul class="menu-sub">
                <li class="menu-item">
                  <a href="leave_rquest" class="menu-link">
                    <div data-i18n="Account" >New Memo</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="create_document" class="menu-link">
                    <div data-i18n="Notifications" >Viewed Memo</div>
                  </a>
                </li>
               
              </ul>
            </li>

            
             <li class="menu-item">
              <a href="" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >Attendance</div>
              </a>
              
            </li>
            
            
           
    
              
              
            
           
            
            
             <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >Document Manager</div>
              </a>
             <ul class="menu-sub">
                <li class="menu-item">
                  <a href="md_home" class="menu-link">
                    <div data-i18n="Account" >Home</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="create_document" class="menu-link">
                    <div data-i18n="Notifications" >Create File</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Connections" >Notifications</div>
                  </a>
                </li>
              </ul>
            </li>
            
            <!-- User interface -->
          

            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Registration</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="employer" class="menu-link">
                    <div data-i18n="Account" >New Employer</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="view-employers" class="menu-link">
                    <div data-i18n="Notifications" >All Employers</div>
                  </a>
                </li>
              
                 <li class="menu-item">
                  <a href="view-employers" class="menu-link">
                    <div data-i18n="Connections" >View Employers</div>
                  </a>
                </li>
              </ul>
            </li>
            
         
           
           
          </ul>
        </aside>
        <?php }elseif($role == 10){ ?>
        
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index" class="app-brand-link">
              <span class="app-brand-logo demo">
                   <img src="../ikl.png" style="width:60px; margin:0 auto;"  >
              </span>
             
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item " style="background-color:#50664d; border-color:#50664d;">
              <a href="index" class="menu-link">
                <i style="color:#fff" class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics" style="color:#fff;">Dashboard</div>
              </a>
            </li>
            
            <li class="menu-item">
              <a href="index" class="menu-link">
               
               <div data-i18n="Analytics" style="font-size:15px; font-weight:bold;"><?php echo  $myDepartment.' &nbsp; &nbsp;'.$myRole  ?></div>
              </a>
            </li>

      
           
 <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle active">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >Leave Approval Request</div>
              </a>
              <ul class="menu-sub">
                
                
                <li class="menu-item">
                  <a href="app_request" class="menu-link">
                    <div data-i18n="Badges" >New Request</div>
                  </a>
                </li>
                
               
                
              
                
               
                 <li class="menu-item">
                  <a href="approved_leaves" class="menu-link">
                    <div data-i18n="Notifications" >Approved Leaves</div>
                  </a>
                </li>
           
                
               
               
              </ul>
            </li>
            
            
            
                       
 <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle active">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >Leave Application</div>
              </a>
              <ul class="menu-sub">
                
               
                <li class="menu-item">
                  <a href="leave_rquest" class="menu-link">
                    <div data-i18n="Account" >Annual Leave</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="other_leave" class="menu-link">
                    <div data-i18n="Notifications" >Others</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="leave_status" class="menu-link">
                    <div data-i18n="Connections" >My leave status</div>
                  </a>
                </li>
               
              </ul>
            </li>
            
            
            
                 
             <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle active">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >Staff Management</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="new_staff" class="menu-link">
                    <div data-i18n="Account" >New Staff</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="manage_staff" class="menu-link">
                    <div data-i18n="Badges" >Manage Staff</div>
                  </a>
                </li>
                
             
                <li class="menu-item">
                  <a href="contact" class="menu-link">
                    <div data-i18n="Notifications" >Staff Contact</div>
                  </a>
                </li>
                
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Notifications" >Attendance List</div>
                  </a>
                </li>
                
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Notifications" >Displinary Cases</div>
                  </a>
                </li>
                
                 <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Notifications" >Projects</div>
                  </a>
                </li>
               
              </ul>
            </li>
            
             <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >Document Manager</div>
              </a>
             <ul class="menu-sub">
                <li class="menu-item">
                  <a href="md_home" class="menu-link">
                    <div data-i18n="Account" >Home</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="create_document" class="menu-link">
                    <div data-i18n="Notifications" >Create File</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="" class="menu-link">
                    <div data-i18n="Connections" >Notifications</div>
                  </a>
                </li>
              </ul>
            </li>
           
            
            
      
            
            
            
            
           
         
            <!-- User interface -->
           <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >Document Manager</div>
              </a>
             <ul class="menu-sub">
                <li class="menu-item">
                  <a href="md_home" class="menu-link">
                    <div data-i18n="Account" >Home</div>
                  </a>
                </li>
                
              </ul>
            </li>


            
            
             
            
           
            <!-- Extended components -->
            

           
            
           
            <!-- Tables -->
            
            
           
          </ul>
        </aside>
        
        <?php }elseif($role == 11){ ?>
        
                
         <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index" class="app-brand-link">
              <span class="app-brand-logo demo">
            <img src="../ikl.png" style="width:60px; align-item:center;"  >
              </span>
               
            </a>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
        
            <!-- Dashboard -->
           <li class="menu-item " style="background-color:#50664d; border-color:#50664d;">
              <a href="index" class="menu-link">
                <i style="color:#fff" class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics" style="color:#fff;">Dashboard</div>
              </a>
            </li>
            
            <li class="menu-item">
              <a href="index" class="menu-link">
               
                <div data-i18n="Analytics" style="font-size:15px; font-weight:bold;"><?php echo  $myDepartment.' &nbsp; &nbsp;'.$myRole  ?></div>
                
              </a>
              <hr>
            </li>

      
      
    
                
            
            <li class="menu-item">
              <a href="" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >Email</div>
              </a>
              
            </li>
            
            
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" style="font-weight:bold;">Registry</div>
              </a>
             <ul class="menu-sub">
                <li class="menu-item">
                  <a href="index" class="menu-link">
                    <div data-i18n="Account" >New Document</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="process_doc" class="menu-link">
                    <div data-i18n="Notifications" >Submitted Document</div>
                  </a>
                </li>
                
              </ul>
            </li>

            
            
             <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" style="font-weight:bold;">Leave</div>
              </a>
             <ul class="menu-sub">
                <li class="menu-item">
                  <a href="leave_rquest" class="menu-link">
                    <div data-i18n="Account" >Annual Leave</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="other_leave" class="menu-link">
                    <div data-i18n="Notifications" >Others</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="leave_status" class="menu-link">
                    <div data-i18n="Connections" >My leave status</div>
                  </a>
                </li>
              </ul>
            </li>



<li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" style="">Memos</div>
              </a>
             <ul class="menu-sub">
                <li class="menu-item">
                  <a href="view_memos" class="menu-link">
                    <div data-i18n="Account" >View Memos</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="create_document" class="menu-link">
                    <div data-i18n="Notifications" >All Memos</div>
                  </a>
                </li>
               
              </ul>
            </li>
            
            
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" style="">DTA & OPE's</div>
              </a>
             <ul class="menu-sub">
                <li class="menu-item">
                  <a href="new_dta" class="menu-link">
                    <div data-i18n="Account" >New DTA Request</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="submitted_dtas" class="menu-link">
                    <div data-i18n="Notifications" >Viewed DTA</div>
                  </a>
                </li>
               
              </ul>
            </li>
            
            
           
    
              
              
            
           
            
            
              <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings" >Document Manager</div>
              </a>
             <ul class="menu-sub">
                <li class="menu-item">
                  <a href="md_home" class="menu-link">
                    <div data-i18n="Account" >Home</div>
                  </a>
                </li>
                
              </ul>
            </li>

            
            <!-- User interface -->
          

            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Registration</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="employer" class="menu-link">
                    <div data-i18n="Account" >New Employer</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="view-employers" class="menu-link">
                    <div data-i18n="Notifications" >All Employers</div>
                  </a>
                </li>
              
                 <li class="menu-item">
                  <a href="view-employers" class="menu-link">
                    <div data-i18n="Connections" >View Employers</div>
                  </a>
                </li>
              </ul>
            </li>
            
         
           
           
          </ul>
        </aside>
         
 <script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5c5aed266cb1ff3c14cb5c37/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
        
        <?php } ?>
        