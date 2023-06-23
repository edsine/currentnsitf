<?php 
session_start();




$employer = 1004033022 ;
require_once '../classes/manage.php';
$query = new Manage();








$employees = $query->getRows("select company_name, ecs_number,rc_number,bussiness_area, createdAt  from employer_tb limit 15"); 


//$uploadCount = $query->getRow("select count(rc_uploadId) as upCount from upload_requirement where artisan_id = $artisan"); 

//$rcount = $recCount['recCount'];
//$ucount = $uploadCount['upCount'];

//$prequest = $query->getRows("select a.*, b.* from service_request as a, states as b where a.clientId = b.id and  a.artisanId=$artisan");

//if($payment !=1){
  //if ($rcount===$ucount){
       //     header("location:invoice");
    
     //   }
        
//}

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
                        
                          <th>Payment Status</th>
                         
                        
                          
                    
                          <th>Status</th>
                          <th>Action</th>
                           <th>Manage</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                         

                          <?php foreach($employees as $row){ ?>
                        <tr>
                         
                          <td><?php echo $row['company_name'] ?></td>
                          <td><?php echo $row['ecs_number'] ?></td>
                            <td><?php echo $row['rc_number'] ?></td>
            
                               <td> <?php echo $row['rc_number'] ?></td>
                            
                       
                          <td><span class="badge bg-label-primary me-1">Active</span></td>
                          
                           <td><a href="" type="button" class="btn btn-primary">Pay</a> 
                           
                             <a href="" type="button" class="btn btn-primary">Decline</a>
                           </td>
                           
                          
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