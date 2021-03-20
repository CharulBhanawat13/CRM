<html>
<head>

    <link rel="stylesheet" href="../css/styles.css">

</head>

<?php
include('../mssql_connection.php');
$json = '';
if (isset($_POST['submit'])) {

    $invoiceNumber = $_POST['invoiceNum'];
    $conn = OpenMSSQLCon();
    $sql = "SELECT distinct  'GST','B2B','INV',View_InvoiceMaster.cINVOICENO, View_InvoiceMaster.dINVOICEENTRYDATE,View_InvoiceMaster.nTCSAmount,View_InvoiceMaster.nTCSRate,

 tbl_CompanyMaster.nGSTno as CompanyGSTNo,tbl_CompanyMaster.cCompanyName, tbl_CompanyMaster.cAddress,right(tbl_CompanyMaster.cAddress,8) pinno,tbl_CompanyMaster.cPhoneNo,tbl_CompanyMaster.cEmailAddress, AddressDtl.cCityName,AddressDtl.nStateID,AddressDtl.nGSTStateCode,

     View_InvoiceMaster.cBillGSTNo, View_InvoiceMaster.cBillToCustName, View_InvoiceMaster.cDespCustCityName,View_InvoiceMaster.cBillToCityName,View_InvoiceMaster.nBilltoGSTStateCode,View_InvoiceMaster.cBillAddress,View_InvoiceMaster.nBillToZipCode,View_InvoiceMaster.nBilltoGSTStateCode,cBillToContactNo,cBillToEmailID,

 tbl_CompanyMaster.cCompanyName,tbl_CompanyMaster.cAddress,right(tbl_CompanyMaster.cAddress,8) pinno,
 
 --shiptodetails
     View_InvoiceMaster.cDespGSTNo,View_InvoiceMaster.cDespCustName, View_InvoiceMaster.cDespAddress,View_InvoiceMaster.nDespToZIpCode,View_InvoiceMaster.nDesptoGSTStateCode,View_InvoiceMaster.cDespContactNo,View_InvoiceMaster.cDespEmailID,
     
  --itemdetails
  View_ITEMTRANSCATION_INV.cItemSrNo,View_ITEMTRANSCATION_INV.nITEMUNIQUEID ,View_ITEMTRANSCATION_INV.cITEMNAME,(case when SUBSTRING(View_InvoiceMaster.cOrderNature,0,2)='S' then 'Y' else 'N' end) Is_Servicing, View_ITEMTRANSCATION_INV.cTARIFFHEAD,View_ITEMTRANSCATION_INV.cITEMUNIT,View_ITEMTRANSCATION_INV.nRATE,(View_ITEMTRANSCATION_INV.nINVOICEQTY*View_ITEMTRANSCATION_INV.nRATE) gross,View_ITEMTRANSCATION_INV.nDISCOUNT AS nItemDISCOUNT,(View_ITEMTRANSCATION_INV.nAMOUNT+View_ITEMTRANSCATION_INV.nAEDED+View_ITEMTRANSCATION_INV.nFREIGHT+ View_ITEMTRANSCATION_INV.nINSURANCE+View_ITEMTRANSCATION_INV.nPNFCHARGE) Assamount,(View_ITEMTRANSCATION_INV.nTariffDuty1) gst,View_ITEMTRANSCATION_INV.nIGST AS TRN_IGST,View_ITEMTRANSCATION_INV.nCGST AS TRN_CGST, View_ITEMTRANSCATION_INV.nSGST AS TRN_SGST,(View_ITEMTRANSCATION_INV.nIGST+View_ITEMTRANSCATION_INV.nCGST+View_ITEMTRANSCATION_INV.nSGST) TotItemVal,

  --valuedetails
  (View_ITEMTRANSCATION_INV.nAMOUNT+View_ITEMTRANSCATION_INV.nAEDED+View_ITEMTRANSCATION_INV.nFREIGHT+ View_ITEMTRANSCATION_INV.nINSURANCE+View_ITEMTRANSCATION_INV.nPNFCHARGE) Assamount,View_InvoiceMaster.nNetAmount,
  
 --valdtls
 (View_ITEMTRANSCATION_INV.nINVOICEQTY*View_ITEMTRANSCATION_INV.nRATE) gross,View_ITEMTRANSCATION_INV.nIGST AS TRN_IGST,View_ITEMTRANSCATION_INV.nCGST AS TRN_CGST, View_ITEMTRANSCATION_INV.nSGST AS TRN_SGST,View_InvoiceMaster.nCESS, View_ITEMTRANSCATION_INV.nDISCOUNT AS nItemDISCOUNT,View_ITEMTRANSCATION_INV.nAMOUNT,View_InvoiceMaster.nNetAmount AS TotalAmt_After_Tax, 

 --documentperioddetails
 
 View_InvoiceMaster.dINVOICEENTRYDATE,View_InvoiceMaster.dINVOICEENTRYDATE,
 
 --precedingdocumentdetails
 
 View_InvoiceMaster.cINVOICENO,View_InvoiceMaster.dINVOICEENTRYDATE,
 
View_InvoiceMaster.cCustPODate ,
 

 --ewbdtls
View_InvoiceMaster.cTransporterName,View_InvoiceMaster.cVehicleNo,

--sellerdtls
case when View_InvoiceMaster.nCompanyDivisionID=4 then 'lighting@peplelectronics.com' else case when View_InvoiceMaster.nCompanyDivisionID=5 then 'leddriver@peplelectronics.com' else 'pyrotech@peplelectronics.com' end end Emailid,tbl_CompanyMaster.cCompanyName SellerTrdName,tbl_CompanyMaster.cPhoneNo,tbl_CompanyMaster.cAddress,

--buyerdtls

View_InvoiceMaster.cBillToCustName BuyerTradeName,View_InvoiceMaster.cBillAddress,View_InvoiceMaster.cBillToCityName,AddressDtl.cContactNo,AddressDtl.cEmailID,

--itemdtls
View_ITEMTRANSCATION_INV.nINVOICEQTY,case when View_InvoiceMaster.nTaxUniqueId='221' then (((View_ITEMTRANSCATION_INV.nTariffDuty1)))/2 else  case when (View_InvoiceMaster.nTaxUniqueId='222') then str(View_ITEMTRANSCATION_INV.nTariffDuty1)  end end GSTRt,

 --ewbdtls
  View_InvoiceMaster.cTransporterName,View_InvoiceMaster.cVehicleNo,View_InvoiceMaster.nTransporterCode,View_InvoiceMaster.cCustPONo OrdLineRef,08 POS

FROM         View_InvoiceMaster LEFT OUTER JOIN
                          (SELECT     ada.nACDetailID, am.nAccount_UniqueID, am.nAccountID, ada.nACMasterID_UniqueID, ada.cECCNo, ada.cLSTNo, ada.cCSTNo, ada.cTinNO, ada.cPanNo,ada.cGSTNo, 
                                                   ada.cSTaxNo, ada.cAddress, ada.cEmailID, ada.cContactNo
                            FROM          tbl_AccountMaster AS am LEFT OUTER JOIN
                                                   tbl_ACDetail_Address AS ada ON am.nAccount_UniqueID = ada.nACMasterID_UniqueID
                            WHERE      (ada.Is_Available = 1) AND (am.Is_Active = 1) AND (am.Is_Available = 1)) AS AccMaster ON 
                      View_InvoiceMaster.nCUSTUNIQUEID = AccMaster.nACMasterID_UniqueID AND View_InvoiceMaster.nCustBranchID = AccMaster.nACDetailID LEFT OUTER JOIN
    (select CityState.cCityName, CityState.cStateName,CityState.nStateID,CityState.nGSTStateCode, taa.* from tbl_AcDetail_Address taa 	left outer join(select cm.nCityID, cm.cCityName, sm.cStateName,sm.nStateID,sm.nGSTStateCode from tbl_CityMaster cm left outer join tbl_StateMaster sm  	on cm.nStateID=sm.nStateID where cm.is_active=1 and sm.is_active=1)CityState on taa.nCityID = CityState.nCityID  where taa.is_available=1)AddressDtl on View_InvoiceMaster.nCUSTUNIQUEID = AddressDtl.nACMasterID_UniqueID and View_InvoiceMaster.nCustBranchID = AddressDtl.nACDetailID
    left outer join
                      View_ITEMTRANSCATION_INV ON View_InvoiceMaster.nINVOICEUNIQUEID = View_ITEMTRANSCATION_INV.INVUNIQUEID AND 
                      View_ITEMTRANSCATION_INV.cTABLETYPE = 'INV' LEFT OUTER JOIN
                      tbl_CompanyMaster ON View_InvoiceMaster.nCompanyID = tbl_CompanyMaster.nCmpID 
                      
LEFT OUTER JOIN (SELECT nENTRYTAKENFROM_UNIQUEID AS nINVOICEUNIQUEID, ISNULL(SUM(nRECEIVEDAMOUNT), 0) AS nRECEIVEDAMOUNT FROM tbl_VOUCHER_PAYMENT_RECV AS vpr WHERE      (IS_ACTIVE = 1) AND (IS_AVAILABLE = 1) AND (cTAKINGFROMTABLE = 1) 
GROUP BY nENTRYTAKENFROM_UNIQUEID) AS vpr_1 ON vpr_1.nINVOICEUNIQUEID = View_InvoiceMaster.nINVOICEUNIQUEID                      
                      
WHERE     (View_InvoiceMaster.IS_ACTIVE = 1) AND (View_InvoiceMaster.IS_CANCELLED = 0) and View_InvoiceMaster.cINVOICENO  NOT LIKE '%9999' and View_InvoiceMaster.cINVOICENO='$invoiceNumber'";

    $result = sqlsrv_query($conn, $sql);
    $prettyjson = '';
    try {
        $count = 0;
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            $prettyjson = json_encode($row, JSON_PRETTY_PRINT);
            $json = $row;

            echo '<script type="text/javascript">',
            'setItemDetails();',
            '</script>';

            echo '<h3>Item Details</h3>
                <div class="grid"><label>SINo </label><input type="text" value=' . ++$count . '></div>
                <div class="grid"><label>IsServ</label><input type="text" value=' . $json['Is_Servicing'] . '></div>
                <div class="grid"><label>HSN Cd</label><input type="text" value=' . $json['cTARIFFHEAD'] . ' ></div>
                <div class="grid"><label>Unit Price</label><input type="text" value=' . $json['nRATE'] . ' ></div>
                <div class="grid"><label>TotalAmt</label><input type="text" value=' . $json['gross'] . ' ></div>
                <div class="grid"><label>AssAmt </label><input type="text" value=' . $json['Assamount'] . ' ></div>
                <div class="grid"><label>Gst Rt</label><input type="text" value=' . $json['gst'] . ' ></div>
                <div class="grid"><label>Total Item Val</label><input type="text" value=' . $json['TotItemVal'] . ' ></div>
                <div class="grid"><label>Ass Val</label><input type="text" value=' . $json['Assamount'] . ' ></div>
                <div class="grid"><label>TotInv VI</label><input type="text" value=' . $json['nNetAmount'] . ' ></div>
                <div class="grid"><label>InvStDt </label><input type="text" value=' . date("Y-m-d H:i:s") . ' ></div>
                <div class="grid"><label>InvEndDt</label><input type="text" value=' . date("Y-m-d H:i:s") . ' ></div>
                <div class="grid"><label>InvNo</label><input type="text" value=' . $json['cINVOICENO'] . ' ></div>
                <div class="grid"><label>InvDt</label><input type="text" value=' . $json['dINVOICEENTRYDATE']->format('Y-m-d H:i:s') . '></div>
                <div class="grid"><label>Distance</label><input type="text" value="0" ></div> ';
            //        echo '<script>setItemDetails($html)</script>';


//            echo '<pre>';
//            echo $prettyjson;
//            echo '</pre>';
        }
    } catch (Exception $e) {
        echo "Error Occurred!";
    }

    CloseMSSQLCon($conn);
    prepareJson($json);

}

