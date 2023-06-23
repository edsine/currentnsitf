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

$employees = $query->getRows("select a.*, b.staffId, b.firstname, b.lastname from registry_doc as a, staff_tb as b where a.staffId = b.staffId");

//if($payment !=1){
  //if ($rcount===$ucount){
       //     header("location:invoice");
    
     //   }
        
//}

?>
         <div class="card">
                <h5 class="card-header" style="font-size:30px;">Submitted Documents</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table id="tabulka_kariet1" class="table ">
                      <thead>
                        <tr>
                            <th>Submitted By (FullName)</th>
                    
                          <th>Submitted By(Email )</th>
                           <th>Received By</th>
                          
                            <th>Document Name</th>
                            
                             <th>Document</th>
                    
                          <th>Date Submitted</th>
                         
                          
                         
                        
                           <th>Manage</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                         

                          <?php foreach($employees as $row){ 
                          
                          $ap = $row['approve_status'];
                          
                          $fullname = $row['firstname'].' '.$row['lastname'];
                          ?>
                        <tr>
                           <td><?php echo $row['from_name'] ?></td>
                        
                               <td><? echo $row['from_email'] ?></td>
                                <td><? echo $fullname ?></td>
                          <td><?php echo $row['document_name'] ?></td>
                          
                           <td><a href="<?php echo $row['doc_path'] ?> " target="blank">Open</a></td>
                            <td><?php echo $row['createdAt'] ?></td>
                            
                            
                              <td><a href="">Details</a></td>
                            
                            
                          
                         
                        </tr>
                        
                        <?php } ?>
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>