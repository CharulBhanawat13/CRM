<?php
require_once "../db_connection.php";
$conn=OpenCon();
$user_id = $_POST["user_id"];
if ($user_id < 4){
	$user_id=$user_id+1;
	
}


$result = mysqli_query($conn,"SELECT DISTINCT cengineer_name FROM tbl_employeemaster where cuser_type=$user_id");
?>
<option value="">Select Key A/C Manager</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row["cengineer_name"];?>"><?php echo $row["cengineer_name"];?></option>
<?php
CloseCon($conn);
}
?>