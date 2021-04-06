<?php
include('../mssql_connection.php');
include('../db_connection.php');

if (isset($_POST['id_toUpdate'])) {
    $conn = OpenCon();
    $item_id = $_POST['id_toUpdate'];
    $sql = "Select * from tbl_stock WHERE nitem_id = $item_id";
    $result = mysqli_query($conn, $sql);
    $row_data = array();
    while ($row = mysqli_fetch_array($result)) {
        $row_data = array(
            "nitem_id" => $row['nitem_id'],
            "citem_name"=>$row['citem_name'],
            "ndivision_id" => $row['ndivision_id'],
            "titem_description" => $row['titem_description'],
            "nfactory_quantity" => $row['nfactory_quantity'],
            "calternate_code" => $row['calternate_code'],
            "dupdated_date" => $row['dupdated_date'],

        );
        $row_datas[] = $row_data;
    }
    echo json_encode($row_datas);
    CloseCon($conn);
}
if (isset($_POST['fetchStockData'])){

    $conn=OpenMSSQLCon();
    $sql="Select nUniqueID,nItemCode,nDivisionID,cAlternateCode,cItemDesc,cItemName,nFacQty,im.cSession 
        from tbl_ItemMaster as im
        LEFT OUTER JOIN tbl_Item_Qty_Balance as iqb
        on im.nUniqueID=iqb.nItemMasterUniqueID AND iqb.Is_Available=1 AND iqb.cSession='2021'
        join tbl_ItemSubGroupMaster as iSubGM
        ON iSubGM.nitemSubGRoup_UniqueID=im.nItemSubGroupID_UniqueID
        JOIN tbl_ItemGroupMaster as iGM 
        on iSubGM.nIGID_UniqueID=iGM.nItemGroupUniqueID 
        join tbl_ItemSuperGroup as iSuperG
        on iSuperG.nItemSGroupID =iGM.nItemSuperGroupID
        where (im.Is_Available=1 And iSuperG.cItemSGroup LIKE ('INTERNAL FINISHED GOODS') )";

    $result=sqlsrv_query($conn,$sql);
    $mysql_conn=OpenCon();
    while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)) {
        $item_id=(int)$row['nUniqueID'];
        $division_id=(int)$row['nDivisionID'];
        $item_name=$row['cItemName'];
        $item_description=$row['cItemDesc'];
        $factory_quantity=(int)$row['nFacQty'];
        $alternate_code=$row['cAlternateCode'];
        $isPresentQuery="SELECT IF(EXISTS(
             SELECT *
             FROM tbl_stock
             WHERE nitem_id=$item_id), 1, 0) AS isPresent";
        $retval_isPresent=mysqli_query($mysql_conn,$isPresentQuery);

        $result_isPresent = mysqli_fetch_assoc($retval_isPresent);

        if ($result_isPresent['isPresent']=="1"){
            $sql_mysql="UPDATE tbl_stock 
            SET ndivision_id=$division_id,citem_name='$item_name',titem_description='$item_description',nfactory_quantity=$factory_quantity,
            calternate_code='$alternate_code',dupdated_date=now()
            WHERE nitem_id=$item_id";
        }else{
            $sql_mysql="INSERT INTO tbl_stock (nitem_id,ninternal_id,ndivision_id,citem_name,titem_description,nfactory_quantity,
                calternate_code,isActive,isAvailable,dcreated_date,dupdated_date) 
            VALUES ($item_id,$item_id,$division_id,'$item_name','$item_description',$factory_quantity,'$alternate_code',1,1,now(),now())";
        }
        $retval = mysqli_query($mysql_conn, $sql_mysql);

    }
    CloseCon($mysql_conn);

    CloseMSSQLCon($conn);
    echo "<script>window.location.href='../controllers/stock.php';</script>";
    exit;

}
?>