<?php

include('../db_connection.php');
require_once('../utils/ServiceLayer.php');

if (isset($_POST['id_toDelete'])) {
    $conn = OpenCon();
    $internal_id = $_POST['id_toDelete'];
    $sql = "UPDATE tbl_organisation SET isAvailable =0,dupdated_date=now() WHERE ninternal_id = $internal_id";
    $result = mysqli_query($conn, $sql);
    CloseCon($conn);
}

//Call for fetching details of organisation to update
if (isset($_POST['id_toUpdate'])) {
    $conn = OpenCon();
    $internal_id = $_POST['id_toUpdate'];
    $sql = "Select * from tbl_organisation WHERE ninternal_id = $internal_id";
    $result = mysqli_query($conn, $sql);
    $row_data = array();
    while ($row = mysqli_fetch_array($result)) {
        $row_data = array(
            "nid" => $row['nid'],
            "ninternal_id"=>$row['ninternal_id'],
            "norg_id"=>$row['norg_id'],
            "corg_name" => $row['corg_name'],
            "corg_city" => $row['corg_city'],
            "corg_state" => $row['corg_state'],
            "corg_country" => $row['corg_country'],
            "corg_address" => $row['corg_address'],
            "corg_mobileNumber" => $row['corg_mobileNumber'],
            "corg_emailId" => $row['corg_emailId'],
            "norg_segment_id" => $row['norg_segment_id'],
            "saveOrUpdate" => '2'
        );
        $row_datas[] = $row_data;
    }
    echo json_encode($row_datas);
    CloseCon($conn);
}

if (isset($_POST['submitData'])) {
    $organisationId = (int)$_POST["organisationId"];
    $saveOrUpdate = $_POST["saveOrUpdate"];
    $name = $_POST["name"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $country = $_POST["country"];
    $mobileNumber = $_POST["mobileNumber"];
    $emailId = $_POST["emailId"];
    $segment_id=$_POST["segment"];


    if ($saveOrUpdate == 2) {
        $conn = OpenCon();
        $internal_id=(int)$_POST["internal_id"];

        // 2 stands for Update Data in tbl_employeemaster
        $sql_update = "UPDATE tbl_organisation SET 
                norg_id=$organisationId,
                corg_name='$name',
                corg_city='$city',
                corg_state='$state',
                corg_country='$country',
                corg_address='$address',
                corg_mobileNumber='$mobileNumber',
                corg_emailId='$emailId',
                norg_segment_id='$segment_id',
                dupdated_date=now()
                where ninternal_id=$internal_id ";

        $result = mysqli_query($conn, $sql_update);
        CloseCon($conn);

        header("Location: ../controllers/organisation.php");
    } else {

        $internal_id=ServiceLayer::getMaximumID('tbl_organisation','ninternal_id');
        $conn = OpenCon();
        // Save Data in tbl_employeemaster
        $sql = "INSERT INTO tbl_organisation (ninternal_id, norg_id,corg_name,corg_city,corg_state,corg_country,corg_address,corg_mobileNumber,corg_emailId,norg_segment_id,
isActive,isAvailable,dcreated_date,dupdated_date) 
			VALUES ($internal_id,$organisationId,'$name','$city','$state','$country','$address','$mobileNumber','$emailId',$segment_id,1,1,now(),now())";

        $result = mysqli_query($conn, $sql);


        CloseCon($conn);
        header("Location: ../controllers/organisation.php");
    }


}


?>

