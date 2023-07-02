<?php 
session_start();

if(!isset($_SESSION['admin-log'])){
  header("location:../");
}



$employer = 1004033022 ;
require_once '../classes/manage.php';
$query = new Manage();






$staff =$_SESSION['staff'] ;



$employees = $query->getRows("select * from dta_request where staffId = $staff ");



?>
<div class="card">
  <h5 class="card-header" style="font-size:25px;">My DTA Applications <span style="font-size:14px;"></span></h5>
  <div class="card-body">
    <div class="table-responsive text-nowrap">
      <table id="tabulka_kariet1" class="table ">
        <thead>
          <tr>
            <th>Purpose_travel</th>
            <th>Destination</th>


            <th>Supervissor Review </th>

            <th>HOD Review </th>

            <th>HOD Review </th>

            <th>Account Review </th>


            <th>Application Date </th>
            <th>Track</th>







          </tr>
        </thead>
        <tbody>


          <?php foreach($employees as $row){ 

            $ap = $row['approve_status'];
            $supervisor = $row['supervisor_status'];
            $hod_status = $row['hod_status'];
            $md_status = $row['md_status'];
            $account_status = $row['account_status'];
            $leaveOff = $row['leave_officer'];
            ?>
            <tr>
             <td><?php echo $row['purpose_travel'] ?></td>
             <td><?php echo $row['destination'] ?></td>


             <td>  <?php if($supervisor == 2){  ?>

              <span class="badge bg-label-primary me-1">PENDING</span>
            <?php }elseif($supervisor == 1){ ?>

              <span class="badge bg-label-primary me-1">APPROVED</span>

            <?php } ?>
          </td>



          <td>  <?php if($hod_status == 0){  ?>

            <span class="badge bg-label-primary me-1">PENDING</span>
          <?php }else{ ?>

            <span class="badge bg-label-primary me-1">APPROVED</span>
          <?php } ?>
        </td>



        <td>  <?php if($md_status == 0){  ?>

          <span class="badge bg-label-primary me-1">PENDING</span>
        <?php }else{ ?>

          <span class="badge bg-label-primary me-1">APPROVED</span>
        <?php } ?>
      </td>


      <td>  <?php if( $account_status == 0){  ?>

        <span class="badge bg-label-primary me-1">PENDING</span>
      <?php }else{ ?>

        <span class="badge bg-label-primary me-1">APPROVED</span>

      <?php } ?>
    </td>



    <td><?php echo $row['createdAt'] ?></td>
    <td><button type="button" class="btn btn-primary dta_tracker" dta_id="<?php echo $row["dta_id"]; ?>">Track</button></td>


  </tr>

<?php } ?>


</tbody>

</table>


</div>
</div>
</div>

