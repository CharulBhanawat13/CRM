<?php
include('../db_connection.php');

if (isset($_POST['test_submit'])) {
    $conn = OpenCon();
    $internalId = $_POST['internal_id'];
    $test_code = $_POST['test_code'];

    $nid = $_POST['nid'];

    $sql = "CALL GETMAXIMUM('tbl_test','ninternal_id',@total)";
    $result = mysqli_query($conn, $sql);
    $sql="SELECT @total";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    if(is_null($row['@total'])){
        $row['@total']=0;
    }else{
        $row['@total']=$row['@total']+1;
    }
    $internalId= $row['@total'];
    $sql = "INSERT INTO tbl_test (ninternal_id,test_id) 
			VALUES ($internalId,$test_code)";
    $result = mysqli_query($conn, $sql);

    CloseCon($conn);
}


?>


