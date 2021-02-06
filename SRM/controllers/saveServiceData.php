<?php
if (isset($_POST['submit'])){
   include ('../db_connection.php');
   $conn=OpenCon();
    $serviceId=(int)$_POST['serviceId'];
    $userId=(int)$_POST['userId'];
    $ticketNo=(int)$_POST['ticketNo'];
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
    $serviceType=(int)$_POST['serviceType'];
    $warranty1=(int)$_POST['warranty1'];
    $snapshot=$_POST['snapshot'];

    $sql = "INSERT INTO tbl_service (nserviceId,nuserId,nticketNo,ccompanyName,cconcernPerson,caddress,ccontactNo,cPONo,
                dentryDate,cmailId,cremark2,cproductName,nqty,nserviceType1,nwarrantyType1,csnapshot) 
			                VALUES ($serviceId,$userId,$ticketNo,'$companyName','$concernPerson','$address','$contactNumber','$ponumber',
			'$entryDate','$email_id','$remark','$productName',$quantity,$serviceType,$warranty1,LOAD_FILE('$snapshot'))";

    $result = mysqli_query($conn, $sql);
    CloseCon($conn);
}
?>