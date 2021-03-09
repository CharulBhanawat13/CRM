{
"Version": "1.1",
"TaxSch": "GST",
"SupTyp": "B2B",
"Typ": "Inv",
"No"	"cINVOICENO": "2020011569009999",
"Date"	"dINVOICEENTRYDATE": {
"date": "2021-02-22 00:00:00.000000",
"timezone_type": 3,
"timezone": "Europe\/Berlin"
},
Sellers Detail
GstIn"	"CompanyGSTNo": "08AABCP2186Q1ZU",
"LglNm"	"cCompanyName": "Pyrotech Electronics Pvt Ltd Unit - I",
"Addr1"	"cAddress": "F-16A,Road No 3, Mewar Industrial Area Madri Udaipur,Rajasthan 313003 "
"Loc"	"cCity":"Udaipur"
"Pin"	"pinno": " 313003 ",
"StCd"	"nStateCode":"27"
"cPhoneNo": "0294-2492123-24  ",
"cEmailAddress": "info@peplelectronics.com",
Buyers Details
"GstIn"	"cBillGSTNo": "06AAGCR8400G1ZJ",
"LglNm"	"cBillToCustName": "MAS ROLLPRO TECHNOLOGIES PVT. LTD",
""StCd"	"nBilltoGSTStateCode": "06",
"Addr1"	"cBillAddress": "45TH KM STONE, \\n\\ DELHI ROHTAK ROAD,NATIONAL HIGHWAY NO. 10,V & PO ROHAD, \\n\\ BAHADURGARH,DIST-JHAJJAR-124501 \\n\\ HARYANA,INDIA",
"Pin"	"nBillToZipCode": 124501,
"cBillToContactNo": "08199966752;01276-278012\/14\/15", (No Special Char/No Space Only Numneric 6-12)
"cBillToEmailID": "masequip@masequip.co.in",
Despatch From Detail"
"Ship to Dispatch"
"GstIn"	"cDespGSTNo": "06AAGCR8400G1ZJ",
"Lglnm"	"cDespCustName": "MAS ROLLPRO TECHNOLOGIES PVT. LTD",
"Addr1"	"cDespAddress": "45TH KM STONE, \\n\\ DELHI ROHTAK ROAD,NATIONAL HIGHWAY NO. 10,V & PO ROHAD, \\n\\ BAHADURGARH,DIST-JHAJJAR-124501 \\n\\ HARYANA,INDIA",
"Pin"	"nDespToZIpCode": 124501,
"StCd"	"nDesptoGSTStateCode": "06",
"cDespContactNo": "08199966752;01276-278012\/14\/15",
"cDespEmailID": "masequip@masequip.co.in",
"Item Detil"
"SlNo"	"cItemSrNo": "",
"InServ"	"Service":"N"
"cITEMNAME": "TEMPERATURE TRANSMITTER",
"HSNCd"	"cTARIFFHEAD": "9032.20.90 :: 18.00% - 0.00 % - 0.00%", )only 10 Digit Numeric)
"	"nINVOICEQTY": "3.00",
"cITEMUNIT": "NO",
"UnitPrice"	"nRATE": "6175.000",
"TotalAmt"	"gross": "18525.00000",
"		nItemDISCOUNT": ".000",
"AssAmt"	"Assamount": "23340.400",
"GstRt"	"gst": "18.00     ",
"TRN_IGST": "3560.400",
"TRN_CGST": ".000",
"TRN_SGST": ".000",
"TotalItemVaal"	"TotItemVal": "3560.400",
"TInvVal"	"nNetAmount": "88918.900",
"InvStDt"	"InvDt"	"dINVOICEENTRYDATE": {
"date": "2021-02-22 00:00:00.000000",
"timezone_type": 3,
"timezone": "Europe\/Berlin"
},
"InvEndDt"	"InvDt"	"dINVOICEENTRYDATE": {
"date": "2021-02-22 00:00:00.000000",
"timezone_type": 3,
"timezone": "Europe\/Berlin"
},
"timezone": "Europe\/Berlin"
},

"InvNo"	"cINVOICENO": "2020011569009999",
"InvDt"	"dINVOICEENTRYDATE": {
"date": "2021-02-22 00:00:00.000000",
"timezone_type": 3,

"nCESS": ".000",
"nAMOUNT": "18525.000",
"TotalAmt_After_Tax": "88918.900",
"cCustPONo": "MRPTPL\/RP19073,18105\/2020-21\/0360",
"cCustPODate": {
"date": "2020-10-15 00:00:00.000000",
"timezone_type": 3,
"timezone": "Europe\/Berlin"
},
"cTransporterName": "-RIVIGO SERVICES",
"cVehicleNo": ""
}
{   "For 2 to 10 same as 1)

"cItemSrNo": "",
"cITEMNAME": "TEMPERATURE TRANSMITTER ",
"cTARIFFHEAD": "9032.20.90 :: 18.00% - 0.00 % - 0.00%",
"nINVOICEQTY": "9.00",
"cITEMUNIT": "NO",
"nRATE": "6175.000",
"gross": "55575.00000",
"nItemDISCOUNT": ".000",
"Assamount": "65578.500",
"gst": "18.00     ",
"TRN_IGST": "10003.500",
"TRN_CGST": ".000",
"TRN_SGST": ".000",
"TotItemVal": "10003.500",
"nNetAmount": "88918.900",
}

---------------------------------------------------------------------

