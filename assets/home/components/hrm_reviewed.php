<?php 
session_start();

if(!isset($_SESSION['admin-log'])){
    header("location:../");
}


require_once '../classes/manage.php';
$query = new Manage();








//$employees = $query->getRows("select firstname, lastname, phone, branchId, roles   from staff_tb"); 


//$uploadCount = $query->getRow("select count(rc_uploadId) as upCount from upload_requirement where artisan_id = $artisan"); 

//$rcount = $recCount['recCount'];
//$ucount = $uploadCount['upCount'];

$employees = $query->getRows("select a.*, b.*, c.* from leave_request as a, staff_tb as b, types_leave as c where a.staff_id = b.staffId and a.type=c.leaveT_id  and a.supervisor_office = 1 and a.md_hr = 1 ");

//if($payment !=1){
  //if ($rcount===$ucount){
       //     header("location:invoice");
    
     //   }
        
//}

?>
         <div class="card">
                <h5 class="card-header" style="font-size:30px;">Reviewed Leaves</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table id="tabulka_kariet1" class="table ">
                      <thead>
                        <tr>
                            <th>From (Staff)</th>
                             
                          <th>Leave Type</th>
                    
                          <th>Leave Commence Date</th>
                           <th>Requested Days</th>
                           
                            <th>Approved Days</th>
                         
                            
                              <th>Review Date</th>
                          
                        
                          
                         
                        
                           <th>Manage</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                         

                          <?php foreach($employees as $row){ 
                          
                          $ap = $row['approve_status']
                          ?>
                        <tr>
                           <td><?php echo $row['firstname']. ' &nbsp;'.$row['lastname']  ?></td>
                    
                               <td><? echo $row['leave_name'] ?></td>
                          <td><?php echo $row['date_start_new'] ?></td>
                            <td><?php echo $row['num_days'] ?></td>
                            
                             <td><?php echo $row['approved_days'] ?></td>
                            
                            <td><?php echo $row['createdAt'] ?></td>
                            
                            
                    
                          
                          <td>
                            <div class="dropdown">
                                 
                                   
                                   
                                     <a href="leave_review1?cert=<?php echo $row['leaveId'] ?>" type="button" class="btn btn-primary">Suspend Review</a>
                                   
                            </div>
                          </td>
                        </tr>
                        
                        <?php } ?>
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>