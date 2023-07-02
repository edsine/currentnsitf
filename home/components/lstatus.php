<?php 
session_start();

if(!isset($_SESSION['admin-log'])){
    header("location:../");
}



$employer = 1004033022 ;
require_once '../classes/manage.php';
$query = new Manage();






$staff =$_SESSION['staff'] ;



$employees = $query->getRows("select a.*, b.*, c.* from leave_request as a, staff_tb as b, types_leave as c where a.staff_id = b.staffId and a.type= c.leaveT_id and a.staff_id = $staff order by a.leaveId asc ");



?>
         <div class="card">
                <h5 class="card-header" style="font-size:30px;">Leave Status</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table id="tabulka_kariet1" class="table ">
                      <thead>
                        <tr>
                            <th>Leave Type</th>
                          <th>Commence Date</th>
                          <th>Number Of Days</th>
                          <th>Officer to Relieve</th>
                          
                          <th>Supervisor Review (status) </th>
                          
                          <th>MD HR Review (status) </th>
                          
                          <th> Leave Officer HR xApprovalsttus) </th>
                          
                           <th>Application Date </th>

                          
                        
                          
                         
                        
                          
                        </tr>
                      </thead>
                      <tbody>
                         

                          <?php foreach($employees as $row){ 
                         
                          $ap = $row['approve_status'];
                           $supervisor = $row['supervisor_office'];
                            $md = $row['md_hr'];
                             $leaveOff = $row['leave_officer'];
                          ?>
                        <tr>
                             <td><?php echo $row['leave_name'] ?></td>
                               <td><?php echo $row['date_start_new'] ?></td>
                            <td><?php echo $row['num_days'] ?></td>
                            <td><?php echo $row['firstname'].' '.$row['lastname'] ?></td>
                            
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