function getService($hsncode)
{
    $firsttwocharacter = substr($hsncode, 0, 2);
    if ($firsttwocharacter == '99') {
        return 'Y';

    } else {
        return 'N';
    }
}

function prepareJson($json)
{
    $finalJson = $json;
    $finalObject = new stdClass();
    $finalObject->Version = "1.1";


    $finalObject->TranDtls = new stdClass();
    $finalObject->TranDtls->TaxSch = "GST";
    $finalObject->TranDtls->SupTyp = "B2B";
    $finalObject->TranDtls->RegRev = null;
    $finalObject->TranDtls->EcmGstin = "0";
    $finalObject->TranDtls->IgstOnIntra = null;

    $finalObject->DocDtls = new stdClass();
    $finalObject->DocDtls->Typ = "INV";
    $finalObject->DocDtls->No = $finalJson['cINVOICENO'];
    $date=date_format($finalJson['dINVOICEENTRYDATE'],'d/m/y');
    $finalObject->DocDtls->Dt =  $date ;

    $finalObject->SellerDtls = new stdClass();
    $finalObject->SellerDtls->Gstin = $finalJson['CompanyGSTNo'];
    $finalObject->SellerDtls->LglNm = $finalJson['cCompanyName'];
    $finalObject->SellerDtls->TrdNm = $finalJson['SellerTrdName'];
    $finalObject->SellerDtls->Addr1 = $finalJson['cAddress'];
    $finalObject->SellerDtls->Addr2 = $finalJson['cAddress'];
    $finalObject->SellerDtls->Loc = $finalJson['cCityName'];
    $finalObject->SellerDtls->Pin = $finalJson['pinno'];
    $finalObject->SellerDtls->StCd = $finalJson['nGSTStateCode'];
     $finalObject->SellerDtls->Ph=$finalJson['cPhoneNo'];
     $finalObject->SellerDtls->Em=$finalJson['cEmailAddress'];


    $finalObject->BuyerDtls = new stdClass();
    $finalObject->BuyerDtls->Gstin = $finalJson['cBillGSTNo'];
    $finalObject->BuyerDtls->LglNm = $finalJson['cBillToCustName'];
    $finalObject->BuyerDtls->TrdNm = $finalJson['cBillToCustName'];
    $finalObject->BuyerDtls->Pos=$finalJson['POS'];
    $finalObject->BuyerDtls->Addr1 = $finalJson['cBillAddress'];
    $finalObject->BuyerDtls->Addr2 = $finalJson['cBillAddress'];
    $finalObject->BuyerDtls->Loc=$finalJson['cBillToCityName'];
    $finalObject->BuyerDtls->Pin = $finalJson['nBillToZipCode'];
    $finalObject->BuyerDtls->StCd = $finalJson['nBilltoGSTStateCode'];
    $finalObject->BuyerDtls->Ph=$finalJson['cBillToContactNo'];
    $finalObject->BuyerDtls->Em=$finalJson['cBillToEmailID'];

    $finalObject->DispDtls = new stdClass();
    $finalObject->DispDtls->Nm = $finalJson['cCompanyName'];
    $finalObject->DispDtls->Addr1 = $finalJson['cDespAddress'];
    $finalObject->DispDtls->Addr2=$finalJson['cDespAddress'];
    $finalObject->DispDtls->Loc = $finalJson['cDespCustCityName'];
    $finalObject->DispDtls->Pin = $finalJson['nDespToZIpCode'];
    $finalObject->DispDtls->Stcd = $finalJson['nDesptoGSTStateCode'];

    $finalObject->ShipDtls = new stdClass();
    $finalObject->ShipDtls->Gstin = $finalJson['cBillGSTNo'];
    $finalObject->ShipDtls->LglNm = $finalJson['cBillToCustName'];
    $finalObject->ShipDtls->TrdNm=$finalJson['cBillToCustName'];
    $finalObject->ShipDtls->Addr1 = $finalJson['cBillAddress'];
    $finalObject->ShipDtls->Addr2=$finalJson['cBillAddress'];
    $finalObject->ShipDtls->Loc = $finalJson['cBillToCityName'];
    $finalObject->ShipDtls->Pin = $finalJson['nBillToZipCode'];
    $finalObject->ShipDtls->Stcd = $finalJson['nBilltoGSTStateCode'];

    $finalObject->ItemList = new stdClass();
    $finalObject->ItemList->BchDtls=new stdClass();
    $arr = array(
        array(
            "SlNo" =>"0",
            "PrdDesc" => $finalJson['cITEMNAME'],
            "IsServc" => $finalJson['Is_Servicing'],
            "HsnCd" => $finalJson['cTARIFFHEAD'],
            "Barcde" => null,
            "Qty" => $finalJson['nINVOICEQTY'],
            "FreeQty" => "0",
            "Unit" => $finalJson['cITEMUNIT'],
            "UnitPrice" => $finalJson['nRATE'],
            "TotAmt" => $finalJson['nAMOUNT'],
            "Discount" => $finalJson['nItemDISCOUNT'],
            "PreTaxVal" => $finalJson['gross'],
            "AssAmt" => $finalJson['Assamount'],
            "GstRt" => $finalJson['GSTRt'],
            "IgstAmt" => $finalJson['TRN_IGST'],
            "CgstAmt" => $finalJson['TRN_CGST'],
            "SgstAmt" =>$finalJson['TRN_SGST'],
            "CesRt" => $finalJson['nCESS'],
            "CesAmt" => "0",
            "CesNonAdvlAmt" => "0",
            "StateCesRt"=>"0",
            "StateCesAmt"=>"0",
            "StateCesNonAdvlAmt"=>"0",
            "OthChrg" => $finalJson['nTCSAmount'],
            "TotItemVal" =>  $finalJson['TotItemVal'],
            "OrdLineRef" =>  $finalJson['OrdLineRef'],
            "OrgCntry" =>  null,
            "PrdSlNo" =>  null,
            "BchDtls" => array(
                "Nm" => null,
                "ExpDt" => null ,
                "WrDt" => null ,
            ),
            "AttribDtls" =>
                array(
                    array(
                        "Nm" => $finalJson['cITEMNAME'],
                        "Val" => null
                    )
                )


        )

    );

    $finalObject->ItemList=$arr;


    $finalObject->ValDtls = new stdClass();
    $finalObject->ValDtls->AssVal = $finalJson[''];
    $finalObject->ValDtls->CgstVal = $finalJson['TRN_CGST'];
    $finalObject->ValDtls->SgstVal = $finalJson['TRN_SGST'];
    $finalObject->ValDtls->IgstVal = $finalJson['TRN_IGST'];
    $finalObject->ValDtls->CesVal = $finalJson['nCESS'];
    $finalObject->ValDtls->StCesVal = null;
    $finalObject->ValDtls->Discount = null;
    $finalObject->ValDtls->OthChrg =null;
    $finalObject->ValDtls->RndOffAmt =null;
    $finalObject->ValDtls->TotInvVal = null;
    $finalObject->ValDtls->TotInvValFc = null;


    $finalObject->PayDtls = new stdClass();
    $finalObject->PayDtls->Nm = null;
    $finalObject->PayDtls->AccDet = null;
    $finalObject->PayDtls->Mode = null;
    $finalObject->PayDtls->FinInsBr = null;
    $finalObject->PayDtls->PayTerm = null;
    $finalObject->PayDtls->PayInstr = null;
    $finalObject->PayDtls->CrTrn = null;
    $finalObject->PayDtls->DirDr = null;
    $finalObject->PayDtls->CrDay =null;
    $finalObject->PayDtls->PaidAmt = null;
    $finalObject->PayDtls->PaymtDue = null;

    $finalObject->RefDtls = new stdClass();
    $finalObject->RefDtls->InvRm = null;
    $arr= array(
        "InvStDt" => date('dd/md/yy'),
        "InvEndDt" => date('dd/mm/yy'),

    );
    $finalObject->RefDtls->DocPerdDtls=$arr;
    $arr = array(
        array(
            "InvNo" => $finalJson['cINVOICENO'],
            "InvDt" => $date,
            "OthRefNo" => null
        )
    );
    $finalObject->RefDtls->PrecDocDtls =$arr;



    $arr = array(
        array(
            "RecAdvRef" =>null,
            "RecAdvDt" => null,
            "TendRefr" => null,
            "ContrRefr" =>null,
            "ExtRefr" => null,
            "ProjRefr" => null,
            "PORefr" => null,
            "PORefDt" => null,
        )
    );
    $finalObject->RefDtls->ContrDtls = $arr;
    $arr= array(
        array(
        "Url" => null,
        "Docs" => null,
        "Info" => null,
        )
    );
    $finalObject->AddlDocDtls=$arr;
    $finalObject->ExpDtls=new stdClass();
    $finalObject->ExpDtls->ShipBNo = null;
    $finalObject->ExpDtls->ShipBDt =null;
    $finalObject->ExpDtls->Port = null;
    $finalObject->ExpDtls->RefClm = null;
    $finalObject->ExpDtls->ForCur =null;
    $finalObject->ExpDtls->CntCode =null;

    $finalObject->EwbDtls=new stdClass();
    $finalObject->EwbDtls->TransId = $finalJson['nTransporterCode'];
    $finalObject->EwbDtls->TransName = $finalJson['cTransporterName'];
    $finalObject->EwbDtls->Distance ="0";
    $finalObject->EwbDtls->TransDocNo = "0";
    $finalObject->EwbDtls->TransDocDt = null;
    $finalObject->EwbDtls->VehNo = $finalJson['cVehicleNo'];
    $finalObject->EwbDtls->VehType = "R";
    $finalObject->EwbDtls->TransMode = "1";

    echo '<pre>';
    echo json_encode($finalObject, JSON_PRETTY_PRINT);
    echo '</pre>';

}


