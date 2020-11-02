
<?php
include('../db_connection.php');

    if(isset($_POST['ID'])){
        $conn = OpenCon();

        $employeeId=$_POST['ID'];
		$sql="UPDATE tbl_employeemaster SET isActive =0 WHERE nid = $employeeId";
		$result = mysqli_query($conn,$sql);
        CloseCon($conn);
  
	}
	
 	if(isset($_POST['saveData']))
	{
        $conn = OpenCon();
		$name=$_POST["name"];
		$address=$_POST["address"];
		$city=$_POST["city"];
		$state=$_POST["state"];
		$country=$_POST["country"];
		$mobilenumber=$_POST["mobilenumber"];
		$altmobileNumber=$_POST["altmobilenumber"];
		$userType=$_POST["userType"];
		$emailId=$_POST["emailId"];
		$keyAcManagerID=(int)$_POST["keyAcManagerId"];
		$username=$_POST["username"];
		$password=$_POST["password"];
		
		$sql_u = "SELECT * FROM tbl_employeemaster WHERE cuser_name='$username'";
		$res_u = mysqli_query($conn, $sql_u);

		if (mysqli_num_rows($res_u) > 0) {
				$name_error = "Sorry... username already taken"; 
				$_SESSION['name_error']=$name_error;
            CloseCon($conn);
				header("Location: ../controllers/employeeDetails.php");

		}else{
			$sql = "INSERT INTO tbl_employeemaster (cengineer_name,ccity,cstate,ccountry,nkey_ac_manager_id,
			caddress,cmobile_number,calt_mobile_number,cuser_type,cemail_id,isAvailable,isActive,cuser_name,cpassword,dcreated_date) 
			VALUES ('$name','$city','$state','$country',$keyAcManagerID,
			'$address','$mobilenumber','$altmobileNumber',$userType,'$emailId',1,1,'$username','$password',now())";
	
			$result = mysqli_query($conn,$sql);

           $sql_select='SELECT cengineer_name FROM tbl_employeemaster WHERE nid = $keyAcManagerID' ;
            $res_sql_select=mysqli_query($conn,"SELECT cengineer_name FROM tbl_employeemaster WHERE nid =$keyAcManagerID");
            $result = mysqli_fetch_assoc($res_sql_select);
            $cengineer_name= $result['cengineer_name'];

            $update_sql_select="UPDATE tbl_employeemaster
            SET ckey_ac_manager='$cengineer_name'
            WHERE cuser_name='$username'";
            $res_sql_update=mysqli_query($conn,
                $update_sql_select);

            CloseCon($conn);
			header("Location: ../controllers/employeeDetails.php");
		}
	}


?>