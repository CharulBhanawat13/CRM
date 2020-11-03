<?php
include('../db_connection.php');

// Call on Delete
if(isset($_POST['id_toDelete'])){
    $conn = OpenCon();
    $employeeId=$_POST['id_toDelete'];
    $sql="UPDATE tbl_employeemaster SET isAvailable =0 WHERE nid = $employeeId";
    $result = mysqli_query($conn,$sql);
    CloseCon($conn);
}

//Call for fetching details of employee to update
    if(isset($_POST['id_toUpdate'])){
        $conn = OpenCon();
        $employeeId=$_POST['id_toUpdate'];
        $sql="Select * from tbl_employeemaster WHERE nid = $employeeId";
        $result = mysqli_query($conn,$sql);
        $row_data = array();
        while ($row = mysqli_fetch_array($result)) {
            $row_data = array(
                "nid"            => $row['nid'],
                "cengineer_name" => $row['cengineer_name'],
                "ccity"          => $row['ccity'],
                "cstate"         => $row['cstate'],
                "ccountry"       => $row['ccountry'],
                "caddress"       => $row['caddress'],
                "cmobile_number" => $row['cmobile_number'],
                "calt_mobile_number" => $row['calt_mobile_number'],
                "cemail_id" => $row['cemail_id'],
                "ckey_ac_manager" => $row['ckey_ac_manager'],
                "nkey_ac_manager_id" => $row['nkey_ac_manager_id'],
                "cuser_type" =>$row['cuser_type'],
                "cuser_name" =>$row['cuser_name'],
                "cpassword" => $row['cpassword']
            );
            $row_datas[] = $row_data;
        }
        echo json_encode($row_datas);
        CloseCon($conn);
}

// Call to Update employee
    if (isset($_POST['updateData'])){
        $username=$_POST["username"];
        $isUsernameAlreadyExists=checkIfUsernameAlreadyExists($username);
        if ($isUsernameAlreadyExists){
            header("Location: ../controllers/employeeDetails.php");
        }else{
                $conn=OpenCon();
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

                $password=$_POST["password"];
                $employeeId=(int)$_POST["employeeId"];

                $sql_update="UPDATE tbl_employeemaster SET 
                cengineer_name='$name',
                ccity='$city',
                cstate='$state',
                ccountry='$country',
                nkey_ac_manager_id=$keyAcManagerID,
                caddress='$address',
                cmobile_number='$mobilenumber',
                calt_mobile_number='$altmobileNumber',
                cuser_type ='$userType',
                cemail_id='$emailId',
                cuser_name='$username',
                cpassword='$password',
                dupdated_date=now()
                where nid=$employeeId ";

                $result = mysqli_query($conn,$sql_update);
                CloseCon($conn);
                header("Location: ../controllers/employeeDetails.php");
        }
    }


    function checkIfUsernameAlreadyExists($username)
    {
        $conn = OpenCon();
        $sql_u = "SELECT * FROM tbl_employeemaster WHERE cuser_name='$username'";
        $res_u = mysqli_query($conn, $sql_u);

        if (mysqli_num_rows($res_u) > 0) {
            if(isset($_POST['updateData'])){
                $result = mysqli_fetch_assoc($res_u);
                $user_in_DB = $result['cuser_name'];
                if ($user_in_DB == $username){
                    $isUsernameAlreadyExists=false;
                    CloseCon($conn);
                    return $isUsernameAlreadyExists;
                }
            }
            $name_error = "Sorry... username already taken";
            $_SESSION['name_error'] = $name_error;

            $isUsernameAlreadyExists=true;

        }else{
            $isUsernameAlreadyExists=false;
        }
        CloseCon($conn);
        return $isUsernameAlreadyExists;

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

        $isUsernameAlreadyExists=checkIfUsernameAlreadyExists($username);
        if ($isUsernameAlreadyExists){
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