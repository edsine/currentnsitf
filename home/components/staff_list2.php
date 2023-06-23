<?php 
session_start();




$employer = 1004033022 ;
require_once '../classes/manage.php';
$query = new Manage();








//$employees = $query->getRows("select firstname, lastname, phone, branchId, roles   from staff_tb"); 


//$uploadCount = $query->getRow("select count(rc_uploadId) as upCount from upload_requirement where artisan_id = $artisan"); 

//$rcount = $recCount['recCount'];
//$ucount = $uploadCount['upCount'];
$branch = $_SESSION['branch'];

$employees = $query->getRows("select a.*, b.* from leave_request as a, staff_tb as b where a.staff_id = b.staffId and b.branchId =$branch");

//if($payment !=1){
  //if ($rcount===$ucount){
       //     header("location:invoice");
    
     //   }
        
//}

?>
         <div class="card">
                <h5 class="card-header" style="font-size:30px;">Leave List</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table id="tabulka_kariet1" class="table ">
                      <thead>
                        <tr>
                            <th>Full Name</th>
                          
                           <th>Approval Status</th>
                          <th>Request date</th>
                         
                        
                          
                       
                        </tr>
                      </thead>
                      <tbody>
                         

                          <?php foreach($employees as $row){ ?>
                        <tr>
                           <td><?php echo $row['firstname']. ' '. $row['lastname'] ?></td>
                            <td><?php echo $row['phone'] ?></td>
                          <td><?php echo $row['createdAt'] ?></td>
                           
                        </tr>
                        
                        <?php } ?>
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>