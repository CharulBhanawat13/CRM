<?php
 

include('../db_connection.php');
require_once('../utils/ServiceLayer.php');

if (isset($_POST['id_toDelete'])) {
    $conn = OpenCon();
    $internal_id = $_POST['id_toDelete'];
    $sql = "UPDATE tbl_tour SET isAvailable =0 ,dupdated_date=now() WHERE ninternal_id = $internal_id";
    $result = mysqli_query($conn, $sql);
    CloseCon($conn);

}

if (isset($_POST['norg_id'])){
    $conn=OpenCon();
    $organisationId = (int)$_POST["norg_id"];
    $result = mysqli_query($conn,"SELECT ninternal_id,ncontact_person_id,cperson_name FROM tbl_contactperson where norg_id = $organisationId");
    ?>
    <option value="">Select Person</option>
    <?php
    while($row = mysqli_fetch_array($result)) {
        ?>
        <option value="<?php echo $row["ninternal_id"];?>" selected><?php echo $row["cperson_name"];?></option>
        <?php
    }
    CloseCon($conn);
}

//Call for fetching details of organisation to update
if (isset($_POST['id_toUpdate'])) {
    $conn = OpenCon();
    $internal_id = $_POST['id_toUpdate'];
    $sql = "Select t.ninternal_id,t.ntour_id,t.ddate,t.norg_id,t.nperson_to_meet_id,c.cperson_name,t.npurpose_id,
        t.tbriefTalk,t.dnext_date,c.ncontact_person_id,t.nta,t.nda,t.nmiscExpense,t.cmanagementRemark
        from tbl_tour AS t 
        JOIN tbl_contactperson AS c 
        ON t.nperson_to_meet_id=c.ninternal_id
        WHERE t.ninternal_id = $internal_id";
    $result = mysqli_query($conn, $sql);
    $row_data = array();
    while ($row = mysqli_fetch_array($result)) {
        $row_data = array(
            "ninternal_id"=>$row['ninternal_id'],
            "ntour_id" => $row['ntour_id'],
            "ddate"    => $row['ddate'],
            "norg_id" =>$row['norg_id'],
            "nperson_to_meet_id" => $row['nperson_to_meet_id'],
            "cperson_name" => $row['cperson_name'],
            "npurpose_id" => $row['npurpose_id'],
            "tbriefTalk"      => $row['tbriefTalk'],
            "dnext_date"      => $row['dnext_date'],
            "nta"           => $row['nta'],
            "nda"           => $row['nda'],
            "nmiscExpense"  => $row['nmiscExpense'],
            "cmanagementRemark" => $row['cmanagementRemark'],
            "saveOrUpdate" => '2'
        );
        $row_datas[] = $row_data;
    }
    echo json_encode($row_datas);
    CloseCon($conn);
}

if (isset($_POST['submitData'])) {
    $internal_id=(int)$_POST["internal_id"];
    $saveOrUpdate=$_POST["saveOrUpdate"];
    $tour_id = (int)$_POST["tourId"];
    $date = $_POST["date"];
    $organisationId=(int)$_POST["organisationId"];
    $person_to_meet_id=(int)$_POST["personToMeet"];
    $purposeId =(int)$_POST["purpose"];
    $briefTalk = $_POST["briefTalk"];
    $nextDate=$_POST["nextDate"];
    $ta=(int)$_POST["ta"];
    $da=(int)$_POST["da"];
    $miscExpense=(int)$_POST["miscExpense"];
    $mangementRemark=$_POST["managementRemark"];

    if ($saveOrUpdate == 2) {
        $conn = OpenCon();
        $sql_update = "UPDATE tbl_tour SET 
                ntour_id=$tour_id,
                ddate='$date',
                norg_id=$organisationId,
                nperson_to_meet_id=$person_to_meet_id,
                npurpose_id=$purposeId,
                tbriefTalk='$briefTalk',
                dnext_date='$nextDate',
                cmanagementRemark='$mangementRemark',    
                dupdated_date=now()
                where ninternal_id=$internal_id ";

        $result = mysqli_query($conn, $sql_update);
       echo "<script>window.location.href='../controllers/tour.php';</script>";
        exit;
    } else {
        // session_start();
        // if (isset($_SESSION['user_id']) ) {
        //     $logged_in_user_id =(int) $_SESSION['user_id'];
        // }
        $logged_in_user_id=1;
     //   $internal_id=ServiceLayer::getMaximumID('tbl_tour','ninternal_id');
     $internal_id=2;
        $conn = OpenCon();
        $sql = "INSERT INTO tbl_tour (ninternal_id,ntour_id,nlogged_in_user_id,ddate,norg_id,nperson_to_meet_id,npurpose_id,tbriefTalk,dnext_date,
                      nta,nda,nmiscExpense,cmanagementRemark,isActive,isAvailable,
            dcreated_date,dupdated_date) 
			VALUES ($internal_id,$tour_id,$logged_in_user_id,'$date',$organisationId,$person_to_meet_id,$purposeId,'$briefTalk','$nextDate',
			        $ta,$da,$miscExpense,'$mangementRemark',1,1,now(),now())";
        $result = mysqli_query($conn, $sql);
        CloseCon($conn);
       
         echo "<script>window.location.href='../controllers/tour.php';</script>";
         exit;
    }
}
?>

