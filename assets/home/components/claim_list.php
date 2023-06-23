<?php 
session_start();


require_once '../classes/manage.php';
$query = new Manage();




$branch = $_SESSION['branch'];

$claims = $query->getRows("select a.*, b.*, c.* from claims_tb as a, employees as b , employer_tb as c where a.employeeId = b.employee_id and b.employer_id = c.employer_id and c.branchId=$branch"); 


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
                <h5 class="card-header" style="font-size:30px;"> Claims Notification</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table id="tabulka_kariet1" class="table ">
                      <thead>
                        <tr>
                            <th>Employer</th>
                          <th>Payment Type</th>
                          <th>Amount</th>
                          
                           <th>Payment Status</th>
                          <th>Approve Status</th>
                           <th>Payment Time</th>
                     
                        
                          
                    
                          <th>Action</th>
                           <th>Manage</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                         

                          <?php foreach($claims as $row){ 
                         $ap = $row['payment_approve'];
                          $pay = $row['approve_status'] ;
                          
                          ?>
                        <tr>
                         
                          <td><?php echo $row['company_name'] ?></td>
                          <td><?php echo $row['payment_name'] ?></td>
                            <td><?php echo $row['amount'] ?></td>
                            
                            <td><?php echo $row['payment_status'] ?></td>
                            
                            
                            
                              
                              <td>  <?php if($ap == 0){  ?>
                              
                            <span class="badge bg-label-primary me-1">PENDING</span>
                              <?php }else{ ?>
                              
                              <span class="badge bg-label-primary me-1">APPROVED</span>
                              <?php } ?>
                              </td>
                              
                               <td><?php echo $row['payment_time'] ?></td>
                              
                            
                       
                        
                               <td>
                        <?php if($ap == 0){  ?>
                              
                           <a onMouseOver="this.style.color='orange'"
   onMouseOut="this.style.color='#fff'"  href="components/approve_payment?cert=<?php echo $row['transactionId'] ?>" type="button" class="btn btn-primary">APPROVE</a> 
                              <?php }else{ ?>
                              
                               <a href="" type="button" class="btn btn-primary">DETAILS</a>
                              <?php } ?>
                            
                           
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