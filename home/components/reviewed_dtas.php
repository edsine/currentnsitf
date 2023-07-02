<?php 
session_start();

if(!isset($_SESSION['admin-log'])){
  header("location:../");
}



$employer = 1004033022 ;
require_once '../classes/manage.php';
$query = new Manage();




$role =$_SESSION['role'] ;


$staff =$_SESSION['staff'] ;

$branch = $_SESSION['branch'];

if($role == 9){

  // $employees = $query->getRows("select a.*, b.* from dta_request as a, staff_tb as b where a.staffId= b.staffId and a.branchId = $branch and a.supervisor_status=1");
  $employees = $query->getRows("select dta_id, hod_status, approval_status, supervisor_status, purpose_travel, destination, number_days, travel_date, arrival_date, estimated_expenses, dta_request.createdAt, staff_tb.firstname, staff_tb.lastname, md_status from dta_request join staff_tb on dta_request.staffId = staff_tb.staffId join units on staff_tb.departmentId = units.department_id where units.unit_head = $staff and dta_request.supervisor_status = 1")


  ?>
  <div class="card">
    <h5 class="card-header" style="font-size:25px;">Reviewed DTA Requests (Supervisor)<span style="font-size:14px;"></span></h5>
    <div class="card-body">
      <div class="table-responsive text-nowrap">
        <table id="tabulka_kariet1" class="table ">
          <thead>
            <tr>
             <th>From</th>
             <th>Purpose_travel</th>
             <th>Destination</th>
             <th>Number of days</th>
             <th>Travel date</th>
             <th>Arrival date</th>
             <th>estimated Expenses</th>
             <th>Application Date </th>
             <th>Action </th>        

           </tr>
         </thead>
         <tbody>


          <?php foreach($employees as $row){ 

            $ap = $row['approve_status'];
            $supervisor = $row['supervisor_status'];
            $md = $row['md_hr'];

            $name = $row['firstname'].' '.$row['lastname'];
            $leaveOff = $row['leave_officer'];
            ?>
            <tr>

              <td><?php echo $name ?></td>
              <td><?php echo $row['purpose_travel'] ?></td>
              <td><?php echo $row['destination'] ?></td>
              <td><?php echo $row['number_days'] ?></td>

              <td><?php echo $row['travel_date'] ?></td>
              <td><?php echo $row['arrival_date'] ?></td>

              <td><?php echo $row['estimated_expenses'] ?></td>







              <td><?php echo $row['createdAt'] ?></td>

              <td>
                <div class="dropdown">
                  <!-- <a href="dtas_review?staff=<?php echo $row['dta_id'] ?>" type="button"  class="btn btn-primary">Edit Review</a> -->
                   <?php if ($row['supervisor_status'] == 0) { ?>
                    <a href="dtas_review?staff=<?php echo $row['dta_id'] ?>" type="button"  class="btn btn-primary">Review DTA</a>
                  <?php } else { echo "Approved"; } ?>

                </div>
              </td>
            </tr>

          <?php } ?>


        </tbody>

      </table>


    </div>
  </div>
</div>

<?php }elseif($role == 3) {

 $employees = $query->getRows("select dta_id, hod_status, approval_status, supervisor_status, purpose_travel, destination, number_days, travel_date, arrival_date, estimated_expenses, dta_request.createdAt, staff_tb.firstname, staff_tb.lastname, md_status from dta_request join staff_tb on dta_request.staffId = staff_tb.staffId where  dta_request.supervisor_status=1 AND dta_request.hod_status = 1");

 ?>
 <div class="card">
  <h5 class="card-header" style="font-size:25px;">Reviewed DTA Requests (HOD) <span style="font-size:14px;"></span></h5>
  <div class="card-body">
    <div class="table-responsive text-nowrap">
      <table id="tabulka_kariet1" class="table ">
        <thead>
          <tr>
           <th>From</th>
           <th>Purpose_travel</th>
           <th>Destination</th>
           <th>Number of days</th>
           <th>Travel date</th>
           <th>Arrival date</th>
           <th>estimated Expenses</th>
           <th>Application Date </th>
           <th>Action </th>
         </tr>
       </thead>
       <tbody>


        <?php foreach($employees as $row){ 

          $ap = $row['approve_status'];
          $supervisor = $row['supervisor_status'];
          $md = $row['md_hr'];

          $name = $row['firstname'].' '.$row['lastname'];
          $leaveOff = $row['leave_officer'];
          ?>
          <tr>

            <td><?php echo $name ?></td>
            <td><?php echo $row['purpose_travel'] ?></td>
            <td><?php echo $row['destination'] ?></td>
            <td><?php echo $row['number_days'] ?></td>

            <td><?php echo $row['travel_date'] ?></td>
            <td><?php echo $row['arrival_date'] ?></td>

            <td><?php echo $row['estimated_expenses'] ?></td>







            <td><?php echo $row['createdAt'] ?></td>

            <td>
              <div class="dropdown">
                <!-- <a href="dtas_review?staff=<?php echo $row['dta_id'] ?>" type="button"  class="btn btn-primary">Edit Review</a> -->
                <?php if ($row['hod_status'] == 0) { ?>
                    <a href="dtas_review?staff=<?php echo $row['dta_id'] ?>" type="button"  class="btn btn-primary">Review DTA</a>
                  <?php } else { echo "Approved"; } ?>
              </div>
            </td>
          </tr>

        <?php } ?>


      </tbody>

    </table>


  </div>
</div>
</div>

<?php }elseif(($role == 1) or ($role == 12)){  




  $employees = $query->getRows("select dta_id, md_status, approval_status, supervisor_status, purpose_travel, destination, number_days, travel_date, arrival_date, estimated_expenses, dta_request.createdAt, staff_tb.firstname, staff_tb.lastname, md_status from dta_request join staff_tb on dta_request.staffId = staff_tb.staffId where  dta_request.hod_status = 1");

  ?>
  <div class="card">
    <h5 class="card-header" style="font-size:25px;">Reviewed DTA Requests (MD) <span style="font-size:14px;"></span></h5>
    <div class="card-body">
      <div class="table-responsive text-nowrap">
        <table id="tabulka_kariet1" class="table ">
          <thead>
            <tr>
             <th>From</th>
             <th>Purpose_travel</th>
             <th>Destination</th>
             <th>Number of days</th>
             <th>Travel date</th>
             <th>Arrival date</th>
             <th>estimated Expenses</th>




             <th>Application Date </th>
             <th>Action </th>







           </tr>
         </thead>
         <tbody>


          <?php foreach($employees as $row){ 

            $ap = $row['approve_status'];
            $supervisor = $row['supervisor_status'];
            $md = $row['md_hr'];

            $name = $row['firstname'].' '.$row['lastname'];
            $leaveOff = $row['leave_officer'];
            ?>
            <tr>

              <td><?php echo $name ?></td>
              <td><?php echo $row['purpose_travel'] ?></td>
              <td><?php echo $row['destination'] ?></td>
              <td><?php echo $row['number_days'] ?></td>

              <td><?php echo $row['travel_date'] ?></td>
              <td><?php echo $row['arrival_date'] ?></td>
              <td><?php echo $row['estimated_expenses'] ?></td>
              <td><?php echo $row['createdAt'] ?></td>

              <td>
                <div class="dropdown">
                  <?php if ($row['md_status'] == 0) { ?>
                    <a href="dtas_review?staff=<?php echo $row['dta_id'] ?>" type="button"  class="btn btn-primary">Review DTA</a>
                  <?php } else { echo "Approved"; } ?>

                </div>
              </td>
            </tr>

          <?php } ?>


        </tbody>

      </table>


    </div>
  </div>
</div>

<?php }elseif($role == 4){


  $employees = $query->getRows("select dta_id, md_status, account_status, approval_status, supervisor_status, purpose_travel, destination, number_days, travel_date, arrival_date, estimated_expenses, dta_request.createdAt, staff_tb.firstname, staff_tb.lastname, md_status from dta_request join staff_tb on dta_request.staffId = staff_tb.staffId where dta_request.hod_status = 1 and dta_request.approval_status = 1");

  ?>
  <div class="card">
    <h5 class="card-header" style="font-size:25px;">Reviewed DTA Requests (Finance) <span style="font-size:14px;"></span></h5>
    <div class="card-body">
      <div class="table-responsive text-nowrap">
        <table id="tabulka_kariet1" class="table ">
          <thead>
            <tr>
             <th>From</th>
             <th>Purpose_travel</th>
             <th>Destination</th>
             <th>Number of days</th>
             <th>Travel date</th>
             <th>Arrival date</th>
             <th>estimated Expenses</th>
             <th>Application Date </th>
             <th>Action </th>
           </tr>
         </thead>
         <tbody>


          <?php foreach($employees as $row){ 

            $ap = $row['approve_status'];
            $supervisor = $row['supervisor_status'];
            $md = $row['md_hr'];

            $name = $row['firstname'].' '.$row['lastname'];
            $leaveOff = $row['leave_officer'];
            ?>
            <tr>

              <td><?php echo $name ?></td>
              <td><?php echo $row['purpose_travel'] ?></td>
              <td><?php echo $row['destination'] ?></td>
              <td><?php echo $row['number_days'] ?></td>

              <td><?php echo $row['travel_date'] ?></td>
              <td><?php echo $row['arrival_date'] ?></td>

              <td><?php echo $row['estimated_expenses'] ?></td>

              <td><?php echo $row['createdAt'] ?></td>

              <td>
                <div class="dropdown">
                   <?php if ($row['account_status'] == 0) { ?>
                    <a href="dtas_review?staff=<?php echo $row['dta_id'] ?>" type="button"  class="btn btn-primary">Review </a>
                  <?php } else { echo "Approved"; } ?>
                </div>
              </td>
            </tr>

          <?php } ?>


        </tbody>

      </table>


    </div>
  </div>
</div>
<?php } ?>