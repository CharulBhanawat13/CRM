<?php

include('../db_connection.php');



if (isset($_POST['id_toDelete'])) {
    $conn = OpenCon();
    $callListId = $_POST['id_toDelete'];
    $sql = "UPDATE tbl_callList SET isAvailable =0 WHERE ncall_list_id = $callListId";
    $result = mysqli_query($conn, $sql);
    CloseCon($conn);

}

//Call for fetching details of organisation to update
if (isset($_POST['id_toUpdate'])) {
    $conn = OpenCon();
    $callLitsID = $_POST['id_toUpdate'];
    $sql = "Select * from tbl_callList WHERE ncall_list_id = $callLitsID";
    $result = mysqli_query($conn, $sql);
    $row_data = array();
    while ($row = mysqli_fetch_array($result)) {
        $row_data = array(
            "ncall_list_id"=>$row['ncall_list_id'],
            "ddate"    => $row['ddate'],
            "cphoneNumber"    => $row['cphoneNumber'],
            "nperson_id"   => $row['nperson_id'],
            "norg_id" => $row['norg_id'],
            "npurpose_id" => $row['npurpose_id'],
            "tbriefTalk"      => $row['tbriefTalk'],
            "dnext_date"      => $row['dnext_date'],
            "saveOrUpdate" => '2'
        );
        $row_datas[] = $row_data;
    }
    echo json_encode($row_datas);
    CloseCon($conn);
}

if (isset($_POST['submitData'])) {
    $saveOrUpdate=$_POST["saveOrUpdate"];
    $callListId = (int)$_POST["callListId"];
    $date = $_POST["date"];
    $phoneNumber = $_POST["phoneNumber"];
    $personId=(int)$_POST["personId"];
    $organisationId =(int)$_POST["organisation"];
    $purposeId = $_POST["purpose"];
    $briefTalk = $_POST["briefTalk"];
    $nextDate=$_POST["nextDate"];

    if ($saveOrUpdate == 2) {
        $conn = OpenCon();
        $sql_update = "UPDATE tbl_callList SET 
                ncall_list_id=$callListId,
                ddate='$date',
                cphoneNumber='$phoneNumber',
                nperson_id=$personId,
                norg_id=$organisationId,
                npurpose_id=$purposeId,
                tbriefTalk='$briefTalk',
                dnext_date='$nextDate',
                dupdated_date=now()
                where ncall_list_id=$callListId ";

        $result = mysqli_query($conn, $sql_update);
        header("Location: ../controllers/callList.php");
    } else {
        $conn = OpenCon();
        $sql = "INSERT INTO tbl_callList (ncall_list_id,ddate,cphoneNumber,nperson_id,norg_id,npurpose_id,tbriefTalk,dnext_date,isActive,isAvailable,
            dcreated_date,dupdated_date) 
			VALUES ($callListId,'$date','$phoneNumber',$personId,$organisationId,$purposeId,'$briefTalk','$nextDate',1,1,now(),now())";
        $result = mysqli_query($conn, $sql);
        CloseCon($conn);
        header("Location: ../controllers/callList.php");
    }
}
?>

