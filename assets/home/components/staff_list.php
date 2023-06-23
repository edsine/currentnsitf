<?php 
session_start();




$employer = 1004033022 ;
require_once '../classes/manage.php';
$query = new Manage();



$employees = $query->getRows("select a.*, b.*, c.* from staff_tb as a, all_branch as b, roles as c where a.branchId = b.branch_id and  a.roles=c.roles_id");

?>
         <div class="card">
                <h5 class="card-header" style="font-size:30px;">Staff list</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table id="tabulka_kariet1" class="table ">
                      <thead>
                        <tr>
                            <th>Full Name</th>
                          <th>Email Address</th>
                           <th>Phone NUmber</th>
                          <th>Branch</th>
                          <th>Current Role</th>
                          
                        
                          
                         
                          <th>Status</th>
                           <th>Manage</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                         

                          <?php foreach($employees as $row){ ?>
                        <tr>
                           <td><?php echo $row['firstname']. ' '. $row['lastname'] ?></td>
                          <td><?php echo $row['staff_email'] ?></td>
                            <td><?php echo $row['phone'] ?></td>
                              <td><?php echo $row['branch_name'] ?></td>
                              <td><?php echo $row['role'] ?></td>
                            
                    
                          <td><span class="badge bg-label-primary me-1">Active</span></td>
                          <td>
                            <div class="dropdown">
                             <a  href="change_role?id=<?php echo $row['staffId'] ?>"> Change Role</a>&nbsp;||
                              <a  href="components/delete_user?id=<?php echo $row['staffId'] ?>" style="color:red;"> Deactivate Staff</a>
                            </div>
                          </td>
                        </tr>
                        
                        <?php } ?>
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>