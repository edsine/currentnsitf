<?php

require_once(__DIR__.'/../../classes/database.php');
$db_connection = new Database();
$conn = $db_connection->dbConnection();

$get_employer_stats = "select count(employer_id) as employer_count from employer_tb";
$get_employer_stats = $conn->prepare($get_employer_stats);
$get_employer_stats->execute();
$res = $get_employer_stats->fetchObject();
$employer_count = $res->employer_count;

$get_employee_stats = "select count(employee_id) as employee_count from employees";
$get_employee_stats = $conn->prepare($get_employee_stats);
$get_employee_stats->execute();
$res = $get_employee_stats->fetchObject();
$employee_count = $res->employee_count;



?>

  <div class="row">
                <div class="col-lg-8 mb-4 order-0">
                  <div class="card justify-center">
                    <!-- <div class="d-flex align-items-end row">
                      <div class="col-sm-9">
                        <div class="card-body" style="height:40%;">
                          <h5 class="card-title text-primary" style="font-size:35px;font-weight:bold; color:black;"> e-NSITF View & Manage🎉</h5>
                        
                        </div>
                      </div>
                      <div class="col-sm-3 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="../assets/img/illustrations/man-with-laptop-light.png"
                            height="140"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png"
                          />
                        </div>
                      </div>
                    </div> -->
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 order-1">
                  <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="../assets/img/icons/unicons/chart-success.png"
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                            
                          </div>
                          <span class="fw-semibold d-block mb-1">Employer Count</span>
                          <h3 class="card-title mb-2"><?php echo $employer_count; ?></h3>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                         <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="../assets/img/icons/unicons/chart-success.png"
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                            
                          </div>
                          <span class="fw-semibold d-block mb-1"> Employee Count</span>
                          <h3 class="card-title mb-2"><?php echo $employee_count; ?></h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
          
        
              </div>