?>
<body>
<h3>Document Details</h3>
<div class="grid"><label>Tax Sch</label><input type="text" value="GST"></div>
<div class="grid"><label>Sub Typ</label><input value="B2B" type="text"></div>
<div class="grid"><label>Typ</label><input VALUE="Inv" type="text"></div>
<div class="grid"><label>No</label><input value="<?php echo $json['cINVOICENO'] ?>" type="text"></div>
<div class="grid"><label>Dr</label><input type="text"
                                          value="<?php echo $json['dINVOICEENTRYDATE']->format('Y-m-d H:i:s') ?>"></div>

<h3>Seller Details</h3>
<div class="grid"><label>Gst In</label><input type="text" value="<?php echo $json['CompanyGSTNo'] ?>"></div>
<div class="grid"><label>LglNm</label><input type="text" value="<?php echo $json['cCompanyName'] ?>"></div>
<div class="grid"><label>Addr1</label><input type="text" value="<?php echo $json['cAddress'] ?>"></div>
<div class="grid"><label>Loc</label><input type="text" value="<?php echo $json['cCityName'] ?>"></div>
<div class="grid"><label>Pin</label><input type="text" value="<?php echo $json['pinno'] ?>"></div>
<div class="grid"><label>StCd</label><input type="text" value="<?php echo $json['nGSTStateCode'] ?>"></div>

