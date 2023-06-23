<?php
header('Content-Type: application/json');

require_once '../../classes/manage.php';
$query = new Manage();


//$result = $query->getRows("SELECT a.*,b.*,  count(a.branchId)as count FROM employer_tb as a, all_branch as b  GROUP BY b.branch_name");



$result = $query->getRows("select managing_branch, count(employer_id) as count from employer_tb group by managing_branch  ");

//$result = $query->getRows("");


//$sqlcomment = mysql_query("SELECT state,count(farmer_id)as count FROM farmers_data GROUP BY state");
echo json_encode($result);


//$sqlQuery = "SELECT fname, phone, email, experience FROM c_artisan ORDER BY cArt_id";

//$result = mysqli_query($conn,$sqlQuery);

//$data = array();
//foreach ($result as $row) {
//	$data[] = $row;
//}

//mysqli_close($conn);

//echo json_encode($data);
?>