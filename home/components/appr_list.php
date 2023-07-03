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

/*$employees = $query->getRows("select a.*, b.*, c.* from leave_request as a, staff_tb as b, types_leave as c where a.staff_id = b.staffId and a.type=c.leaveT_id and a.supervisor_office = 1 and a.md_hr=1  ");*/

$stage = 3; //HR Should see request approved by HOD
$staff =$_SESSION['staff'];
$users_to_approve = $query->getRows("select leave_request.leaveId as leave_id, staff_tb.staffId as staffid,
  CONCAT(staff_tb.firstname,' ',staff_tb.lastname) as fullname,types_leave.leave_name as leave_type,
  date_format(leave_request.date_start_new,'%M %e, %Y') as start_date,
  leave_request.num_days as num_days,leave_request.approve_status as approval_status,
  leave_request.createdAt as date_created, date_format(leave_review.approved_date, '%M %e, %Y') as approved_date from leave_request
  join types_leave on leave_request.type = types_leave.leaveT_id
  join staff_tb on leave_request.staff_id = staff_tb.staffId
  join leave_stage on leave_request.leaveId = leave_stage.leave_id
  join leave_review on leave_request.leaveId = leave_review.leave_id
  where staffId !=$staff and leave_stage.stage =$stage");

//if($payment !=1){
  //if ($rcount===$ucount){
       //     header("location:invoice");
    
     //   }
        
//}

?>
         <div class="card">
                <h5 class="card-header" style="font-size:30px;">Leave Requests</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table id="tabulka_kariet1" class="table ">
                      <thead>
                        <tr>
                            <th>From (Staff)</th>
                    
                          <th>Leave Type</th>
                    
                          <th>Leave Commence Date</th>
                          <th>Date Approved</th>
                           <th>Requested Number Of Days</th>
                              <th>Request Date</th>
                           <th>Manage</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                         

                          <?php foreach($users_to_approve as $row){ 
                          
                          $ap = $row['approve_status']
                          ?>
                        <tr>
                           <td><?php echo $row['fullname'];  ?></td>
                        
                               <td><?php echo $row['leave_type'] ?></td>
                          <td><?php echo $row['start_date'] ?></td>
                          <td><?php echo $row['approved_date'] ?></td>
                            <td><?php echo $row['num_days'] ?></td>
                            
                            <td><?php echo $row['date_created'] ?></td>

                          <td>
                            <div class="dropdown">
                                  <a href="approval_review?cert=<?php echo $row['leave_id'] ?>" type="button" class="btn btn-primary">Review/Approve</a>
                                   
                            </div>
                          </td>
                        </tr>
                        
                        <?php } ?>
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>