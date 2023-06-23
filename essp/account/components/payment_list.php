<?php 
session_start();

if (!isset($_SESSION['logging'])) {
	header('Location:../artisan');
	exit;
}



require_once '../classes/manage.php';
$query = new Manage();
$employer = $_SESSION['employerId'] ;







$employees = $query->getRows("select a.*, b.*, c.* from transactions as a, employer_tb as b, payment_type as c    where a.employerId = b.employer_id and a.payment_type = c.p_typeId and a.employerId  = $employer"); 


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
                <h5 class="card-header">Payment list</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table id="tabulka_kariet1" class="table ">
                      <thead>
                        <tr>
                            <th>Employer</th>
                          <th>Payment Type</th>
                           <th>Invoice No</th>
                           <th>Remita RR</th>
                          <th>Amount</th>
                          <th>Payment Status</th>
                           <th>Confirmation</th>
                          
                          <th>Payment Time</th>
                        
                         <th>Flag Payment</th>
                           <th>Action</th>
                          
                          
                        </tr>
                      </thead>
                      <tbody>
                          
                          <?php foreach($employees as $row){ ?>
                        <tr>
                         
                          <td><?php echo $row['desk_firstname']. ' '.$row['desk_lastname'] ?></td>
                            <td><?php echo $row['payment_name'] ?></td>
                             <td><?php echo $row['invoice_number'] ?></td>
                              <td><?php echo $row['invoice_rrr'] ?></td>
                              <td><?php echo $row['amount'] ?></td>
                               <td>
                                   
                                   
                                   <?php if( $row['payment_status'] ==1 ){?>
                                             <p>PAID</p>
                                             
                                             <?php }else{ ?>
                                              <p>PENDING</p>
                                              <?php } ?>
                                   </td>
                            
                              
                              
                               <td>
                                   
                                   <?php if($row['payment_approve'] == 0){  ?><p>Waiting for approval</p><?php }else{ ?>
                               
                               <p>APPROVED</p>
                              <?php } ?> </td>
                              
                              
                                <td><?php echo $row['payment_time'] ?></td>
                                
                                  <td><button>Verify RRR status </button></td>
                                     <td><button>Print Invoice </button></td>
                            
                    
                        
                         
                        </tr>
                        
                        <?php } ?>
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>