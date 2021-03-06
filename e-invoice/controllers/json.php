
{
"Version": "1.1",
"TranDtls": {
    "TaxSch": "GST",
    "SupTyp": "B2B",
    "RegRev": "Y",
    "EcmGstin": null,
    "IgstOnIntra": "N"
},
"DocDtls": {
    "Typ": "INV",
    "No": "DOC/007",
    "Dt": "08/08/2020"
},
"SellerDtls": {
    "Gstin": "24AAFCD5862R005",
    "LglNm": "NIC company pvt ltd",
    "TrdNm": "NIC Industries",
    "Addr1": "5th block, kuvempu layout",
    "Addr2": "kuvempu layout",
    "Loc": "GANDHINAGAR",
    "Pin": 382010,
    "Stcd": "24",
    "Ph": "9000000000",
    "Em": "abc@gmail.com"
},
"BuyerDtls": {
    "Gstin": "29AWGPV7107B1Z1",
    "LglNm": "XYZ company pvt ltd",
    "TrdNm": "XYZ Industries",
    "Pos": "12",
    "Addr1": "7th block, kuvempu layout",
    "Addr2": "kuvempu layout",
    "Loc": "GANDHINAGAR",
    "Pin": 562160,
    "Stcd": "29",
    "Ph": "91111111111",
    "Em": "xyz@yahoo.com"
},
"DispDtls": {
    "Nm": "ABC company pvt ltd",
    "Addr1": "7th block, kuvempu layout",
    "Addr2": "kuvempu layout",
    "Loc": "Banagalore",
    "Pin": 562160,
    "Stcd": "29"
},
"ShipDtls": {
    "Gstin": "29AWGPV7107B1Z1",
    "LglNm": "CBE company pvt ltd",
    "TrdNm": "kuvempu layout",
    "Addr1": "7th block, kuvempu layout",
    "Addr2": "kuvempu layout",
    "Loc": "Banagalore",
    "Pin": 562160,
    "Stcd": "29"
},
"ItemList":
[
    {
        "SlNo": "1",
        "PrdDesc": "Rice",
        "IsServc": "N",
        "HsnCd": "1001",
        "Barcde": "123456",
        "Qty": 100.345,
        "FreeQty": 10,
        "Unit": "BAG",
        "UnitPrice": 99.545,
        "TotAmt": 9988.84,
        "Discount": 10,
        "PreTaxVal": 1,
        "AssAmt": 9978.84,
        "GstRt": 12.0,
        "IgstAmt": 1197.46,
        "CgstAmt": 0,
        "SgstAmt": 0,
        "CesRt": 5,
        "CesAmt": 498.94,
        "CesNonAdvlAmt": 10,              0
        "StateCesRt": 12,---------------------0
        "StateCesAmt": 1197.46,---------------0
        "StateCesNonAdvlAmt": 5,--------------0
        "OthChrg": 10,
        "TotItemVal": 12897.7,
        "OrdLineRef": "3256",
        "OrgCntry": "AG",
        "PrdSlNo": "12345",
        "BchDtls": {
            "Nm": "123456",
            "ExpDt": "01/08/2020",
            "WrDt": "01/09/2020"
        },
        "AttribDtls": [
            {
            "Nm": "Rice",
            "Val": "10000"
            }
        ]
    }
],
"ValDtls": {
    "AssVal": 9978.84,
    "CgstVal": 0,
    "SgstVal": 0,
    "IgstVal": 1197.46,
    "CesVal": 508.94,
    "StCesVal": 1202.46,
    "Discount": 10,
    "OthChrg": 20,
    "RndOffAmt": 0.3,
    "TotInvVal": 12908,
    "TotInvValFc": 12897.7
},
"PayDtls": {
    "Nm": "ABCDE",
    "AccDet": "5697389713210",
    "Mode": "Cash",
    "FinInsBr": "SBIN11000",
    "PayTerm": "100",
    "PayInstr": "Gift",
    "CrTrn": "test",
    "DirDr": "test",
    "CrDay": 100,
    "PaidAmt": 10000,
    "PaymtDue": 5000
},
"RefDtls": {
    "InvRm": "TEST",
    "DocPerdDtls": {
    "InvStDt": "01/08/2020",
    "InvEndDt": "01/09/2020"
},
"PrecDocDtls": [----------//null//purchase order no,podt
{
    "InvNo": "DOC/002",
    "InvDt": "01/08/2020",
    "OthRefNo": "123456"
}
],
"ContrDtls": [----null
{
    "RecAdvRef": "Doc/003",
    "RecAdvDt": "01/08/2020",
    "TendRefr": "Abc001",
    "ContrRefr": "Co123",
    "ExtRefr": "Yo456",
    "ProjRefr": "Doc-456",
    "PORefr": "Doc-789",
    "PORefDt": "01/08/2020"
}
]
},
"AddlDocDtls": [----------null
{
"Url": "https://einv-apisandbox.nic.in",
"Docs": "Test Doc",
"Info": "Document Test"
}
],
"ExpDtls": { ---------------null
"ShipBNo": "A-248",
"ShipBDt": "01/08/2020",
"Port": "INABG1",
"RefClm": "N",
"ForCur": "AED",
"CntCode": "AE"
},
"EwbDtls": { -----------
"TransId": "12AWGPV7107B1Z1",
"TransName": "XYZ EXPORTS",
"Distance": 100,
"TransDocNo": "DOC01",
"TransDocDt": "08/08/2020",
"VehNo": "ka123456",
"VehType": "R",
"TransMode": "1"
}
}


/// .............................. 16/03/2021............................//////////


SELECT distinct  'GST','B2B','INV',View_InvoiceMaster.cINVOICENO, View_InvoiceMaster.dINVOICEENTRYDATE,View_InvoiceMaster.nTCSAmount,View_InvoiceMaster.nTCSRate,

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

View_InvoiceMaster.cCustPONo,View_InvoiceMaster.cCustPODate ,


--ewbdtls
View_InvoiceMaster.cTransporterName,View_InvoiceMaster.cVehicleNo,

--sellerdtls
case when View_InvoiceMaster.nCompanyDivisionID=4 then 'lighting@peplelectronics.com' else case when View_InvoiceMaster.nCompanyDivisionID=5 then 'leddriver@peplelectronics.com' else 'pyrotech@peplelectronics.com' end end Emailid,tbl_CompanyMaster.cCompanyName SellerTrdName,tbl_CompanyMaster.cPhoneNo,tbl_CompanyMaster.cAddress,

--buyerdtls

View_InvoiceMaster.cBillToCustName BusyerTradeName,View_InvoiceMaster.cBillAddress,View_InvoiceMaster.cBillToCityName,AddressDtl.cContactNo,AddressDtl.cEmailID,

--itemdtls
View_ITEMTRANSCATION_INV.nINVOICEQTY,case when View_InvoiceMaster.nTaxUniqueId='221' then (((View_ITEMTRANSCATION_INV.nTariffDuty1)))/2 else  case when (View_InvoiceMaster.nTaxUniqueId='222') then str(View_ITEMTRANSCATION_INV.nTariffDuty1)  end end GSTRt,

--ewbdtls
View_InvoiceMaster.cTransporterName,View_InvoiceMaster.cVehicleNo,View_InvoiceMaster.nTransporterCode

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

WHERE     (View_InvoiceMaster.IS_ACTIVE = 1) AND (View_InvoiceMaster.IS_CANCELLED = 0) and View_InvoiceMaster.cINVOICENO  NOT LIKE '%9999' and View_InvoiceMaster.cINVOICENO='2020010568000117'

2020010568000117