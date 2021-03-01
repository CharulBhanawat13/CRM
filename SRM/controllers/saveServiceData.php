<?php
if (isset($_POST['submit'])){
   include ('../db_connection.php');
   $conn=OpenCon();

    $userId=(int)$_POST['userId'];
    $serviceId=(int)$_POST['serviceId'];
    $ticketNo=$_POST['ticketNo'];
    $companyName=$_POST['companyName'];
    $concernPerson=$_POST['concernPerson'];
    $contactNumber=$_POST['contactNumber'];
    $address=$_POST['address'];
    $ponumber=$_POST['ponumber'];
    $entryDate=$_POST['entryDate'];
    $email_id=$_POST['emailId'];
    $remark1=$_POST['remark1'];
        $targetDir = "uploads/";
        $fileName = basename($_FILES["snapshot"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
    $productName=$_POST['productName'];
    $quantity=(int)$_POST['quantity'];
    $serviceType=$_POST['serviceType'];
    $warranty1=(int)$_POST['warranty1'];


    $empId=(int)$_POST['empId'];
    $empId2=(int)$_POST['empId2'];
    $rating=$_POST['rating'];
    $remarkByCustomer=$_POST['remarkByCustomer'];
    if($serviceId!="" &&  $empId!="0" && $empId2=="0"){
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
    else if ($serviceId!="" && $empId2!="0" &&  ((empty($rating)) || (empty($remarkByCustomer)))){
        $materialReceived=$_POST['materialReceived'];
        $receiveQuantity=$_POST['receiveQuantity'];
        $warranty3=$_POST['warranty3'];
        $faultDescription=$_POST['faultDescription'];
        $completionDate=$_POST['completionDate'];
        $remark3=$_POST['remark3'];
        $billingAmount=$_POST['billingAmount'];
        $sql="UPDATE tbl_service 
            SET nempId2=$empId2 ,cmaterialReceived='$materialReceived' ,nrecieveQty=$receiveQuantity ,nwarrantyType3=$warranty3, cfaultDesc='$faultDescription' , 
            dcompletionDate='$completionDate' ,cremark3='$remark3' ,nbillingAmount=$billingAmount 
            where nserviceId=$serviceId";
    }

   else if ($serviceId!="" && (!(empty($rating)) || !(empty($remarkByCustomer)))  ){

        $sql="UPDATE tbl_service 
            SET nrating =$rating ,cremarkByCust='$remarkByCustomer'
            where nserviceId=$serviceId";

    }

    else{
        $sql = "INSERT INTO tbl_service (nserviceId,nuserId,cticketNo,ccompanyName,cconcernPerson,caddress,ccontactNo,cPONo,
                dentryDate,cmailId,cremark1,cproductName,nqty,cserviceType1,nwarrantyType1,csnapshot) 
			                VALUES ($serviceId,$userId,'$ticketNo','$companyName','$concernPerson','$address','$contactNumber','$ponumber',
			'$entryDate','$email_id','$remark1','$productName',$quantity,'$serviceType',$warranty1,'$fileName')";
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
            "nuserId"=>$row['nuserId'],
        // page complain
            "nserviceId"=>$row['nserviceId'],
            "cticketNo"    => $row['cticketNo'],
            "ccompanyName"   => $row['ccompanyName'],
            "cconcernPerson" => $row['cconcernPerson'],
            "ccontactNo"      => $row['ccontactNo'],
            "caddress" => $row['caddress'],
            "cPONo"      => $row['cPONo'],
            "dentryDate"      => $row['dentryDate'],
            "cmailId"      => $row['cmailId'],
            "remark1"       =>$row['cremark1'],
            "csnapshot"      => $row['csnapshot'],
            "cproductName"      => $row['cproductName'],
            "nqty"      => $row['nqty'],
            "cserviceType1"      => $row['cserviceType1'],
            "nwarrantyType1"      => $row['nwarrantyType1'],

        //page action
            "nempId"    => $row['nempId'],
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
// page result
            "nempId2" => $row['nempId2'],
            "cmaterialReceived"      => $row['cmaterialReceived'],
            "nrecieveQty"      => $row['nrecieveQty'],
            "nwarrantyType3"      => $row['nwarrantyType3'],
            "cfaultDesc"      => $row['cfaultDesc'],
            "dcompletionDate"      => $row['dcompletionDate'],
            "cremark3"      => $row['cremark3'],
            "nbillingAmount"      => $row['nbillingAmount'],
 //page remarks
            "nrating"      => $row['nrating'],
            "cremarkByCust"      => $row['cremarkByCust'],
            "isAvailable"      => $row['isAvailable'],
        );
        $row_datas[] = $row_data;
    }
    echo json_encode($row_datas);
    CloseCon($conn);

}

if (isset($_POST['complain_service_id'])){
    include ('../db_connection.php');
    $conn=OpenCon();
    $serviceId=(int)$_POST['complain_service_id'];
    $sql="Select nid from tbl_service where nserviceId=$serviceId";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_row($result);
    if ($row[0]){
        $result=true;
    } else{
        $result=false;
    }
echo json_encode($result);
    CloseCon($conn);
}

if (isset($_POST['action_taken_service_id'])){
    include ('../db_connection.php');
    $conn=OpenCon();
    $serviceId=(int)$_POST['action_taken_service_id'];
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


if (isset($_POST['result_taken_service_id'])){
    include ('../db_connection.php');
    $conn=OpenCon();
    $serviceId=(int)$_POST['result_taken_service_id'];
    $sql="Select nempId2 from tbl_service where nserviceId=$serviceId";
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