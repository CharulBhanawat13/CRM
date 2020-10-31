<?php
require_once "../db_connection.php";
$conn=OpenCon();
$city_name = $_POST["city_name"]; 
$result = mysqli_query($conn,"SELECT cstate FROM tbl_city_state_country where ccity = '$city_name'");
?>
<option value="">Select State</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row["cstate"];?>" selected><?php echo $row["cstate"];?></option>
<?php
}
CloseCon($conn);

?>