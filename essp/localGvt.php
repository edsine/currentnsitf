<?php
require_once "db.php";
$country_id = $_POST["country_id"];
$result = mysqli_query($conn,"SELECT * FROM local_governments where state_id = $country_id");
?>
<option value="">Select Local Government</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row["id"];?>"><?php echo $row["local_name"];?></option>
<?php
}