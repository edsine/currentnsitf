<?php 
session_start();




$employer = 1004033022 ;
require_once '../classes/manage.php';
$query = new Manage();








//$employees = $query->getRows("select firstname, lastname, phone, branchId, roles   from staff_tb"); 


//$uploadCount = $query->getRow("select count(rc_uploadId) as upCount from upload_requirement where artisan_id = $artisan"); 

//$rcount = $recCount['recCount'];
//$ucount = $uploadCount['upCount'];

$employees = $query->getRows("select * from staff_tb where active_staus = 0");

//if($payment !=1){
  //if ($rcount===$ucount){
       //     header("location:invoice");
    
     //   }
        
//}

?>
         <div class="card">
                <h5 class="card-header" style="font-size:30px;">Pre Activated User</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table id="tabulka_kariet1" class="table ">
                      <thead>
                        <tr>
                            <th>Full Name</th>
                          <th>Email Address</th>
                           <th>Phone NUmber</th>
                            <th>Branch</th>
                          
                     
                           <th>Manage</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                         

                          <?php foreach($employees as $row){ ?>
                        <tr>
                           <td><?php echo $row['firstname']. ' '. $row['lastname'] ?></td>
                          <td><?php echo $row['staff_email'] ?></td>
                            <td><?php echo $row['phone'] ?></td>
                                <td><?php echo $row['branch'] ?></td>
                            
                          <td>
                            <div class="dropdown">
                             <a  href="components/activateStaff?id=<?php echo $row['staffId'] ?>">Activate</a>
                            </div>
                          </td>
                        </tr>
                        
                        <?php } ?>
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>