<h3>Buyer Details</h3>
<div class="grid"><label>GSTIn</label><input type="text" value="<?php echo $json['cBillGSTNo'] ?>"></div>
<div class="grid"><label>LglNm</label><input type="text" value="<?php echo $json['cBillToCustName'] ?>"></div>
<div class="grid"><label>Pos</label><input type="text"></div>
<div class="grid"><label>Addr1</label><input type="text" value="<?php echo $json['cBillAddress'] ?>"></div>
<div class="grid"><label>Loc</label><input type="text" value="<?php echo $json['cBillToCustName'] ?>"></div>
<div class="grid"><label>Pin</label><input type="text" value="<?php echo $json['nBillToZipCode'] ?>"></div>
<div class="grid"><label>StCd</label><input type="text" value="<?php echo $json['nBilltoGSTStateCode'] ?>"></div>

<h3>Dispatch From Details</h3>
<div class="grid"><label>Nm</label><input type="text" value="<?php echo $json['cCompanyName'] ?>"></div>
<div class="grid"><label>Addr1</label><input type="text" value="<?php echo $json['cDespAddress'] ?>"></div>
<div class="grid"><label>Loc</label><input type="text" value="<?php echo $json['cDespCustCityName'] ?>"></div>
<div class="grid"><label>Pin</label><input type="text" value="<?php echo $json['nDespToZIpCode'] ?>"></div>
<div class="grid"><label>Stcd</label><input type="text" value="<?php echo $json['nDesptoGSTStateCode'] ?>"></div>

