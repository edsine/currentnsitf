<?php 
session_start();




$employer = 1004033022 ;
require_once '../classes/manage.php';
$query = new Manage();






$branch = $_SESSION['branch'];


$employees = $query->getRows("select * from employer_tb where branchId = $branch and inspection_status = 0  limit 15");


?>
         <div class="card">
                <h5 class="card-header" style="font-size:30px;">Employers Inspection List</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table id="tabulka_kariet1" class="table " style="font-size:18px">
                      <thead>
                        <tr>
                            <th>Employer</th>
                          <th>Email Address</th>
                           <th>Phone NUmber</th>
                         <th>Positon</th>
                      
                          
                        
                          
                         
                        
                           <th>Manage</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                         

                          <?php foreach($employees as $row){ ?>
                        <tr>
                           <td><?php echo $row['company_name'] ?></td>
                          <td><?php echo $row['c_email'] ?></td>
                            <td><?php echo $row['desk_phone'] ?></td>
                              <td><?php echo $row['desk_position'] ?></td>
                             
                            
                    
                          <td>
                            <div class="dropdown">
                                  <a href="ins_review?employer=<?php echo $row['employer_id'] ?>" type="button" class="btn btn-primary">Review & Report</a>
                                    
                                    <a href="" type="button" class="btn btn-primary">DECLINE</a>
                           
                            </div>
                          </td>
                        </tr>
                        
                        <?php } ?>
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>