<?php

include('../db_connection.php');
require_once('../utils/ServiceLayer.php');

if (isset($_POST['id_toDelete'])) {
    $conn = OpenCon();
    $internal_id = $_POST['id_toDelete'];
    $sql = "UPDATE tbl_visitplan SET isAvailable =0 WHERE ninternal_id = $internal_id";
    $result = mysqli_query($conn, $sql);
    CloseCon($conn);

}

if (isset($_POST['norg_id'])){
    $conn=OpenCon();
    $organisationId = (int)$_POST["norg_id"];
    $result = mysqli_query($conn,"SELECT ncontact_person_id,cperson_name FROM tbl_contactperson where norg_id = $organisationId");
    ?>
    <option value="">Select Person</option>
    <?php
    while($row = mysqli_fetch_array($result)) {
        ?>
        <option value="<?php echo $row["ncontact_person_id"];?>" selected><?php echo $row["cperson_name"];?></option>
        <?php
    }
    CloseCon($conn);
}

//Call for fetching details of organisation to update
if (isset($_POST['id_toUpdate'])) {
    $conn = OpenCon();
    $internal_id = $_POST['id_toUpdate'];
    $sql = "Select * from tbl_visitplan AS v 
        JOIN tbl_contactperson AS c 
        ON v.nperson_to_meet_id=c.ncontact_person_id
        WHERE v.ninternal_id = $internal_id";
    $result = mysqli_query($conn, $sql);
    $row_data = array();
    while ($row = mysqli_fetch_array($result)) {
        $row_data = array(
            "ninternal_id"=>$row['ninternal_id'],
            "nvisit_plan_id" => $row['nvisit_plan_id'],
            "ddate"    => $row['ddate'],
            "norg_id" =>$row['norg_id'],
            "ccity" => $row['ccity'],
            "nperson_to_meet_id" => $row['nperson_to_meet_id'],
            "cperson_name" => $row['cperson_name'],
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
    $internal_id=$_POST["internal_id"];
    $saveOrUpdate=$_POST["saveOrUpdate"];
    $visitplan_id = (int)$_POST["visitPanId"];
    $date = $_POST["date"];
    $organisationId=(int)$_POST["organisationId"];
    $city=$_POST["city"];
    $person_to_meet_id=(int)$_POST["personToMeet"];
    $purposeId = $_POST["purpose"];
    $briefTalk = $_POST["briefTalk"];
    $nextDate=$_POST["nextDate"];

    if ($saveOrUpdate == 2) {
        $conn = OpenCon();
        $sql_update = "UPDATE tbl_visitplan SET 
                nvisit_plan_id=$visitplan_id,
                ddate='$date',
                norg_id=$organisationId,
                ccity='$city',
                nperson_to_meet_id=$person_to_meet_id,
                npurpose_id=$purposeId,
                tbriefTalk='$briefTalk',
                dnext_date='$nextDate',
                dupdated_date=now()
                where ninternal_id=$internal_id ";

        $result = mysqli_query($conn, $sql_update);
        header("Location: ../controllers/visitPlan.php");
    } else {
        $internal_id=ServiceLayer::getMaximumID('tbl_visitplan','ninternal_id');
        $conn = OpenCon();
        $sql = "INSERT INTO tbl_visitplan (ninternal_id,nvisit_plan_id,ddate,norg_id,ccity,nperson_to_meet_id,npurpose_id,tbriefTalk,dnext_date,isActive,isAvailable,
            dcreated_date,dupdated_date) 
			VALUES ($internal_id,$visitplan_id,'$date',$organisationId,'$city',$person_to_meet_id,$purposeId,'$briefTalk','$nextDate',1,1,now(),now())";
        $result = mysqli_query($conn, $sql);
        CloseCon($conn);
        header("Location: ../controllers/visitPlan.php");
    }
}
?>