<h3>Ship To Details</h3>
<div class="grid"><label>LglNm</label><input type="text" value="<?php echo $json['cDespCustName'] ?>"></div>
<div class="grid"><label>Addr1</label><input type="text" value="<?php echo $json['cDespAddress'] ?>"></div>
<div class="grid"><label>Loc</label><input type="text"></div>
<div class="grid"><label>Pin</label><input type="text" value="<?php echo $json['cDespAddress'] ?>"></div>
<div class="grid"><label>Stcd</label><input type="text" value="<?php echo $json['cDespAddress'] ?>"></div>

<div id="itemDetails" name="itemDetails">

</div>

<input type="button" value="OK">
<input type="button" value="Cancel">

<h3>Mandatory Field for eInvoice Please Check before Submitting eInvoice</h3>
<div class="grid"><label>IRN No</label><input type="text"></div>
<div class="grid"><label>IRN Date</label><input type="text"></div>
<div class="grid"><label>Document</label><input type="text"></div>
<div class="grid"><label>Govt Response</label><input type="text"></div>
<div class="grid"><label>Ack. No</label><input type="text"></div>
<div class="grid"><label>Ack Date</label><input type="text"></div>
<div class="grid"><label>Signed Invoice</label><input type="text"></div>
<div class="grid"><label>Signed QR</label><input type="text"></div>
<div class="grid"><label>eWayBill No</label><input type="text"></div>
<div class="grid"><label>eWay BillDt</label><input type="text"></div>
<div class="grid"><label>Valid Dt</label><input type="text"></div>


</body>
<script>
    function setItemDetails(item) {
        var node = document.createElement("LI");                 // Create a <li> node
        var textnode = document.createTextNode("Water");         // Create a text node
        node.appendChild(textnode);                              // Append the text to <li>
        document.getElementById("itemDetails").appendChild(node);
    }

</script>
</html>


