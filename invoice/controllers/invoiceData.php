<?php
include('../mssql_connection.php');

if (isset($_POST['submit'])) {

$invoiceNumber=(int)$_POST['invoiceNum'];
    $conn = OpenMSSQLCon();
    $sql = "SELECT distinct 'GST','B2B','','','','INV',View_InvoiceMaster.cINVOICENO, View_InvoiceMaster.dINVOICEENTRYDATE,
tbl_CompanyMaster.nGSTno as CompanyGSTNo,tbl_CompanyMaster.cCompanyName,'', tbl_CompanyMaster.cAddress,'','',right(tbl_CompanyMaster.cAddress,8) pinno,'',tbl_CompanyMaster.cPhoneNo,tbl_CompanyMaster.cEmailAddress,
View_InvoiceMaster.cBillGSTNo, View_InvoiceMaster.cBillToCustName,'',View_InvoiceMaster.nBilltoGSTStateCode,View_InvoiceMaster.cBillAddress,'','',View_InvoiceMaster.nBillToZipCode,View_InvoiceMaster.nBilltoGSTStateCode,cBillToContactNo,cBillToEmailID,
tbl_CompanyMaster.cCompanyName,tbl_CompanyMaster.cAddress,'','',right(tbl_CompanyMaster.cAddress,8) pinno,'',
View_InvoiceMaster.cDespGSTNo,View_InvoiceMaster.cDespCustName,'', View_InvoiceMaster.cDespAddress,'','',View_InvoiceMaster.nDespToZIpCode,View_InvoiceMaster.nDesptoGSTStateCode,View_InvoiceMaster.cDespContactNo,View_InvoiceMaster.cDespEmailID,
View_ITEMTRANSCATION_INV.cItemSrNo,View_ITEMTRANSCATION_INV.cITEMNAME,'Y', View_ITEMTRANSCATION_INV.cTARIFFHEAD,'',View_ITEMTRANSCATION_INV.nINVOICEQTY,'' ,View_ITEMTRANSCATION_INV.cITEMUNIT,
View_ITEMTRANSCATION_INV.nRATE,(View_ITEMTRANSCATION_INV.nINVOICEQTY*View_ITEMTRANSCATION_INV.nRATE) gross,View_ITEMTRANSCATION_INV.nDISCOUNT AS nItemDISCOUNT,'',(View_ITEMTRANSCATION_INV.nAMOUNT+View_ITEMTRANSCATION_INV.nAEDED+View_ITEMTRANSCATION_INV.nFREIGHT+ View_ITEMTRANSCATION_INV.nINSURANCE+View_ITEMTRANSCATION_INV.nPNFCHARGE) Assamount,(View_ITEMTRANSCATION_INV.nTariffDuty1) gst,View_ITEMTRANSCATION_INV.nIGST AS TRN_IGST,View_ITEMTRANSCATION_INV.nCGST AS TRN_CGST, View_ITEMTRANSCATION_INV.nSGST AS TRN_SGST,
'','','','','','','',(View_ITEMTRANSCATION_INV.nIGST+View_ITEMTRANSCATION_INV.nCGST+View_ITEMTRANSCATION_INV.nSGST) TotItemVal,'','','','','',
'','','','','',(View_ITEMTRANSCATION_INV.nAMOUNT+View_ITEMTRANSCATION_INV.nAEDED+View_ITEMTRANSCATION_INV.nFREIGHT+ View_ITEMTRANSCATION_INV.nINSURANCE+View_ITEMTRANSCATION_INV.nPNFCHARGE) Assamount,'','','','','','','','',View_InvoiceMaster.nNetAmount,
(View_ITEMTRANSCATION_INV.nINVOICEQTY*View_ITEMTRANSCATION_INV.nRATE) gross,View_ITEMTRANSCATION_INV.nIGST AS TRN_IGST,View_ITEMTRANSCATION_INV.nCGST AS TRN_CGST, View_ITEMTRANSCATION_INV.nSGST AS TRN_SGST,View_InvoiceMaster.nCESS, View_ITEMTRANSCATION_INV.nDISCOUNT AS nItemDISCOUNT,View_ITEMTRANSCATION_INV.nAMOUNT,View_InvoiceMaster.nNetAmount AS TotalAmt_After_Tax,
'','','','','','','','','','','','','','','',View_InvoiceMaster.dINVOICEENTRYDATE,View_InvoiceMaster.dINVOICEENTRYDATE,
View_InvoiceMaster.cINVOICENO,View_InvoiceMaster.dINVOICEENTRYDATE,'','','','','','','', View_InvoiceMaster.cCustPONo,View_InvoiceMaster.cCustPODate ,
'','','','','','','','','','','',View_InvoiceMaster.cTransporterName,'','','','',View_InvoiceMaster.cVehicleNo,''
From View_InvoiceMaster LEFT OUTER JOIN
(SELECT     ada.nACDetailID, am.nAccount_UniqueID, am.nAccountID, ada.nACMasterID_UniqueID, ada.cECCNo, ada.cLSTNo, ada.cCSTNo, ada.cTinNO, ada.cPanNo,ada.cGSTNo,
ada.cSTaxNo, ada.cAddress, ada.cEmailID, ada.cContactNo FROM tbl_AccountMaster AS am LEFT OUTER JOIN
tbl_ACDetail_Address AS ada ON am.nAccount_UniqueID = ada.nACMasterID_UniqueID
WHERE      (ada.Is_Available = 1) AND (am.Is_Active = 1) AND (am.Is_Available = 1)) AS AccMaster ON
View_InvoiceMaster.nCUSTUNIQUEID = AccMaster.nACMasterID_UniqueID AND View_InvoiceMaster.nCustBranchID = AccMaster.nACDetailID LEFT OUTER JOIN
View_ITEMTRANSCATION_INV ON View_InvoiceMaster.nINVOICEUNIQUEID = View_ITEMTRANSCATION_INV.INVUNIQUEID AND
View_ITEMTRANSCATION_INV.cTABLETYPE = 'INV' LEFT OUTER JOIN
tbl_CompanyMaster ON View_InvoiceMaster.nCompanyID = tbl_CompanyMaster.nCmpID
LEFT OUTER JOIN (SELECT nENTRYTAKENFROM_UNIQUEID AS nINVOICEUNIQUEID, ISNULL(SUM(nRECEIVEDAMOUNT), 0) AS nRECEIVEDAMOUNT FROM tbl_VOUCHER_PAYMENT_RECV AS vpr WHERE (IS_ACTIVE = 1) AND (IS_AVAILABLE = 1) AND (cTAKINGFROMTABLE = 1)
GROUP BY nENTRYTAKENFROM_UNIQUEID) AS vpr_1 ON vpr_1.nINVOICEUNIQUEID = View_InvoiceMaster.nINVOICEUNIQUEID
WHERE (View_InvoiceMaster.IS_ACTIVE = 1) AND (View_InvoiceMaster.IS_CANCELLED = 0) and 
View_InvoiceMaster.nINVOICEUNIQUEID= ".$invoiceNumber;

    $result = sqlsrv_query($conn, $sql);
    try {
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            $prettyjson= json_encode($row,JSON_PRETTY_PRINT);
            echo '<pre>';
            echo $prettyjson;
            echo '</pre>';
        }
    }  catch (Exception $e) {
        echo "Error Occurred!";
    }

    CloseMSSQLCon($conn);
}
?>