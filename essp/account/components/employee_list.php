<?php 
session_start();

if (!isset($_SESSION['logging'])) {
	header('Location:../artisan');
	exit;
}

require_once '../classes/manage.php';
$query = new Manage();
$employer = $_SESSION['employerId'] ;




$employees = $query->getRows("select employee_id,employee_surname, monthly_remuneration, employee_firstname,contact_phone, job_title  from employees where employer_id = $employer"); 


//$uploadCount = $query->getRow("select count(rc_uploadId) as upCount from upload_requirement where artisan_id = $artisan"); 

//$rcount = $recCount['recCount'];
//$ucount = $uploadCount['upCount'];

//$prequest = $query->getRows("select a.*, b.* from service_request as a, states as b where a.clientId = b.id and  a.artisanId=$artisan");

//if($payment !=1){
  //if ($rcount===$ucount){
       //     header("location:invoice");
    
     //   }
        
//}

?>
         <div class="card">
                <h5 class="card-header">Employee list</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table id="tabulka_kariet1" class="table ">
                      <thead>
                        <tr>
                          
                          <th>Full Name</th>
                        
                          <th>Contact Phone</th>
                          <th>Job Title</th>
                          
                          <th>Monthly Renumeration</th>
                        
                        
                          <th>Status</th>
                           <th>Manage</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                          
                          <?php foreach($employees as $row){ ?>
                        <tr>
                         
                          <td><?php echo $row['employee_surname']. ' '.$row['employee_firstname'] ?></td>
                          
                              <td><?php echo $row['contact_phone'] ?></td>
                              <td><?php echo $row['job_title'] ?></td>
                              
                              <td>₦ <?php echo $row['monthly_remuneration'] ?></td>
                            
                    
                          <td><span class="badge bg-label-primary me-1">Active</span></td>
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
                                <a class="dropdown-item" href="./edit_employee.php?id=<?php echo $row['employee_id'] ?>"
                                  ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                >
                                <a class="dropdown-item employee_id" deleteId="<?php echo $row['employee_id'] ?>" href="javascript:void(0);"
                                  ><i class="bx bx-trash me-1"></i> Delete</a
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