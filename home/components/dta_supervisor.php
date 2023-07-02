<?php 
session_start();

if(!isset($_SESSION['admin-log'])){
  header("location:../");
}



$employer = 1004033022 ;
require_once '../classes/manage.php';
$query = new Manage();






$staff =$_SESSION['staff'] ;

$role = $_SESSION['role'] ;

$branch = $_SESSION['branch'];


if($role == 9){


  //$employees = $query->getRows("select a.*, b.* from dta_request as a, staff_tb as b where a.staffId= b.staffId and a.branchId = $branch ");


  $employees = $query->getRows("select dta_id, approval_status, supervisor_status, purpose_travel, destination, number_days, travel_date, arrival_date, estimated_expenses, dta_request.createdAt, staff_tb.firstname, staff_tb.lastname, md_status from dta_request join staff_tb on dta_request.staffId = staff_tb.staffId join units on staff_tb.departmentId = units.department_id where units.unit_head = $staff and supervisor_status = 0");

  ?>
  <div class="card">
    <h5 class="card-header" style="font-size:25px;">Supervisor DTA Review Requests <span style="font-size:14px;"></span></h5>
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

            $ap = $row['approval_status'];
            $supervisor = $row['supervisor_status'];
            $md = $row['md_status'];

            $name = $row['firstname'].' '.$row['lastname'];

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
                  <?php if ($row['supervisor_status'] == 0) { ?>
                    <a href="dtas_review?staff=<?php echo $row['dta_id'] ?>" type="button"  class="btn btn-primary">Review</a>
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

<?php }elseif($role == 3){

  $get_user_department = $query->getRows("select departmentId from staff_tb where staffId = $staff");

  //var_dump($get_user_department);
  $department_id =  $get_user_department[0]['departmentId'];

  $employees = $query->getRows("select dta_id, approval_status, supervisor_status, purpose_travel, destination, number_days, 
    travel_date, arrival_date, hod_status, estimated_expenses, dta_request.createdAt, staff_tb.firstname, staff_tb.lastname, 
    md_status from dta_request join staff_tb on dta_request.staffId = staff_tb.staffId 
    where staff_tb.departmentId = $department_id and hod_status = 0");

    ?>
    <div class="card">
      <h5 class="card-header" style="font-size:25px;">DTA Requests (HOD Review)  <span style="font-size:14px;"></span></h5>
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
                   
                     <?php if ($row['hod_status'] == 0) { ?>
                    <a href="dtas_review?staff=<?php echo $row['dta_id'] ?>" type="button"  class="btn btn-primary">Review</a>
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

  $employees = $query->getRows("select dta_id, approval_status, supervisor_status, purpose_travel, destination, number_days, 
    travel_date, arrival_date, estimated_expenses, dta_request.createdAt, staff_tb.firstname, staff_tb.lastname, 
    md_status from dta_request join staff_tb on dta_request.staffId = staff_tb.staffId where dta_request.supervisor_status=1 and dta_request.hod_status=1
    and md_status = 0");

  ?>
  <div class="card">
    <h5 class="card-header" style="font-size:25px;">DTA Requests (MD Review)  <span style="font-size:14px;"></span></h5>
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
                  <!-- <a href="dtas_review?staff=<?php echo $row['dta_id'] ?>" type="button"  class="btn btn-primary">Review </a> -->
                   <?php if ($row['md_status'] == 0) { ?>
                    <a href="dtas_review?staff=<?php echo $row['dta_id'] ?>" type="button"  class="btn btn-primary">Review</a>
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


  $employees = $query->getRows("select dta_id, account_status, approval_status, supervisor_status, purpose_travel, destination, number_days, 
    travel_date, arrival_date, estimated_expenses, dta_request.createdAt, staff_tb.firstname, staff_tb.lastname, 
    md_status from dta_request join staff_tb on dta_request.staffId = staff_tb.staffId where dta_request.supervisor_status=1 and dta_request.hod_status=1 and dta_request.md_status=1 and dta_request.account_status = 0");

  ?>
  <div class="card">
    <h5 class="card-header" style="font-size:20px;">DTA Approval Request (Finance)<span style="font-size:14px;"></span></h5>
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
                    <a href="dtas_review?staff=<?php echo $row['dta_id'] ?>" type="button"  class="btn btn-primary">Review</a>
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

