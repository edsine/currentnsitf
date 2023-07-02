<?php 
session_start();




$employer = 1004033022 ;
require_once '../classes/manage.php';
$query = new Manage();



$units = $query->getRows("select units.id as id, units.unit_name as unit, departments.dep_unit as department,
concat(staff_tb.firstname,' ',staff_tb.lastname) as fullname from units
  left join departments on units.department_id = departments.department_id
  left join staff_tb on units.unit_head = staff_tb.staffId;");

?>
         <div class="card">
                <h5 class="card-header" style="font-size:30px;">Units</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table id="tabulka_kariet1" class="table ">
                      <thead>
                        <tr>
                            <th>Unit Name</th>
                          <th>Department</th>
                           <th>Unit Head</th>
                           <th>Manage</th>
                        </tr>
                      </thead>
                      <tbody>
                         

                          <?php foreach($units as $row){ ?>
                        <tr>
                           <td><?php echo $row['unit'] ?></td>
                          <td><?php echo $row['department'] ?></td>
                            <td><?php echo $row['fullname'] ?></td>
                          <td>
                            <div class="dropdown">
                             <a  href="update_unit?id=<?php echo $row['id'] ?>"> Update</a>
                            </div>
                          </td>
                        </tr>
                        
                        <?php } ?>
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>