<?php

include('../db_connection.php');

if (isset($_POST['id_toDelete'])) {
    $conn = OpenCon();
    $personId = $_POST['id_toDelete'];
    $sql = "UPDATE tbl_contactperson SET isAvailable =0 WHERE ncontact_person_id = $personId";
    $result = mysqli_query($conn, $sql);
    CloseCon($conn);
}

//Call for fetching details of organisation to update
if (isset($_POST['id_toUpdate'])) {
    $conn = OpenCon();
    $personId = $_POST['id_toUpdate'];
    $sql = "Select * from tbl_contactperson WHERE ncontact_person_id = $personId";
    $result = mysqli_query($conn, $sql);
    $row_data = array();
    while ($row = mysqli_fetch_array($result)) {
        $row_data = array(
            "ncontact_person_id"=>$row['ncontact_person_id'],
            "cperson_name"    => $row['cperson_name'],
            "cdepartment"    => $row['cdepartment'],
            "cmobile_number"   => $row['cmobile_number'],
            "cphone_number" => $row['cphone_number'],
            "cemail_id" => $row['cemail_id'],
            "norg_id"      => $row['norg_id'],
            "saveOrUpdate" => '2'
        );
        $row_datas[] = $row_data;
    }
    echo json_encode($row_datas);
    CloseCon($conn);
}

if (isset($_POST['submitData'])) {
    $contactPersonId = (int)$_POST["contactPersonId"];
    $saveOrUpdate = $_POST["saveOrUpdate"];

    $name = $_POST["name"];
    $department_id = (int)ST["dept"];
    $mobileNumber = $_POST["mobileNumber"];
    $phoneNumber=$_POST["phoneNumber"];
    $emailId = $_POST["emailId"];
    $organisationId=(int)$_POST["organisation"];

    if ($saveOrUpdate == 2) {
        $conn = OpenCon();
        // 2 stands for Update Data in tbl_employeemaster
        $sql_update = "UPDATE tbl_contactperson SET 
                ncontact_person_id=$contactPersonId,
                cperson_name='$name',
                ndept_id=$department_id,
                cmobile_number='$mobileNumber',
                cphone_number='$phoneNumber',
                cemail_id='$emailId',
                norg_id=$organisationId,
                dupdated_date=now()
                where nid=$contactPersonId ";

        $result = mysqli_query($conn, $sql_update);
        CloseCon($conn);

        header("Location: ../controllers/contactPerson.php");
    } else {
        $conn = OpenCon();
        // Save Data in tbl_employeemaster
        $sql = "INSERT INTO tbl_contactperson (ncontact_person_id,cperson_name,ndept_id,cmobile_number,cphone_number,cemail_id,norg_id,
            isActive,isAvailable,dcreated_date,dupdated_date) 
			VALUES ($contactPersonId,'$name',$department_id,'$mobileNumber','$phoneNumber','$emailId',$organisationId,1,1,now(),now())";

        $result = mysqli_query($conn, $sql);


        CloseCon($conn);
        header("Location: ../controllers/contactPerson.php");
    }


}


?>

