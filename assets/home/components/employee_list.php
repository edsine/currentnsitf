<?php 
session_start();


require_once '../classes/manage.php';
$query = new Manage();








$employees = $query->getRows("select company_name, ecs_number,rc_number,bussiness_area, createdAt  from employer_tb limit 15"); 

?>
         <div class="card">
                <h5 class="card-header" style="font-size:30px;">Employers list</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table id="tabulka_kariet1" class="table ">
                      <thead>
                        <tr>
                            <th>Employer</th>
                          <th>ECS Number</th>
                          <th>RC Number</th>
                          <th>Business Type</th>
                          <th>Date Registered</th>
                        
                            
                   
                         
                           <th>Manage</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                         

                          <?php foreach($employees as $row){ ?>
                        <tr>
                         
                          <td><?php echo $row['company_name'] ?></td>
                          <td><?php echo $row['ecs_number'] ?></td>
                            <td><?php echo $row['rc_number'] ?></td>
                              <td><?php echo $row['bussiness_area'] ?></td>
                              <td><?php echo $row['createdAt'] ?></td>
                            
                    
                          <td>
                            <div class="dropdown">
                              <button
                                type="button"
                                class="btn p-0 dropdown-toggle hide-arrow"
                                data-bs-toggle="dropdown"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);"
                                  ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                >
                                <a class="dropdown-item" href="javascript:void(0);"
                                  ><i class="bx bx-trash me-1"></i> Delete</a
                                >
                              </div>
                            </div>
                          </td>
                        </tr>
                        
                        <?php } ?>
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>