
<?php
 include('../db_connection.php');

	$conn = OpenCon();
 	if(isset($_POST['saveData']))
	{
		$name=$_POST["name"];
		$address=$_POST["address"];
		$city=$_POST["city"];
		$state=$_POST["state"];
		$country=$_POST["country"];
		$mobilenumber=$_POST["mobilenumber"];
		$altmobileNumber=$POST["altmobilenumber"];
		$userType=$_POST["userType"];
		$emailId=$_POST["emailId"];
		$keyAcManager=$_POST["keyAcManager"];	
	
	$sql = "INSERT INTO tbl_employeemaster (cengineer_name,ccity,cstate,ccountry,ckey_ac_manager,
			caddress,cmobile_number,calt_mobile_number,cuser_type,cemail_id,isAvailable,isActive,dcreated_date) 
			VALUES ('$name','$city','$state','$country','$keyAcManager',
			'$address','$mobilenumber','$altmobileNumber',$userType,'$emailId',1,1,now())";
	
	$result = mysqli_query($conn,$sql);
		 header("Location: ../controllers/employeeDetails.php");

	}
CloseCon($conn);

?>