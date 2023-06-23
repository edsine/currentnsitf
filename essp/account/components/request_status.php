<?php 
session_start();

if (!isset($_SESSION['logging'])) {
	header('Location:../artisan');
	exit;
}



require_once '../classes/manage.php';
$query = new Manage();
$employer = $_SESSION['employerId'] ;







$employees = $query->getRows("select a.*, b.* from certificate_request as a, employer_tb as b where a.employer_id = b.employer_id and a.employer_id = $employer"); 


//$uploadCount = $query->getRow("select count(rc_uploadId) as upCount from upload_requirement where artisan_id = $artisan"); 

//$rcount = $recCount['recCount'];
//$ucount = $uploadCount['upCount'];ype

//$prequest = $query->getRows("select a.*, b.* from service_request as a, states as b where a.clientId = b.id and  a.artisanId=$artisan");

//if($payment !=1){
  //if ($rcount===$ucount){
       //     header("location:invoice");
    
     //   }
        
//}

?>
         <div class="card">
                <h5 class="card-header">Certificate Request Status </h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table id="tabulka_kariet1" class="table ">
                      <thead>
                        <tr>
                            <th>Employer</th>
                      
                          
                          <th>Process Status</th>
                          <th>Payment Status</th>
                          
                          <th>Download Certificate</th>
                          
                        
                        
                           <th>Manage</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                          
                          <?php foreach($employees as $row){ ?>
                        <tr>
                         
                          <td><?php echo $row['desk_firstname']. ' '.$row['desk_lastname'] ?></td>
                        
                               <td><?php if( $row['processing_status'] ==0){ echo "PENDING" ;}else{ echo "Done"; }?></td>
                              <td><?php if( $row['payment_status'] == 0){ echo "NOT PAID";}else{ echo "PAID" ;} ?></td>
                              
                              
                              
                               <td><?php if( $row['processing_status'] == 0){ echo "IN PROGRESS";}else{ ?>
                                  <a href="" target="blank">Download</a><?php } ?>
                               
                               </td>
                            
                    
                        
                          <td>
                            <div class="dropdown">
                              <button
                                type="button"
                                class="btn p-0 dropdown-toggle hide-arrow"
                                data-bs-toggle="dropdown"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);"
                                  ><i class="bx bx-edit-alt me-1"></i>More details</a
                                >
                                
                              </div>
                            </div>
                          </td>
                        </tr>
                        
                        <?php } ?>
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>