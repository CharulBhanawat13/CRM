<?php

include('../db_connection.php');
require_once('../utils/ServiceLayer.php');

if (isset($_POST['id_toDelete'])) {
    $conn = OpenCon();
    $internal_id = $_POST['id_toDelete'];
    $sql = "UPDATE tbl_organisation_group SET isAvailable =0 WHERE ninternal_id = $internal_id";
    $result = mysqli_query($conn, $sql);
    CloseCon($conn);
}

//Call for fetching details of organisation to update
if (isset($_POST['id_toUpdate'])) {
    $conn = OpenCon();
    $internal_id = (int)$_POST['id_toUpdate'];
    $sql = "Select * from tbl_organisation_group  WHERE ninternal_id = $internal_id";
    $result = mysqli_query($conn, $sql);
    $row_data = array();
    while ($row = mysqli_fetch_array($result)) {
        $row_data = array(
            "nid" => $row['nid'],
            "ninternal_id"=>$row['ninternal_id'],
            "norg_group_id"=>$row['norg_group_id'],
            "corg_group_name" => $row['corg_group_name'],
            "nsegment_id" =>$row['nsegment_id'],
            "saveOrUpdate" => '2'
        );
        $row_datas[] = $row_data;
    }
    echo json_encode($row_datas);
    CloseCon($conn);
}

if (isset($_POST['submitData'])) {
    $organisationGroupId = (int)$_POST["organisationGroupId"];
    $saveOrUpdate = $_POST["saveOrUpdate"];
    $organisationGroupName = $_POST["organisationGroupName"];
    $segmentId=(int)$_POST["segment"];
    if ($saveOrUpdate == 2) {
        $conn = OpenCon();
        $internal_id=(int)$_POST["internal_id"];

        $sql_update = "UPDATE tbl_organisation_group SET 
                norg_group_id=$organisationGroupId,
                corg_group_name='$organisationGroupName',
                nsegment_id=$segmentId,
                dupdated_date=now()
                where ninternal_id=$internal_id";

        $result = mysqli_query($conn, $sql_update);
        CloseCon($conn);

        header("Location: ../controllers/organisationGroup.php");
    } else {

        $internal_id=ServiceLayer::getMaximumID('tbl_organisation_group','ninternal_id');
        $conn = OpenCon();
        $sql = "INSERT INTO tbl_organisation_group (ninternal_id, norg_group_id,corg_group_name,nsegment_id,isActive,isAvailable,dcreated_date,dupdated_date) 
			VALUES ($internal_id,$organisationGroupId,'$organisationGroupName',$segmentId,1,1,now(),now())";

        $result = mysqli_query($conn, $sql);
        CloseCon($conn);
        echo "<script>window.location.href='../controllers/organisationGroup.php';</script>";
        exit;
    }

}


?>

