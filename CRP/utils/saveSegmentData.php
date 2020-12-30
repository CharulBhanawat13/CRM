<?php

include('../db_connection.php');
require_once('../utils/ServiceLayer.php');

if (isset($_POST['id_toDelete'])) {
    $conn = OpenCon();
    $internal_id = $_POST['id_toDelete'];
    $sql = "UPDATE tbl_segment SET isAvailable =0 WHERE ninternal_id = $internal_id";
    $result = mysqli_query($conn, $sql);
    CloseCon($conn);
}

if (isset($_POST['id_toUpdate'])) {
    $conn = OpenCon();
    $internal_id = $_POST['id_toUpdate'];
    $sql = "Select * from tbl_segment WHERE ninternal_id = $internal_id";
    $result = mysqli_query($conn, $sql);
    $row_data = array();
    while ($row = mysqli_fetch_array($result)) {
        $row_data = array(
            "nid" => $row['nid'],
            "ninternal_id"=>$row['ninternal_id'],
            "nsegment_id"=>$row['nsegment_id'],
            "csegment_name" => $row['csegment_name'],
            "saveOrUpdate" => '2'
        );
        $row_datas[] = $row_data;
    }
    echo json_encode($row_datas);
    CloseCon($conn);
}

if(isset($_POST['segment_id_forOrgGroup'])){
    $segment_id_forOrgGroup=$_POST['segment_id_forOrgGroup'];
    echo $segment_id_forOrgGroup;

    echo "hello;";
}


if (isset($_POST['submitData'])) {
    $segmentId = (int)$_POST["segmentId"];
    $saveOrUpdate = $_POST["saveOrUpdate"];
    $segmentName=$_POST["segmentName"];
    if ($saveOrUpdate == 2) {
        $conn = OpenCon();
        $internal_id=(int)$_POST["internal_id"];

        $sql_update = "UPDATE tbl_segment SET 
                nsegment_id=$segmentId,
                csegment_name='$segmentName',
                dupdated_date=now()
                where ninternal_id=$internal_id ";

        $result = mysqli_query($conn, $sql_update);
        CloseCon($conn);

        header("Location: ../controllers/segment.php");
    } else {

        $internal_id=ServiceLayer::getMaximumID('tbl_segment','ninternal_id');
        $conn = OpenCon();
        $sql = "INSERT INTO tbl_segment (ninternal_id, nsegment_id,csegment_name,isActive,isAvailable,dcreated_date,dupdated_date) 
			VALUES ($internal_id,$segmentId,'$segmentName',1,1,now(),now())";

        $result = mysqli_query($conn, $sql);


        CloseCon($conn);
        header("Location: ../controllers/segment.php");
    }


}


?>

