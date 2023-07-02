<?php


$table = 'employer_tb';
$primaryKey = 'employer_id';
$columns = array(
array( 'db' => 'company_name',  'dt' => 0),
array( 'db' => 'ecs_number',   'dt' => 1 ),
array( 'db' => 'rc_number',     'dt' => 2 ),
array( 'db' => 'bussiness_area',     'dt' => 3 ),
array( 'db' => 'inspection_status',     'dt' => 4),
array( 'db' => 'PROCESSING',     'dt' => 5),
array( 'db' => 'createdAt',     'dt' => 6 ),
array( 'db' => 'employer_id', 'dt' => 7 )
);
require_once '../classes/datatables.php';
use SSP;
echo json_encode(
\SSP::complex( $_GET, $table, $primaryKey, $columns, "processing= 'FINAL APPROVAL'")
);


?>