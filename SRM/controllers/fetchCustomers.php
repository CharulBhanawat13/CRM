<?php
include('../mssql_connection.php');
include('../db_connection.php');
include ('../utils/ServiceLayer.php');

if (isset($_POST['setUserPass'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $internal_id=(int)$_POST['customer'];
    $conn = OpenCon();
    $sql="UPDATE tbl_customer 
    SET cusername='$username',cpassword='$password'
    WHERE ninternal_id=$internal_id;";
    $result = mysqli_query($conn,$sql );
    CloseCon($conn);

    $conn = OpenCon();

    $sql="Select ccustName from tbl_customer where ninternal_id=$internal_id;";
    $result = mysqli_query($conn,$sql );
    $row=mysqli_fetch_assoc($result);
    CloseCon($conn);

    $conn = OpenCon();

    $customer_name=$row['ccustName'];
    $internal_id=ServiceLayer::getMaximumID('tbl_login','nuserId');
    $sql_login_insert="INSERT INTO tbl_login(nuserId,cusername,cpassword,ntype,cname,isAvailable)
                        VALUES($internal_id,'$username','$password',3,'$customer_name',1)";
    $result = mysqli_query($conn,$sql_login_insert );
    CloseCon($conn);
}

if (isset($_POST['fetchCustomers'])) {

    $conn = OpenMSSQLCon();
    $sql = "select ac.cACName,ac.nAccount_UniqueID,ad.cAddress,ad.cGSTNo,ad.cPanNo,details.cPersonName,ad.cContactNo,ad.cEmailID from tbl_AccountMaster ac 
left outer join tbl_ACDetail_Address ad on ad.nACMasterID_UniqueID=ac.nAccount_UniqueID and ad.Is_Available=1
left outer join tbl_ACMasterDetailContactDetails details on details.nACDetailID=ad.nACDetailID and details.nACContactUniqueID=ac.nAccount_UniqueID and details.Is_Available=1
where ac.Is_Available=1 and ac.nACTypeID=18 and ad.cGSTNo<>'' and ad.cPanNo<>'' ";

    $result = sqlsrv_query($conn, $sql);
    $mysql_conn = OpenCon();
    try {
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {

            $cACName = $row['cACName'];
            $cAddress = $row['cAddress'];
            $cGSTNo = $row['cGSTNo'];
            $cPanNo = $row['cPanNo'];
            $cPersonName = $row['cPersonName'];
            $internal_id =(int)$row['nAccount_UniqueID'];
            $isPresentQuery = "SELECT IF(EXISTS(
             SELECT *
             FROM tbl_customer
             WHERE cGSTNo='$cGSTNo'), 1, 0) AS isPresent";
            $retval_isPresent = mysqli_query($mysql_conn, $isPresentQuery);
            $result_isPresent = mysqli_fetch_assoc($retval_isPresent);
            if ($result_isPresent['isPresent'] == "1") {
                $sql_mysql = "UPDATE tbl_customer 
            SET ccustName='$cACName',ccustAddress='$cAddress' ,cPANNO='$cPanNo',dupdatedDate=now()
            WHERE ninternal_id=$internal_id";
            } else {

                $sql_mysql = "INSERT INTO tbl_customer (ninternal_id,ccustName,ccustAddress,ccontactPerson,cGSTNo,CPANNo,dcreatedDate,dupdatedDate,isAvailable) 
            VALUES ($internal_id,'$cACName','$cAddress','$cPersonName','$cGSTNo','$cPanNo',now(),now(),1)";

            }
            $retval = mysqli_query($mysql_conn, $sql_mysql);

        }
    }  catch (Exception $e) {
    mysqli_rollback();
}
 CloseCon($mysql_conn);

    CloseMSSQLCon($conn);
    header("Location: ../controllers/customer.php");
}
?>