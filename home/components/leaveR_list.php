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

//$employees = $query->getRows("select a.*, b.*, c.* from leave_request as a, staff_tb as b, types_leave as c where a.staff_id = b.staffId and a.type=c.leaveT_id and a.supervisor_office = 2  ");
$stage = 1; //Supervisors should see leave request created by "USER" role
$staff =$_SESSION['staff'];
$staff_detail = $query->getRow("select departmentId from staff_tb where staffId= $staff");
$departmentid = $staff_detail['departmentId'];

$users_to_review = $query->getRows("select leave_request.leaveId as leave_id, staff_tb.staffId as staffid,
  CONCAT(staff_tb.firstname,' ',staff_tb.lastname) as fullname,types_leave.leave_name as leave_type,
  date_format(leave_request.date_start_new,'%M %e, %Y') as start_date,
  leave_request.num_days as num_days,leave_request.approve_status as approval_status,
  leave_request.createdAt as date_created from leave_request
  join types_leave on leave_request.type = types_leave.leaveT_id
  join staff_tb on leave_request.staff_id = staff_tb.staffId
  join leave_stage on leave_request.leaveId = leave_stage.leave_id
  where departmentId =$departmentid and staffId !=$staff and leave_stage.stage =$stage");


//if($payment !=1){
  //if ($rcount===$ucount){
       //     header("location:invoice");
    
     //   }
        
//}

?>
              <div class="card">
                <h5 class="card-header" style="font-size:30px;">New Leave Requests</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table id="tabulka_kariet1" class="table ">
                      <thead>
                        <tr>
                            <th>From (Staff)</th>
                             <th>Staff ID</th>
                          <th>Leave Type</th>
                          <th>Leave Commence Date</th>
                           <th>Requested Number Of Days</th>
                              <th>Request Date</th>
                           <th>Manage</th>
                        </tr>
                      </thead>
                      <tbody>
                           <?php foreach($users_to_review as $row): ?>
                        <tr>
                           <td><?php echo $row['fullname'];  ?></td>
                           <td><?php echo $row['staffid']; ?></td>
                               <td><?php echo $row['leave_type']; ?></td>
                          <td><?php echo $row['start_date']; ?></td>
                            <td><?php echo $row['num_days']; ?></td>
                            <td><?php echo $row['date_created']; ?></td>
                          <td>
                            <div class="dropdown">
                                  <a href="leave_review1?cert=<?php echo $row['leave_id'] ?>" type="button" style="color:white;" class="btn btn-primary">Review Leave</a>
                            </div>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>