<?php
require_once "../db_connection.php";
$conn=OpenCon();
$city_name = $_POST["city_name"];
$result = mysqli_query($conn,"SELECT ccountry FROM tbl_city_state_country where ccity = '$city_name'");
?>
<option value="">Select Country</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row["ccountry"];?>" selected><?php echo $row["ccountry"];?></option>
<?php
CloseCon($conn);
}
?>