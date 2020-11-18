<?php
include('../db_connection.php');

// Call on Delete
if (isset($_POST['id_toDelete'])) {
    $conn = OpenCon();
    $employeeId = $_POST['id_toDelete'];
    $sql = "UPDATE tbl_employeemaster SET isAvailable =0 WHERE nemployee_unique_id= $employeeId";
    $result = mysqli_query($conn, $sql);
    CloseCon($conn);
}

//Call for fetching details of employee to update
if (isset($_POST['id_toUpdate'])) {
    $conn = OpenCon();
    $employeeId = $_POST['id_toUpdate'];
    $sql = "Select * from tbl_employeemaster WHERE nemployee_unique_id= $employeeId";
    $result = mysqli_query($conn, $sql);
    $row_data = array();
    while ($row = mysqli_fetch_array($result)) {
        $row_data = array(
            "nemployee_unique_id" => $row['nemployee_unique_id'],
            "cengineer_name" => $row['cengineer_name'],
            "ccity" => $row['ccity'],
            "cstate" => $row['cstate'],
            "ccountry" => $row['ccountry'],
            "caddress" => $row['caddress'],
            "cmobile_number" => $row['cmobile_number'],
            "calt_mobile_number" => $row['calt_mobile_number'],
            "cemail_id" => $row['cemail_id'],
            "ckey_ac_manager" => $row['ckey_ac_manager'],
            "nkey_ac_manager_id" => $row['nkey_ac_manager_id'],
            "cuser_type" => $row['cuser_type'],
            "cuser_name" => $row['cuser_name'],
            "cpassword" => $row['cpassword'],
            "saveOrUpdate" => '2'
        );
        $row_datas[] = $row_data;
    }
    echo json_encode($row_datas);
    CloseCon($conn);
}

if (isset($_POST['submitData'])) {
    $username = $_POST["username"];
    $employeeId = (int)$_POST["employeeId"];
    $saveOrUpdate = $_POST["saveOrUpdate"];
    $isEmployeeCodeAlreadyExists= checkIfEmployeeCodeAlreadyExists($employeeId,$saveOrUpdate);

    $isUsernameAlreadyExists = checkIfUsernameAlreadyExists($username, $saveOrUpdate,$employeeId);
    if ($isUsernameAlreadyExists) {
        echo "<SCRIPT> //not showing me this
        alert('Username already taken');
        window.location.replace('../controllers/employeeDetails.php');
    </SCRIPT>";
    }
    if ($isEmployeeCodeAlreadyExists){
        echo "<SCRIPT> //not showing me this
        alert('EmployeeCode already taken');
        window.location.replace('../controllers/employeeDetails.php');
    </SCRIPT>";
    }
else {

        $name = $_POST["name"];
        $address = $_POST["address"];
        $city = $_POST["city"];
        $state = $_POST["state"];
        $country = $_POST["country"];
        $mobilenumber = $_POST["mobilenumber"];
        $altmobileNumber = $_POST["altmobilenumber"];
        $userType = $_POST["userType"];
        $emailId = $_POST["emailId"];
        $keyAcManagerID = (int)$_POST["keyAcManagerIdHidden"];
        $password = $_POST["password"];

        if ($saveOrUpdate == 2) {
            $conn = OpenCon();
            $sql_update = "UPDATE tbl_employeemaster SET 
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
                where nemployee_unique_id=$employeeId ";

            $result = mysqli_query($conn, $sql_update);
            CloseCon($conn);

            header("Location: ../controllers/employeeDetails.php");
        } else {
            $conn = OpenCon();
            // Save Data in tbl_employeemaster
            $sql = "INSERT INTO tbl_employeemaster (nemployee_unique_id,cengineer_name,ccity,cstate,ccountry,nkey_ac_manager_id,
			caddress,cmobile_number,calt_mobile_number,cuser_type,cemail_id,isAvailable,isActive,cuser_name,cpassword,dcreated_date) 
			VALUES ($employeeId,'$name','$city','$state','$country',$keyAcManagerID,
			'$address','$mobilenumber','$altmobileNumber',$userType,'$emailId',1,1,'$username','$password',now())";

            $result = mysqli_query($conn, $sql);

            $sql_select = 'SELECT cengineer_name FROM tbl_employeemaster WHERE nemployee_unique_id= $keyAcManagerID';
            $res_sql_select = mysqli_query($conn, "SELECT cengineer_name FROM tbl_employeemaster WHERE nemployee_unique_id=$keyAcManagerID");
            $result = mysqli_fetch_assoc($res_sql_select);
            $cengineer_name = $result['cengineer_name'];

            $update_sql_select = "UPDATE tbl_employeemaster
                SET ckey_ac_manager='$cengineer_name'
                WHERE cuser_name='$username'";
            $res_sql_update = mysqli_query($conn,
                $update_sql_select);

            CloseCon($conn);
            header("Location: ../controllers/employeeDetails.php");
        }

    }

}
function checkIfEmployeeCodeAlreadyExists($employeeId,$saveOrUpdate){
    $conn = OpenCon();
    $sql_u = "SELECT * FROM tbl_employeemaster WHERE nemployee_unique_id=$employeeId";
    $res_u = mysqli_query($conn, $sql_u);
    if (mysqli_num_rows($res_u) > 0) {
        if ($saveOrUpdate == 2) {
           $result = mysqli_fetch_assoc($res_u);
            $id_in_DB = $result['nemployee_unique_id'];
            if ($saveOrUpdate==2 && mysqli_num_rows($res_u)==1 && $employeeId==$id_in_DB) {
                $isEmployeeCodeAlreadyExists = false;
                CloseCon($conn);
                return $isEmployeeCodeAlreadyExists;
            }
        }
        $isEmployeeCodeAlreadyExists = true;
    } else {
        $isEmployeeCodeAlreadyExists = false;
    }
    CloseCon($conn);
    return $isEmployeeCodeAlreadyExists;
}

function checkIfUsernameAlreadyExists($username, $saveOrUpdate,$employeeId)
{
    $conn = OpenCon();
    $sql_u = "SELECT * FROM tbl_employeemaster WHERE cuser_name='$username'";
    $res_u = mysqli_query($conn, $sql_u);

    if (mysqli_num_rows($res_u) > 0) {
        if ($saveOrUpdate == 2) {
            $sql_u = "SELECT * FROM tbl_employeemaster WHERE nemployee_unique_id=$employeeId";
            $res_u = mysqli_query($conn, $sql_u);
            $result = mysqli_fetch_assoc($res_u);
            $user_in_DB = $result['cuser_name'];
            if ($saveOrUpdate==2 && mysqli_num_rows($res_u)==1 && $user_in_DB==$username) {
                $isUsernameAlreadyExists = false;
                CloseCon($conn);
                return $isUsernameAlreadyExists;
            }
        }
        $isUsernameAlreadyExists = true;
    } else {
        $isUsernameAlreadyExists = false;
    }
    CloseCon($conn);
    return $isUsernameAlreadyExists;

}


?>