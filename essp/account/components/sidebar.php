<?php
session_start();

$val = $_SESSION['val'];

?>
<?php 


if($val == 0){
?>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index" class="app-brand-link">
            
              <img src="../ikl.png" style="width:50px;" >
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
                <i class="menu-icon tf-icons bx bx-home-circle"  style="color:#fff;"></i>
                <div data-i18n="Analytics"  style="color:#fff;">Dashboard</div>
              </a>
            </li>

            <!-- Layouts -->
           

            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Complete Your Registration Fee Payment To Continue</span>
            </li>
            
            
            
             <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Generated Invoice</div>
              </a>
              <ul class="menu-sub">
                 
                
                <li class="menu-item">
                  <a href="view_payments" class="menu-link">
                    <div data-i18n="Connections">View Invoice</div>
                  </a>
                </li>
              </ul>
            </li>
            
            
            
            

            <!-- Extended components -->
          
           

            <!-- Forms & Tables -->
           
          
            <!-- Tables -->
           
           
          </ul>
        </aside>
        
        <?php
        
}  else { 
        ?>
        
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index" class="app-brand-link">
            
              <img src="../ikl.png" style="width:50px;" >
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item "  style="background-color:#50664d; border-color:#50664d;">
              <a href="index" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle" style="color:#fff;"></i>
                <div data-i18n="Analytics" style="color:#fff;">Dashboard</div>
              </a>
            </li>

            <!-- Layouts -->
           

            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Admin</span>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <box-icon name='user'></box-icon>
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Account Settings">Manage Employee</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="employee" class="menu-link">
                    <div data-i18n="Account">Add Employee (Staff)</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="view-employees" class="menu-link">
                    <div data-i18n="Notifications">View Employee</div>
                  </a>
                </li>
                
                
               
              </ul>
            </li>
            
            
            
             <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Payments</div>
              </a>
              <ul class="menu-sub">
                 
                
                <li class="menu-item">
                  <a href="ecs" class="menu-link">
                    <div data-i18n="Notifications">ECS Payments</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="view_payments" class="menu-link">
                    <div data-i18n="Connections">View Payments</div>
                  </a>
                </li>
              </ul>
            </li>
            
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Certificate Request</div>
              </a>
              <ul class="menu-sub">
                  <li class="menu-item">
                  <a href="certificate_request" class="menu-link">
                    <div data-i18n="Account"><span>Request for certificate</span></div>
                  </a>
                </li>
               
                <li class="menu-item">
                  <a href="request_status" class="menu-link">
                    <div data-i18n="Notifications">Check Status</div>
                  </a>
                </li>
                
              </ul>
            </li>
            
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Claims & Compensation</div>
              </a>
              <ul class="menu-sub">
                  <li class="menu-item">
                  <a href="accident_claim" class="menu-link">
                    <div data-i18n="Account"><span>Claim For Accident</span></div>
                  </a>
                </li>
                
                
                 <li class="menu-item">
                  <a href="occupational_claim" class="menu-link">
                    <div data-i18n="Account"><span>Claim For Occupational Diseases</span></div>
                  </a>
                </li>
                
                 <li class="menu-item">
                  <a href="death_claim" class="menu-link">
                    <div data-i18n="Account"><span>Claim For Death</span></div>
                  </a>
                </li>
                
                <li class="menu-item">
                  <a href="claims" class="menu-link">
                    <div data-i18n="Account"><span>View Claims</span></div>
                  </a>
                </li>
               
               
                
              </ul>
            </li>
            
             
      

            <!-- Extended components -->
          
           

            <!-- Forms & Tables -->
           
          
            <!-- Tables -->
           
           
          </ul>
        </aside>
        
        <?php } ?>