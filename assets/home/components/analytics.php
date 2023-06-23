<?php 
session_start();

if(!isset($_SESSION['admin-log'])){
    header("location:../");

}

require_once '../classes/manage.php';
$query = new Manage();






$branch = $_SESSION['branch'];

$branchD = $query->getRow("select * from all_branch where branch_id = $branch"); 


$numbEmployers= $query->getRow("select count(*) as total_employers from employer_tb "); 

$numbEmployees= $query->getRow("select count(*) as total_employees from employees "); 

$numbStaff= $query->getRow("select count(*) as total_staff from staff_tb "); 


$nsBranch = $numbEmployers['total_employers'];

$nsEmployees = $numbEmployees['total_employees'];

$myBranch = $branchD['branch_name'];

$myStaff = $numbStaff['total_staff'];

$_SESSION['brc']=$myBranch;

  $der =   $_SESSION['department'] ;

$role = $_SESSION['role'];


?>


<?php if($role == 1 || $role == 6 || $role == 12 ){ ?>
    
    <script type="text/javascript" src="chart/js/jquery.min.js"></script>
<script type="text/javascript" src="chart/js/Chart.min.js"></script>
            <div class="row">
                
             
                <!-- Total Revenue -->
                <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                  <div class="card">
                    <div class="row row-bordered g-0">
                      <div class="col-md-12">
                        <h5 class="card-header m-0 me-2 pb-3" style="color:#fc8403; font-weight:bold;">Employers </h5>
                        <div id="chart-container" style="padding:15px; background-color:whitesmoke">
        <canvas id="graphCanvas"></canvas>
    </div>
    
    
    
    
    
        <script>
        $(document).ready(function () {
            showGraph();
        });


        function showGraph()
        {
            {
                $.post("chart/data.php",
                function (data)
                {
                    console.log(data);
                     var name = [];
                    var marks = [];

                    for (var i in data) {
                        name.push(data[i].managing_branch);
                        marks.push(data[i].count);
                    }

                    var chartdata = {
                        labels: name,
                        datasets: [
                            {
                                label: 'Numbers By Branch',
                                backgroundColor: '#50664d',
                                borderColor: '#50664d',
                                hoverBackgroundColor: '#fc8403',
                                hoverBorderColor: '#666666',
                                data: marks
                            }
                        ]
                    };

                    var graphTarget = $("#graphCanvas");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata
                    });
                });
            }
        }
        </script>
                      </div>
                      
                    </div>
                  </div>
                </div>
                <!--/ Total Revenue -->
                <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                  <div class="row">
                    <div class="col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                           
                          </div>
                          <span class="d-block mb-1" style="color:#fc8403; font-weight:bold;">Number Of Employers </span>
                          <h3 class="card-title text-nowrap mb-2" style="color:#50664d; font-weight:bold;"><?php echo $nsBranch; ?></h3>
                        
                        </div>
                      </div>
                    </div>
                    <div class="col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            
                            
                          </div>
                          <span class="d-block mb-1" style="color:#fc8403; font-weight:bold;">Total Amount Remitted</span>
                          <h3 class="card-title text-nowrap mb-2" style="color:#50664d; font-weight:bold;">NIL</h3>
                         
                        </div>
                      </div>
                    </div><div class="col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            
                            
                          </div>
                          <span class="d-block mb-1" style="color:#fc8403; font-weight:bold;">Number Of Employees</span>
                          <h3 class="card-title text-nowrap mb-2" style="color:#50664d; font-weight:bold;"><?php echo $nsEmployees; ?></h3>
                          
                        </div>
                      </div>
                    </div>
                    <div class="col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            
                            
                          </div>
                          <span class="fw-semibold d-block mb-1" style="color:#fc8403; font-weight:bold;">Number  Of Staff</span>
                          <h3 class="card-title mb-2" style="color:#50664d; font-weight:bold;"><?php echo $myStaff ?></h3>
                        
                        </div>
                      </div>
                    </div>
                    <!-- </div>
    <div class="row"> -->
                    
                  </div>
                </div>
              </div>
              
              
              <?php }elseif($role == 9){ ?>
              
                     <div class="row">
                
             
                <!-- Total Revenue -->
                <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                  <div class="card">
                    <div class="row row-bordered g-0">
                      <div class="col-md-8">
                        <h5 class="card-header m-0 me-2 pb-3">Number Of Leave By Date </h5>
                        <div id="totalRevenueChart" class="px-2"></div>
                      </div>
                      <div class="col-md-4">
                        <div class="card-body">
                          <div class="text-center">
                           
                          </div>
                        </div>
                        <div id="growthChart"></div>
                        <div class="text-center fw-semibold pt-3 mb-2"></div>

                        <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                          <div class="d-flex">
                            <div class="me-2">
                              <span class="badge bg-label-primary p-2"><i class="bx  text-primary"></i></span>
                            </div>
                            
                          </div>
                          <div class="d-flex">
                            <div class="me-2">
                              <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Total Revenue -->
                <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                  <div class="row">
                    <div class="col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                               <img src="../assets/img/icons/unicons/chart.png" alt="User" class="rounded" />
                            </div>
                            
                          </div>
                          <span class="d-block mb-1">Number Of Staff</span>
                          <h3 class="card-title text-nowrap mb-2">0</h3>
           
                        </div>
                      </div>
                    </div>
                   
                   
                    <!-- </div>
    <div class="row"> -->
                    
                  </div>
                </div>
              </div>
              
              <?php }elseif($role == 3 || $role == 10){ ?>
              <div class="row">
                
             
                <!-- Total Revenue -->
                <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                  <div class="card">
                    <div class="row row-bordered g-0">
                      <div class="col-md-8">
                        <h5 class="card-header m-0 me-2 pb-3">Leave request </h5>
                        <div id="totalRevenueChart" class="px-2"></div>
                      </div>
                      <div class="col-md-4">
                        <div class="card-body">
                          <div class="text-center">
                           
                          </div>
                        </div>
                        <div id="growthChart"></div>
                        <div class="text-center fw-semibold pt-3 mb-2"></div>

                        <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                          <div class="d-flex">
                            <div class="me-2">
                              <span class="badge bg-label-primary p-2"><i class="bx  text-primary"></i></span>
                            </div>
                           
                          </div>
                          <div class="d-flex">
                            <div class="me-2">
                              <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
                            </div>
                           
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Total Revenue -->
                <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                  <div class="row">
                    <div class="col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                           
                            
                          </div>
                          <span class="d-block mb-1">Number Of Staffs </span>
                          <h3 class="card-title text-nowrap mb-2">0</h3>
                   
                        </div>
                      </div>
                    </div>
                    <div class="col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                           
                            
                          </div>
                          <span class="d-block mb-1">Total Amount Remitted</span>
                          <h3 class="card-title text-nowrap mb-2">0</h3>
                        
                        </div>
                      </div>
                    </div>
                    
                    <!-- </div>
    <div class="row"> -->
                    
                  </div>
                </div>
              </div>
              
       <?php }elseif($role == 8){ ?>
        <div class="row">
                
             
                <!-- Total Revenue -->
                  <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                  <div class="card">
                  
                    <div class="card-body">
                          <h5> DTA and OPE Application</h5>
                      <form action="./processor/dta_val" method="POST" enctype="multipart/form-data">
                  
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-fullname">Destination</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"
                              ></i
                            ></span>
                            <input
                            
                             required
                              type="text"
                              class="form-control"
                              id="basic-icon-default-fullname"
                              placeholder="Destination "
                              aria-label="Middle Name"
                              name="destination"
                              aria-describedby="basic-icon-default-fullname2"
                            />
                          </div>
                        </div>
                        
                         <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-fullname">Number Of Days</label>
                          <div class="input-group input-group-merge">
                               <span id="basic-icon-default-fullname2" class="input-group-text"
                              ></i
                            ></span>
                            
                            <input
                             required
                              type="number"
                              class="form-control"
                              id="basic-icon-default-fullname"
                              placeholder="Number Of Days"
                              aria-label="Last Name"
                              name="number_days"
                              aria-describedby="basic-icon-default-fullname2"
                            />
                          </div>
                        </div>
                        
                        
                         <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-fullname">Travel Date</label>
                          <div class="input-group input-group-merge">
                               <span id="basic-icon-default-fullname2" class="input-group-text"
                              ></i
                            ></span>
                            
                            <input
                             required
                              type="Date"
                              class="form-control"
                              id="basic-icon-default-fullname"
                              placeholder="Document Name"
                              aria-label="Last Name"
                              name="tv_date"
                              aria-describedby="basic-icon-default-fullname2"
                            />
                          </div>
                        </div>
                        
                       
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-fullname">Arrival Date</label>
                          <div class="input-group input-group-merge">
                               <span id="basic-icon-default-fullname2" class="input-group-text"
                              ></i
                            ></span>
                            
                            <input
                             required
                              type="Date"
                              class="form-control"
                              id="basic-icon-default-fullname"
                              placeholder="Document Name"
                              aria-label="Last Name"
                              name="arr_date"
                              aria-describedby="basic-icon-default-fullname2"
                            />
                          </div>
                        </div>
                        
                        
                         <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-fullname">Estimated Expenses</label>
                          <div class="input-group input-group-merge">
                               <span id="basic-icon-default-fullname2" class="input-group-text"
                              ></i
                            ></span>
                            
                            <input
                             required
                              type="number"
                              class="form-control"
                              id="basic-icon-default-fullname"
                              placeholder="Document Name"
                              aria-label="Last Name"
                              name="estimated_expenses"
                              aria-describedby="basic-icon-default-fullname2"
                            />
                          </div>
                        </div>
                        
                       
                        
                        
                        
                        
                        

                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-email">Purpose Of Travel</label>
                          <div class="input-group input-group-merge">
                           
                            <textarea
                              type="text"
                              id="basic-icon-default-email"
                              class="form-control"
                              placeholder="Purpose Of Travel"
                              aria-label=""
                              name="p_travel"
                              aria-describedby="basic-icon-default-email2"
                            ></textarea>
                            
                          </div>
                         
                        </div>


                          
                           <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-fullname">Upload All necessary supporting document including Receipt and Invoices(SCAN ALL AS SINGLE DOC IN PDF FORMAT)</label>
                          <div class="input-group input-group-merge">
                               <span id="basic-icon-default-fullname2" class="input-group-text"
                              ><i class="bx bx-user"></i
                            ></span>
                            
                            <input required class="form-control" name="doc" accept="" type="file" id="" />
                          </div>
                        </div>


                    

                       
                        <button type="submit" class="btn btn-primary">Submit->  Send To SUPERVISSOR</button>
                      </form>
                    </div>
                  </div>
                </div>
                <!--/ Total Revenue -->
                
              </div>
              <?php }elseif($role == 11){ ?>
              
                      <div class="row">
                
             
                <!-- Total Revenue -->
                <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                  <div class="card">
                   
                    <div class="card-body">
                      <form action="./processor/registry_val" method="POST" enctype="multipart/form-data">
                          
                          
                           <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-fullname">Upload Document</label>
                          <div class="input-group input-group-merge">
                               <span id="basic-icon-default-fullname2" class="input-group-text"
                              ><i class="bx bx-user"></i
                            ></span>
                            
                            <input required class="form-control" name="doc" accept=".pdf" type="file" id="" />
                          </div>
                        </div>

             
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-fullname">Submitted By (FullName)</label>
                          <div class="input-group input-group-merge">
                               <span id="basic-icon-default-fullname2" class="input-group-text"
                              ><i class="bx bx-user"></i
                            ></span>
                            
                            <input
                            
                             required
                              type="text"
                              class="form-control"
                              id="basic-icon-default-fullname"
                              placeholder="Fullname"
                              aria-label="First Name"
                              name="fname"
                              aria-describedby="basic-icon-default-fullname2"
                            />
                          </div>
                        </div>
                        
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-fullname">Email Address</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"
                              ><i class="bx bx-user"></i
                            ></span>
                            <input
                            
                             required
                              type="text"
                              class="form-control"
                              id="basic-icon-default-fullname"
                              placeholder="Submitted By, Email "
                              aria-label="Middle Name"
                              name="femail"
                              aria-describedby="basic-icon-default-fullname2"
                            />
                          </div>
                        </div>
                        
                         <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-fullname">Document Name</label>
                          <div class="input-group input-group-merge">
                              
                            
                            <input
                             required
                              type="text"
                              class="form-control"
                              id="basic-icon-default-fullname"
                              placeholder="Document Name"
                              aria-label="Last Name"
                              name="doc_name"
                              aria-describedby="basic-icon-default-fullname2"
                            />
                          </div>
                        </div>
                        
                       
                        
                        
                        
                        
                        

                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-email">Comments/Description</label>
                          <div class="input-group input-group-merge">
                           
                            <textarea
                              type="text"
                              id="basic-icon-default-email"
                              class="form-control"
                              placeholder="Write about document here"
                              aria-label=""
                              name="comment"
                              aria-describedby="basic-icon-default-email2"
                            ></textarea>
                            
                          </div>
                         
                        </div>


                    

                       
                        <button type="submit" class="btn btn-primary">Save ->  Send To MD’s office</button>
                      </form>
                    </div>
                  </div>
                </div>
                <!--/ Total Revenue -->
               
              </div>
              <?php }elseif($role ==  4){ ?>
              
                             <div class="row">
                
             
                <!-- Total Revenue -->
                <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                  <div class="card">
                    <div class="row row-bordered g-0">
                      <div class="col-md-8">
                        <h5 class="card-header m-0 me-2 pb-3">All Payments </h5>
                        <div id="totalRevenueChart" class="px-2"></div>
                      </div>
                      <div class="col-md-4">
                        <div class="card-body">
                          <div class="text-center">
                           
                          </div>
                        </div>
                        <div id="growthChart"></div>
                        <div class="text-center fw-semibold pt-3 mb-2"></div>

                        <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                          <div class="d-flex">
                            <div class="me-2">
                              <span class="badge bg-label-primary p-2"><i class="bx  text-primary"></i></span>
                            </div>
                           
                          </div>
                          <div class="d-flex">
                            <div class="me-2">
                              <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
                            </div>
                           
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Total Revenue -->
                <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                  <div class="row">
                    
                    <div class="col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                           
                            
                          </div>
                          <span class="d-block mb-1">Total Amount Remitted</span>
                          <h3 class="card-title text-nowrap mb-2">0</h3>
                         
                        </div>
                      </div>
                    </div>
                   
                    <!-- </div>
    <div class="row"> -->
                    
                  </div>
                </div>
              </div>
              
              <?php } ?>
              
              