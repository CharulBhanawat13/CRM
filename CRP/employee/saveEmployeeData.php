
<?php
 include('../db_connection.php');
session_start();
	$conn = OpenCon();
 	if(isset($_POST['saveData']))
	{
		$name=$_POST["name"];
		$address=$_POST["address"];
		$city=$_POST["city"];
		$state=$_POST["state"];
		$country=$_POST["country"];
		$mobilenumber=$_POST["mobilenumber"];
		$altmobileNumber=$_POST["altmobilenumber"];
		$userType=$_POST["userType"];
		$emailId=$_POST["emailId"];
		$keyAcManager=$_POST["keyAcManager"];
		$username=$_POST["username"];
		$password=$_POST["password"];
		
		$sql_u = "SELECT * FROM tbl_employeemaster WHERE cuser_name='$username'";
		$res_u = mysqli_query($conn, $sql_u);

		if (mysqli_num_rows($res_u) > 0) {
				$name_error = "Sorry... username already taken"; 
				echo "<script>alert('$=');</script>";
				$_SESSION['name_error']=$name_error;
				header("Location: ../controllers/employeeDetails.php");

		}else{
			$sql = "INSERT INTO tbl_employeemaster (cengineer_name,ccity,cstate,ccountry,ckey_ac_manager,
			caddress,cmobile_number,calt_mobile_number,cuser_type,cemail_id,isAvailable,isActive,cuser_name,cpassword,dcreated_date) 
			VALUES ('$name','$city','$state','$country','$keyAcManager',
			'$address','$mobilenumber','$altmobileNumber',$userType,'$emailId',1,1,'$username','$password',now())";
	
			$result = mysqli_query($conn,$sql);
			header("Location: ../controllers/employeeDetails.php");
		}
	}
CloseCon($conn);

?>