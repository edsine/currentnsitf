<?php 
session_start();

if(!isset($_SESSION['admin-log'])){
    header("location:../");
}



$employer = 1004033022 ;
require_once '../classes/manage.php';
$query = new Manage();








//$employees = $query->getRows("select firstname, lastname, phone, branchId, roles   from staff_tb"); 


//$uploadCount = $query->getRow("select count(rc_uploadId) as upCount from upload_requirement where artisan_id = $artisan"); 

//$rcount = $recCount['recCount'];
//$ucount = $uploadCount['upCount'];

$employees = $query->getRows("select a.*, b.* from leave_request as a, staff_tb as b where a.staff_id = b.staffId  ");

//if($payment !=1){
  //if ($rcount===$ucount){
       //     header("location:invoice");
    
     //   }
        
//}

?>
         <div class="card">
                <h5 class="card-header" style="font-size:30px;">Staff list</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table id="tabulka_kariet1" class="table ">
                      <thead>
                        <tr>
                            <th>Full Name</th>
                          <th>Reasons For leave</th>
                          <th>Start Date</th>
                          <th>End Date</th>
<th>Leave Status</th>
                          
                        
                          
                         
                        
                           <th>Manage</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                         

                          <?php foreach($employees as $row){ 
                          
                          $ap = $row['approve_status']
                          ?>
                        <tr>
                           <td><?php echo $row['firstname'] ?></td>
                               <td><? echo $row['reasons'] ?></td>
                          <td><?php echo $row['start_date'] ?></td>
                            <td><?php echo $row['end_date'] ?></td>
                            
                             <td>  <?php if($ap == 0){  ?>
                              
                            <span class="badge bg-label-primary me-1">PENDING</span>
                              <?php }else{ ?>
                              
                              <span class="badge bg-label-primary me-1">APPROVED</span>
                              <?php } ?>
                              </td>
                              
                    
                          
                          <td>
                            <div class="dropdown">
                                  <a href="components/approve_leave?cert=<?php echo $row['leaveId'] ?>" type="button" class="btn btn-primary">DETAILS</a>
                                    <a href="" type="button" class="btn btn-primary">APPROVE</a>
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