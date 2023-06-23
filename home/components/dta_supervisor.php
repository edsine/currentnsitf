<?php 
session_start();

if(!isset($_SESSION['admin-log'])){
    header("location:../");
}



$employer = 1004033022 ;
require_once '../classes/manage.php';
$query = new Manage();






$staff =$_SESSION['staff'] ;

$role = $_SESSION['role'] ;

$branch = $_SESSION['branch'];


if($role == 9){


$employees = $query->getRows("select a.*, b.* from dta_request as a, staff_tb as b where a.staffId= b.staffId and a.branchId = $branch ");



?>
         <div class="card">
                <h5 class="card-header" style="font-size:25px;">DTA Applications <span style="font-size:14px;"></span></h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table id="tabulka_kariet1" class="table ">
                      <thead>
                        <tr>
                             <th>From</th>
                            <th>Purpose_travel</th>
                          <th>Destination</th>
                            <th>Number of days</th>
                              <th>Travel date</th>
                                <th>Arrival date</th>
                                 <th>estimated Expenses</th>
                          
                   
                              
                          
                           <th>Application Date </th>
                            <th>Action </th>

                          
                        
                          
                         
                        
                          
                        </tr>
                      </thead>
                      <tbody>
                         

                          <?php foreach($employees as $row){ 
                          
                          $ap = $row['approve_status'];
                           $supervisor = $row['supervisor_status'];
                            $md = $row['md_hr'];
                            
                             $name = $row['firstname'].' '.$row['lastname'];
                             $leaveOff = $row['leave_officer'];
                          ?>
                        <tr>
                            
                            <td><?php echo $name ?></td>
                             <td><?php echo $row['purpose_travel'] ?></td>
                               <td><? echo $row['destination'] ?></td>
                               <td><? echo $row['number_days'] ?></td>
                               
                                <td><? echo $row['travel_date'] ?></td>
                                 <td><? echo $row['arrival_date'] ?></td>
                                 
                                 <td><? echo $row['estimated_expenses'] ?></td>
                            
    
                              
                             
                              
                              
                              
                     <td><?php echo $row['createdAt'] ?></td>
                          
                          <td>
                            <div class="dropdown">
                                  <a href="dtas_review?staff=<?php echo $row['dta_id'] ?>" type="button"  class="btn btn-primary">Review Leave</a>
                                   
                            </div>
                          </td>
                        </tr>
                        
                        <?php } ?>
                       
                       
                      </tbody>
                      
                    </table>
                    
                    
                  </div>
                </div>
              </div>
              
              <?php }elseif($role == 3){
              
              $employees = $query->getRows("select a.*, b.* from dta_request as a, staff_tb as b where a.staffId= b.staffId and a.branchId = $branch and a.supervisor_status=1");
              
             
              
              




?>
         <div class="card">
                <h5 class="card-header" style="font-size:25px;">DTA Applications  <span style="font-size:14px;"></span></h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table id="tabulka_kariet1" class="table ">
                      <thead>
                        <tr>
                             <th>From</th>
                            <th>Purpose_travel</th>
                          <th>Destination</th>
                            <th>Number of days</th>
                              <th>Travel date</th>
                                <th>Arrival date</th>
                                 <th>estimated Expenses</th>
                          
                   
                              
                          
                           <th>Application Date </th>
                            <th>Action </th>

                          
                        
                          
                         
                        
                          
                        </tr>
                      </thead>
                      <tbody>
                         

                          <?php foreach($employees as $row){ 
                          
                          $ap = $row['approve_status'];
                           $supervisor = $row['supervisor_status'];
                            $md = $row['md_hr'];
                            
                             $name = $row['firstname'].' '.$row['lastname'];
                             $leaveOff = $row['leave_officer'];
                          ?>
                        <tr>
                            
                            <td><?php echo $name ?></td>
                             <td><?php echo $row['purpose_travel'] ?></td>
                               <td><? echo $row['destination'] ?></td>
                               <td><? echo $row['number_days'] ?></td>
                               
                                <td><? echo $row['travel_date'] ?></td>
                                 <td><? echo $row['arrival_date'] ?></td>
                                 
                                 <td><? echo $row['estimated_expenses'] ?></td>
                            
    
                              
                             
                              
                              
                              
                     <td><?php echo $row['createdAt'] ?></td>
                          
                          <td>
                            <div class="dropdown">
                                  <a href="dtas_review?staff=<?php echo $row['dta_id'] ?>" type="button"  class="btn btn-primary">Review/Approval </a>
                                   
                            </div>
                          </td>
                        </tr>
                        
                        <?php } ?>
                       
                       
                      </tbody>
                      
                    </table>
                    
                    
                  </div>
                </div>
              </div>
              <?php }elseif($role == 1){   
                  
                  $employees = $query->getRows("select a.*, b.* from dta_request as a, staff_tb as b where a.staffId= b.staffId and a.branchId = $branch and a.supervisor_status=1 and a.hod_status=1");
              
             
              
              




?>
         <div class="card">
                <h5 class="card-header" style="font-size:25px;">DTA Applications  <span style="font-size:14px;"></span></h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table id="tabulka_kariet1" class="table ">
                      <thead>
                        <tr>
                             <th>From</th>
                            <th>Purpose_travel</th>
                          <th>Destination</th>
                            <th>Number of days</th>
                              <th>Travel date</th>
                                <th>Arrival date</th>
                                 <th>estimated Expenses</th>
                          
                   
                              
                          
                           <th>Application Date </th>
                            <th>Action </th>

                          
                        
                          
                         
                        
                          
                        </tr>
                      </thead>
                      <tbody>
                         

                          <?php foreach($employees as $row){ 
                          
                          $ap = $row['approve_status'];
                           $supervisor = $row['supervisor_status'];
                            $md = $row['md_hr'];
                            
                             $name = $row['firstname'].' '.$row['lastname'];
                             $leaveOff = $row['leave_officer'];
                          ?>
                        <tr>
                            
                            <td><?php echo $name ?></td>
                             <td><?php echo $row['purpose_travel'] ?></td>
                               <td><? echo $row['destination'] ?></td>
                               <td><? echo $row['number_days'] ?></td>
                               
                                <td><? echo $row['travel_date'] ?></td>
                                 <td><? echo $row['arrival_date'] ?></td>
                                 
                                 <td><? echo $row['estimated_expenses'] ?></td>
                            
    
                              
                             
                              
                              
                              
                     <td><?php echo $row['createdAt'] ?></td>
                          
                          <td>
                            <div class="dropdown">
                                  <a href="dtas_review?staff=<?php echo $row['dta_id'] ?>" type="button"  class="btn btn-primary">Review/Approval </a>
                                   
                            </div>
                          </td>
                        </tr>
                        
                        <?php } ?>
                       
                       
                      </tbody>
                      
                    </table>
                    
                    
                  </div>
                </div>
              </div>
              
              <?php }elseif($role == 4){   
              
              
              $employees = $query->getRows("select a.*, b.* from dta_request as a, staff_tb as b where a.staffId= b.staffId and a.branchId = $branch and a.supervisor_status=1 and a.hod_status=1 and md_status=1");
              
             
              
              




?>
         <div class="card">
                <h5 class="card-header" style="font-size:20px;">DTA Approval Request <span style="font-size:14px;"></span></h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table id="tabulka_kariet1" class="table ">
                      <thead>
                        <tr>
                             <th>From</th>
                            <th>Purpose_travel</th>
                          <th>Destination</th>
                            <th>Number of days</th>
                              <th>Travel date</th>
                                <th>Arrival date</th>
                                 <th>estimated Expenses</th>
                          
                   
                              
                          
                           <th>Application Date </th>
                            <th>Action </th>

                          
                        
                          
                         
                        
                          
                        </tr>
                      </thead>
                      <tbody>
                         

                          <?php foreach($employees as $row){ 
                          
                          $ap = $row['approve_status'];
                           $supervisor = $row['supervisor_status'];
                            $md = $row['md_hr'];
                            
                             $name = $row['firstname'].' '.$row['lastname'];
                             $leaveOff = $row['leave_officer'];
                          ?>
                        <tr>
                            
                            <td><?php echo $name ?></td>
                             <td><?php echo $row['purpose_travel'] ?></td>
                               <td><? echo $row['destination'] ?></td>
                               <td><? echo $row['number_days'] ?></td>
                               
                                <td><? echo $row['travel_date'] ?></td>
                                 <td><? echo $row['arrival_date'] ?></td>
                                 
                                 <td><? echo $row['estimated_expenses'] ?></td>
                            
    
                              
                             
                              
                              
                              
                     <td><?php echo $row['createdAt'] ?></td>
                          
                          <td>
                            <div class="dropdown">
                                  <a href="dtas_review?staff=<?php echo $row['dta_id'] ?>" type="button"  class="btn btn-primary">Review/Approval </a>
                                   
                            </div>
                          </td>
                        </tr>
                        
                        <?php } ?>
                       
                       
                      </tbody>
                      
                    </table>
                    
                    
                  </div>
                </div>
              </div> 
              
              <?php } ?>
              
              