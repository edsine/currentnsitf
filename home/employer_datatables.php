<?php
require_once('../classes/datatables.php');
$table_type = $_GET["table_type"];
$return = "";
try{ 
	switch ($table_type) {
		case 1:
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
		
		//use SSP;
		$return =  json_encode(
			\SSP::complex( $_GET, $table, $primaryKey, $columns, "processing= 'FINAL APPROVAL'")
		);
		break;
		case 2:
		$table = 'employer_tb';
		$primaryKey = 'employer_id';
		$columns = array (
			array( 'db' => 'company_name',  'dt' => 0),
			array( 'db' => 'ecs_number',   'dt' => 1 ),
			array( 'db' => 'rc_number',     'dt' => 2 ),
			array( 'db' => 'bussiness_area',     'dt' => 3 ),
			array( 'db' => 'PROCESSING',     'dt' => 4 ),
			array( 'db' => 'createdAt',     'dt' => 5 ),
			array( 'db' => 'employer_id', 'dt' => 6 )
		);
		
		//use SSP;
		$return =  json_encode(
			\SSP::complex( $_GET, $table, $primaryKey, $columns, "processing != 'FINAL APPROVAL'")
		);
		
		break;
		case 3:
		$table = 'employer_tb';
		$primaryKey = 'employer_id';
		$columns = array(
			array( 'db' => 'company_name',  'dt' => 0),
			array( 'db' => 'ecs_number',   'dt' => 1 ),
			array( 'db' => 'rc_number',     'dt' => 2 ),
			array( 'db' => 'bussiness_area',     'dt' => 3 ),
			array( 'db' => 'createdAt',     'dt' => 4 ),
			array( 'db' => 'employer_id', 'dt' => 5 )
		);
		require_once '../classes/datatables.php';

		$return =  json_encode(
			\SSP::simple( $_GET, $table, $primaryKey, $columns)
		);
		break;
		default:
		$return = "";
	}

} catch (Exception $e){

}
echo $return;

?>