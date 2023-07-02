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

/*$employees = $query->getRows("select a.*, b.*, c.*, d.* from leave_request as a, staff_tb as b, types_leave as c, leave_review as d where a.staff_id = b.staffId and a.type=c.leaveT_id and a.leaveId=d.leave_id and a.supervisor_office = 1 ");*/
$staff =$_SESSION['staff'];
$employees = $query->getRows("select concat(staff_tb.firstname, ' ',staff_tb.lastname) as fullname, leave_request.num_days as requested_days, types_leave.leave_name as leave_name,date_format(leave_request.date_start_new, '%M %e, %Y') as start_date, date_format(leave_review.approved_date, '%M %e, %Y') as approved_date, leave_request.leaveId as leaveId, leave_review.approved_days as approved_days,leave_name, leave_review.updatedAt as review_date, (case leave_stage.leave_status when 0 then 'Suspended' when 2 then 'Approved' when 1 then 'In Progress' end) as leave_status from leave_request
  join staff_tb on leave_request.staff_id = staff_tb.staffId
  join types_leave on leave_request.type = types_leave.leaveT_id
  join leave_review on leave_request.leaveId = leave_review.leave_id
  join leave_stage on leave_request.leaveId = leave_stage.leave_id where leave_review.officer_id =$staff");


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
                          <th>Leave Approved Date</th>
                           <th>Requested Days</th>
                            <th>Approved Days</th>
                              <th>Review Date</th>
                              <th>Leave Status</th>
                           <th>Manage</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                         

                          <?php foreach($employees as $row){ 
                          
                          $ap = $row['approve_status']
                          ?>
                        <tr>
                           <td><?php echo $row['fullname']; ?></td>
                    
                               <td><?php echo $row['leave_name'] ?></td>
                          <td><?php echo $row['start_date'] ?></td>
                          <td><?php echo $row['approved_date'] ?></td>
                            <td><?php echo $row['requested_days'] ?></td>
                            
                             <td><?php echo $row['approved_days'] ?></td>
                            
                            <td><?php echo $row['review_date'] ?></td>
                            <td><span class="badge bg-label-primary me-1"> <?php echo $row['leave_status'] ?></span></td>
                          <td>
                            <div class="dropdown">
                                  <a href="hod_edit_leave_request?cert=<?php echo $row['leaveId'] ?>" type="button" class="btn btn-primary" style="color:white;">Edit Review</a>
                                   
                                   
                                     <a href="hod_suspend_leave_request?cert=<?php echo $row['leaveId'] ?>" type="button" class="btn btn-primary" style="color:white">Suspend Review</a>
                                   
                            </div>
                          </td>
                        </tr>
                        
                        <?php } ?>
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>