SELECT distinct
--trandtls
'GST','B2B','','','',

--docdtls
'INV',View_InvoiceMaster.cINVOICENO, View_InvoiceMaster.dINVOICEENTRYDATE,

--sellerdtls

tbl_CompanyMaster.nGSTno as CompanyGSTNo,tbl_CompanyMaster.cCompanyName,'', tbl_CompanyMaster.cAddress,'','',right(tbl_CompanyMaster.cAddress,8) pinno,'',tbl_CompanyMaster.cPhoneNo,tbl_CompanyMaster.cEmailAddress, AddressDtl.cCityName,AddressDtl.nStateID,AddressDtl.nGSTStateCode,


--buyerdtls
View_InvoiceMaster.cBillGSTNo, View_InvoiceMaster.cBillToCustName,'',View_InvoiceMaster.nBilltoGSTStateCode,View_InvoiceMaster.cBillAddress,'','',View_InvoiceMaster.nBillToZipCode,View_InvoiceMaster.nBilltoGSTStateCode,cBillToContactNo,cBillToEmailID,

--dispatchfromdtls
tbl_CompanyMaster.cCompanyName,tbl_CompanyMaster.cAddress,'','',right(tbl_CompanyMaster.cAddress,8) pinno,'',

--shiptodetails
View_InvoiceMaster.cDespGSTNo,View_InvoiceMaster.cDespCustName,'', View_InvoiceMaster.cDespAddress,'','',View_InvoiceMaster.nDespToZIpCode,View_InvoiceMaster.nDesptoGSTStateCode,View_InvoiceMaster.cDespContactNo,View_InvoiceMaster.cDespEmailID,

--itemdetails
View_ITEMTRANSCATION_INV.cItemSrNo,View_ITEMTRANSCATION_INV.nITEMUNIQUEID ,View_ITEMTRANSCATION_INV.cITEMNAME,'Y', View_ITEMTRANSCATION_INV.cTARIFFHEAD,'',View_ITEMTRANSCATION_INV.nINVOICEQTY,'' ,View_ITEMTRANSCATION_INV.cITEMUNIT,View_ITEMTRANSCATION_INV.nRATE,(View_ITEMTRANSCATION_INV.nINVOICEQTY*View_ITEMTRANSCATION_INV.nRATE) gross,View_ITEMTRANSCATION_INV.nDISCOUNT AS nItemDISCOUNT,'',(View_ITEMTRANSCATION_INV.nAMOUNT+View_ITEMTRANSCATION_INV.nAEDED+View_ITEMTRANSCATION_INV.nFREIGHT+ View_ITEMTRANSCATION_INV.nINSURANCE+View_ITEMTRANSCATION_INV.nPNFCHARGE) Assamount,(View_ITEMTRANSCATION_INV.nTariffDuty1) gst,View_ITEMTRANSCATION_INV.nIGST AS TRN_IGST,View_ITEMTRANSCATION_INV.nCGST AS TRN_CGST, View_ITEMTRANSCATION_INV.nSGST AS TRN_SGST,'','','','','','','',(View_ITEMTRANSCATION_INV.nIGST+View_ITEMTRANSCATION_INV.nCGST+View_ITEMTRANSCATION_INV.nSGST) TotItemVal,'','','','','',


--batchdetails

'','','',

--attributedetails

'','',

--valuedetails
(View_ITEMTRANSCATION_INV.nAMOUNT+View_ITEMTRANSCATION_INV.nAEDED+View_ITEMTRANSCATION_INV.nFREIGHT+ View_ITEMTRANSCATION_INV.nINSURANCE+View_ITEMTRANSCATION_INV.nPNFCHARGE) Assamount,'','','','','','','','',View_InvoiceMaster.nNetAmount,



--valdtls
(View_ITEMTRANSCATION_INV.nINVOICEQTY*View_ITEMTRANSCATION_INV.nRATE) gross,View_ITEMTRANSCATION_INV.nIGST AS TRN_IGST,View_ITEMTRANSCATION_INV.nCGST AS TRN_CGST, View_ITEMTRANSCATION_INV.nSGST AS TRN_SGST,View_InvoiceMaster.nCESS, View_ITEMTRANSCATION_INV.nDISCOUNT AS nItemDISCOUNT,View_ITEMTRANSCATION_INV.nAMOUNT,View_InvoiceMaster.nNetAmount AS TotalAmt_After_Tax,


--paymentdetails

'','','','','','','','','','','',

--referencedetails

'','','','',

--documentperioddetails

View_InvoiceMaster.dINVOICEENTRYDATE,View_InvoiceMaster.dINVOICEENTRYDATE,

--precedingdocumentdetails

View_InvoiceMaster.cINVOICENO,View_InvoiceMaster.dINVOICEENTRYDATE,'',

--contractdetails

'','','','','','', View_InvoiceMaster.cCustPONo,View_InvoiceMaster.cCustPODate ,


--additionaldocumentdetails

'','','',

--exportdetails
'','','','','','','',


--ewbdtls
'',View_InvoiceMaster.cTransporterName,'','','','',View_InvoiceMaster.cVehicleNo,''


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

WHERE     (View_InvoiceMaster.IS_ACTIVE = 1) AND (View_InvoiceMaster.IS_CANCELLED = 0) and View_InvoiceMaster.cINVOICENO  NOT LIKE '%9999' and View_InvoiceMaster.cINVOICENO='2010011560000018'

