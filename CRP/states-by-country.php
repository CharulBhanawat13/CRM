<?php
require_once "db_connection.php";
$conn=OpenCon();
$country_name = $_POST["country_name"]; 
$result = mysqli_query($conn,"SELECT * FROM tbl_states where ccountry_name = '$country_name'");
?>
<option value="">Select State</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row["cname"];?>"><?php echo $row["cname"];?></option>
<?php
CloseCon($conn);
}
?>