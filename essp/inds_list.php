<?php
require_once "db.php";
$country_id = $_POST["country_id"];
$result = mysqli_query($conn,"SELECT * FROM const_services where industry_id = $country_id");
?>
<option value="">Select Professional Service</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row["service_id"];?>"><?php echo $row["service_name"];?></option>
<?php
}