<?php
if (isset($_POST['submit'])){
   include ('../db_connection.php');
   $conn=OpenCon();
    $serviceId=(int)$_POST['serviceId'];
    $userId=(int)$_POST['userId'];
    $ticketNo=$_POST['ticketNo'];
    $companyName=$_POST['companyName'];
    $concernPerson=$_POST['concernPerson'];
    $contactNumber=$_POST['contactNumber'];
    $address=$_POST['address'];
    $ponumber=$_POST['ponumber'];
    $entryDate=$_POST['entryDate'];
    $email_id=$_POST['emailId'];
    $remark=$_POST['remark'];
    $productName=$_POST['productName'];
    $quantity=(int)$_POST['quantity'];
    $serviceType=$_POST['serviceType'];
    $warranty1=(int)$_POST['warranty1'];


    $empId=(int)$_POST['empId'];



    $rating=$_POST['rating'];
    $remarkByCustomer=$_POST['remarkByCustomer'];
    $targetDir = "uploads/";
    $fileName = basename($_FILES["snapshot"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

 //   $snapshot=$_POST['snapshot'];
    if ($serviceId!="" && (!(empty($rating)) || !(empty($remarkByCustomer)))  ){

        $sql="UPDATE tbl_service 
            SET nrating =$rating ,cremarkByCust='$remarkByCustomer'
            where nserviceId=$serviceId";

    }else if($serviceId!="" &&  (!(empty($empId)))){
        $empId=(int)$_POST['empId'];
        $recordManager=$_POST['recordManager'];
        $serviceType2=(int)$_POST['serviceType2'];
        $expiryDate=$_POST['expiryDate'];
        $paymentMode=(int)$_POST['paymentMode'];
        $remark2=$_POST['remark2'];
        $expPrice=(int)$_POST['expPrice'];
        $warranty2=(int)$_POST['warranty2'];
        $materialRecDate=$_POST['materialRecDate'];
        $attendantBy=$_POST['attendantBy'];
        $siteAttendDate=$_POST['siteAttendDate'];
        $complainStatus=(int)$_POST['complainStatus'];
        $sql="UPDATE tbl_service 
            SET nempId=$empId ,crecordManager='$recordManager' ,nserviceType2=$serviceType2 ,dexpDate='$expiryDate', npaymentMode=$paymentMode , 
            cremark2='$remark2' ,nexpPrice=$expPrice ,nwarrantyType2=$warranty2 ,dmaterialRecDate ='$materialRecDate', cattendBy ='$attendantBy',
             dsiteAttendDate='$siteAttendDate' , nComplainStatus = $complainStatus
            where nserviceId=$serviceId";
    }

    else{
        $sql = "INSERT INTO tbl_service (nserviceId,nuserId,cticketNo,ccompanyName,cconcernPerson,caddress,ccontactNo,cPONo,
                dentryDate,cmailId,cremark2,cproductName,nqty,cserviceType1,nwarrantyType1,csnapshot) 
			                VALUES ($serviceId,$userId,'$ticketNo','$companyName','$concernPerson','$address','$contactNumber','$ponumber',
			'$entryDate','$email_id','$remark','$productName',$quantity,'$serviceType',$warranty1,'$fileName')";
    }

    $result = mysqli_query($conn, $sql);

    CloseCon($conn);
    header("Location: ../controllers/services.php");

}
if (isset($_POST['service_id'])){
    include ('../db_connection.php');

    $conn=OpenCon();
    $serviceId=(int)$_POST['service_id'];
    $sql="Select * from tbl_service where nserviceId=$serviceId;";
    $result=mysqli_query($conn,$sql);

    $row_data = array();
    while ($row = mysqli_fetch_array($result)) {
        $row_data = array(
            "nid" => $row['nid'],
            "nserviceId"=>$row['nserviceId'],
            "nuserId"=>$row['nuserId'],
            "nempId"    => $row['nempId'],
            "cticketNo"    => $row['cticketNo'],
            "ccompanyName"   => $row['ccompanyName'],
            "cconcernPerson" => $row['cconcernPerson'],
            "caddress" => $row['caddress'],
            "ccontactNo"      => $row['ccontactNo'],
            "cPONo"      => $row['cPONo'],
            "cmailId"      => $row['cmailId'],
            "cproductName"      => $row['cproductName'],
            "nqty"      => $row['nqty'],
            "cserviceType1"      => $row['cserviceType1'],
            "nwarrantyType1"      => $row['nwarrantyType1'],
            "dentryDate"      => $row['dentryDate'],
            "csnapshot"      => $row['csnapshot'],
            "crecordManager"      => $row['crecordManager'],
            "nserviceType2"      => $row['nserviceType2'],
            "dexpDate"      => $row['dexpDate'],
            "npaymentMode"      => $row['npaymentMode'],

            "cremark2"      => $row['cremark2'],
            "nexpPrice"      => $row['nexpPrice'],
            "nwarrantyType2"      => $row['nwarrantyType2'],
            "dmaterialRecDate"      => $row['dmaterialRecDate'],
            "cattendBy"      => $row['cattendBy'],
            "dsiteAttendDate"      => $row['dsiteAttendDate'],

            "nComplainStatus"      => $row['nComplainStatus'],
            "cmaterialReceived"      => $row['cmaterialReceived'],
            "nrecieveQty"      => $row['nrecieveQty'],
            "nwarrantyType3"      => $row['nwarrantyType3'],
            "cfaultDesc"      => $row['cfaultDesc'],
            "dcompletionDate"      => $row['dcompletionDate'],

            "cremark3"      => $row['cremark3'],
            "nbillingAmount"      => $row['nbillingAmount'],
            "nrating"      => $row['nrating'],
            "cremarkByCust"      => $row['cremarkByCust'],
            "isAvailable"      => $row['isAvailable'],
        );
        $row_datas[] = $row_data;
    }
    echo json_encode($row_datas);
    CloseCon($conn);

}

if (isset($_POST['action_taken_serviceId'])){
    include ('../db_connection.php');
    $conn=OpenCon();
    $serviceId=(int)$_POST['action_taken_serviceId'];
    $sql="Select nempId from tbl_service where nserviceId=$serviceId";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_row($result);
    if ($row[0]=="0"){
        $result=false;
    } else{
        $result=true;
    }
echo json_encode($result);
    CloseCon($conn);
}

?>