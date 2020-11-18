<?php
include('../db_connection.php');

if (isset($_POST['test_submit'])) {
    $conn = OpenCon();
    $internalId = $_POST['internal_id'];
    $test_code = $_POST['test_code'];

    $nid = $_POST['nid'];

    $sql = "CALL GETMAXIMUM('tbl_test','nid',@total)";
    $result = mysqli_query($conn, $sql);
    $sql="SELECT @total";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
       echo $row['@total'];
    CloseCon($conn);
}


?>


