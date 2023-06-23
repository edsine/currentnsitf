<?php 
session_start();

if(!isset($_SESSION['admin-log'])){
    header("location:../");
}



$employer = 1004033022 ;
require_once '../classes/manage.php';
$query = new Manage();






$staff =$_SESSION['staff'] ;



$employees = $query->getRows("select * from dta_request where staffId = $staff ");



?>
         <div class="card">
                <h5 class="card-header" style="font-size:25px;">DTA Application Status <span style="font-size:14px;">(You can even see the progress on your email.)</span></h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table id="tabulka_kariet1" class="table ">
                      <thead>
                        <tr>
                            <th>Purpose_travel</th>
                          <th>Destination</th>
                          
                   
                              <th>Supervissor Review </th>
                              
                                <th>HOD Review </th>
                                
                                  <th>HOD Review </th>
                                  
                                    <th>Account Review </th>
               
                          
                           <th>Application Date </th>

                          
                        
                          
                         
                        
                          
                        </tr>
                      </thead>
                      <tbody>
                         

                          <?php foreach($employees as $row){ 
                          
                          $ap = $row['approve_status'];
                           $supervisor = $row['supervisor_status'];
                            $md = $row['md_hr'];
                             $leaveOff = $row['leave_officer'];
                          ?>
                        <tr>
                             <td><?php echo $row['purpose_travel'] ?></td>
                               <td><? echo $row['destination'] ?></td>
                            
                            
                             <td>  <?php if($supervisor == 2){  ?>
                              
                            <span class="badge bg-label-primary me-1">IN PROGRESS</span>
                              <?php }elseif($supervisor == 1){ ?>
                              
                              <span class="badge bg-label-primary me-1">DONE</span>
                              
                              <a href="">View Review</a>
                              
                              <?php } ?>
                              </td>
                               
                              
                              
                              
                              
                                 
                              <td>  <?php if($md == 0){  ?>
                              
                            <span class="badge bg-label-primary me-1">PENDING</span>
                              <?php }else{ ?>
                              
                              <span class="badge bg-label-primary me-1">DONE</span>
                               <a href="">View Review</a>
                              <?php } ?>
                              </td>
                              
                              
                              
                              <td>  <?php if($md == 0){  ?>
                              
                            <span class="badge bg-label-primary me-1">PENDING</span>
                              <?php }else{ ?>
                              
                              <span class="badge bg-label-primary me-1">DONE</span>
                               <a href="">View Review</a>
                              <?php } ?>
                              </td>
                              
                              
                              <td>  <?php if( $leaveOff == 0){  ?>
                              
                            <span class="badge bg-label-primary me-1">PENDING</span>
                              <?php }else{ ?>
                              
                              <span class="badge bg-label-primary me-1">APPROVED</span>
                              
                              <a href="">Print Leave Slip</a>
                              <?php } ?>
                              </td>
                              
                              
                              
                     <td><?php echo $row['createdAt'] ?></td>
                          
                         
                        </tr>
                        
                        <?php } ?>
                       
                       
                      </tbody>
                      
                    </table>
                    
                    
                  </div>
                </div>
              </div>