'Option Strict Off
'Option Explicit On
Option Infer On
Imports VB = Microsoft.VisualBasic
Imports System
Imports System.Collections.Generic
Imports System.Web
Imports System.Web.UI
Imports System.Web.UI.WebControls
Imports System.Net
Imports System.Text
Imports QRCoder
Imports System.IO
Imports System.Drawing
Imports System.Drawing.Imaging
Imports QRCoder.QRCodeGenerator
Imports System.Configuration
Imports System.Data
Imports System.Data.SqlClient
Imports System.Net.WebClient.DownloadFile
Imports CrystalDecisions.CrystalReports.Engine

Public Class frmSaGatePass
Inherits System.Windows.Forms.Form
Public mblnEditFlag, mblnAddNewflag, mbInViewFlag As Boolean
Dim mblnFirstView As Boolean
Dim rsGatePassHdr As New ADODB.Recordset
Dim rsGatePassDtl As New ADODB.Recordset
Dim rsGatePass_TEMP_DETAILS As New ADODB.Recordset
Dim rsChallan As New ADODB.Recordset
Dim rsTmp As New ADODB.Recordset
Dim rs As New ADODB.Recordset
Dim rsTemp As New ADODB.Recordset
Dim strsql, StrCombo, gstrProdList, gstrPartCode As String
Dim strPreFix, strGatePassType As String
Dim i As Short
Dim mCnf As Boolean = False
Dim mGatePassNo As String
Dim mGatePassYear As String
Dim fc As New FillCombo
Dim fgc As New fillGridCombo
Dim mStrMon(12) As String
Dim mEwayBillRequired As String
Dim mOhno As String, mOhYear As Integer
Dim mFCL As Integer = 0
Dim request As HttpWebRequest
Dim response As HttpWebResponse = Nothing
Dim reader As StreamReader
Dim address As Uri
Dim appId As String
Dim context As String
Dim query As String
Dim data As StringBuilder
Dim byteData() As Byte
Dim postStream As Stream = Nothing

Private Property plBarCode As Object
'Dim myHttpUtility As HttpUtility

Private Sub ClearControls1()
TextBox1.Text = ""
TextBox2.Text = ""
TextBox3.Text = ""
TextBox4.Text = ""
TextBox5.Text = ""
TextBox6.Text = ""
TextBox7.Text = ""
TextBox8.Text = ""
TextBox9.Text = ""
TextBox10.Text = ""
TextBox11.Text = ""
TextBox12.Text = ""
TextBox13.Text = ""
TextBox14.Text = ""
TextBox15.Text = ""
TextBox16.Text = ""
TextBox18.Text = ""
TextBox19.Text = ""
TextBox20.Text = ""
TextBox21.Text = ""
TextBox22.Text = ""
TextBox24.Text = ""
TextBox25.Text = ""
TextBox26.Text = ""
TextBox28.Text = ""
TextBox30.Text = ""
TextBox31.Text = ""
TextBox32.Text = ""
TextBox33.Text = ""
TextBox34.Text = ""
TextBox36.Text = ""
TextBox37.Text = ""
TextBox38.Text = ""
TextBox39.Text = ""
TextBox40.Text = ""
TextBox42.Text = ""
TextBox43.Text = ""
TextBox44.Text = ""
TextBox45.Text = ""
TextBox46.Text = ""
TextBox48.Text = ""
TextBox49.Text = ""
TextBox50.Text = ""
TextBox51.Text = ""
TextBox52.Text = ""
TextBox54.Text = ""
TextBox55.Text = ""
TextBox56.Text = ""
TextBox57.Text = ""
TextBox58.Text = ""
TextBox59.Text = ""
TextBox60.Text = ""
TextBox61.Text = ""
TextBox62.Text = ""
End Sub


Private Sub btn_irngenerate_Click(sender As System.Object, e As System.EventArgs) Handles btn_irngenerate.Click
Call irngenerate()
End Sub
Private Sub btn_qrcode_Click(sender As Object, e As EventArgs) Handles btn_qrcode.Click
Dim code As String = TextBox8.Text
Call GenerateQrCode(code)
End Sub
Private Function GenerateQrCode(ByVal qrmsg As String) As Byte()
cmdSave.Enabled = True
Dim code As String = qrmsg
'fn: virtually unique file name based on date and time
Dim fn As String = "\\10.0.0.1\wdpl\qrcode\" + txtChalNo.Text + ".png "

Try
Dim client As WebClient = New WebClient
'Dim client As New System.Net.WebClient
client.DownloadFile("http://chart.apis.google.com/chart?cht=qr&chs=500x500&chl=" & code, fn)
client = Nothing
GroupBox1.Visible = False
Catch ex As Net.WebException
If ex.Response IsNot Nothing Then
response = ex.Response
End If
End Try
End Function
Public Function MapPath(sPath As String)
Dim Server = "\\10.0.0.1\wdpl\qrcode\"
Return HttpContext.Current.Server.MapPath(sPath)
End Function

Private Sub btn_eway_Click(sender As Object, e As EventArgs) Handles btn_eway.Click
Dim myjson As String
request = CType(WebRequest.Create("https://api-einv.cleartax.in/v2/eInvoice/ewaybill/print"), HttpWebRequest)
request.Headers.Add("X-Cleartax-Auth-Token", "1.3cfe12cf-e80b-4b62-a306-30f144d6f19e_638122dbce7f7e7500a5640f2dca412fc3ecf7f1f207b0aa79d6d4ff68488e15")
request.Headers.Add("x-cleartax-product", "EInvoice")
request.Headers.Add("ContentType", "application/json")
request.Headers.Add("owner_id", "0b7b1937-6481-4dcd-8344-6dbb52bbaaa4")
request.Headers.Add("gstin", "08AAACW2424P1Z1")
myjson = "SELECT JSON_ARRAY(JSON_OBJECT('ewb_numbers' value '" & txtEwayBill.Text & "','print_type' value 'DETAILED')) from dual"
postdata = myjson
request.Method = "PUT"
CookieContainercookie = request.CookieContainer
request.ContentType = "application/json"
request.ContentLength = postdata.Length
Dim requestWriter As StreamWriter = New StreamWriter(request.GetRequestStream())
requestWriter.Write(postdata)
requestWriter.Close()
response = DirectCast(request.GetResponse(), HttpWebResponse)
reader = New StreamReader(response.GetResponseStream())
rawresponse = reader.ReadToEnd()

'request.Method = "POST"
Dim filename As String = "\\10.0.0.1\wdpl\qrcode\" + txtEwayBill.Text + ".pdf "
Dim local As Stream = File.Create("\\10.0.0.1\wdpl\qrcode\" + txtEwayBill.Text + ".pdf ")
'Dim httpWebRequest = DirectCast(WebRequest.Create("https://api-einv.cleartax.in/v2/eInvoice/ewaybill/print"), HttpWebRequest)
'Dim httpWebResponse = DirectCast(request.GetResponse(), HttpWebResponse)
'If (httpWebResponse.StatusCode <> HttpStatusCode.OK AndAlso httpWebResponse.StatusCode <> HttpStatusCode.Moved AndAlso httpWebResponse.StatusCode <> HttpStatusCode.Redirect) OrElse Not httpWebResponse.ContentType.StartsWith("image", StringComparison.OrdinalIgnoreCase) Then
'Return
'End If
Using stream = request.GetRequestStream()
Using fileStream = File.OpenWrite(filename)
Dim bytes = New Byte(4095) {}
Dim read = 0
Do
If stream Is Nothing Then
Continue Do
End If
read = stream.Read(bytes, 0, bytes.Length)
fileStream.Write(bytes, 0, read)
Loop While read <> 0
End Using
End Using
End Sub

Private Sub Button1_Click(sender As Object, e As EventArgs) Handles Button1.Click
GroupBox1.Visible = False
btn_qrcode.Visible = False
mCnf = False
Call ClearControls1()
End Sub

Private Sub Button2_Click(sender As Object, e As EventArgs) Handles Button2.Click
If TextBox12.Text.ToString() <> "" And TextBox13.Text.ToString() <> "" And TextBox14.Text.ToString() <> "" And TextBox15.Text.ToString() <> "" And TextBox16.Text.ToString() <> "" And TextBox18.Text.ToString() <> "" And TextBox19.Text.ToString() <> "" And TextBox20.Text.ToString() <> "" And TextBox21.Text.ToString() <> "" And TextBox22.Text.ToString() <> "" And TextBox24.Text.ToString() <> "" And TextBox25.Text.ToString() <> "" And TextBox26.Text.ToString() <> "" And TextBox28.Text.ToString() <> "" And TextBox30.Text.ToString() <> "" And TextBox31.Text.ToString() <> "" And TextBox32.Text.ToString() <> "" And TextBox33.Text.ToString() <> "" And TextBox34.Text.ToString() <> "" And TextBox36.Text.ToString() <> "" And TextBox37.Text.ToString() <> "" And TextBox38.Text.ToString() <> "" And TextBox39.Text.ToString() <> "" And TextBox40.Text.ToString() <> "" And TextBox42.Text.ToString() <> "" And TextBox43.Text.ToString() <> "" And TextBox44.Text.ToString() <> "" And TextBox45.Text.ToString() <> "" And TextBox46.Text.ToString() <> "" And TextBox48.Text.ToString() <> "" And TextBox49.Text.ToString() <> "" And TextBox50.Text.ToString() <> "" And TextBox51.Text.ToString() <> "" And TextBox52.Text.ToString() <> "" And TextBox54.Text.ToString() <> "" And TextBox55.Text.ToString() <> "" And TextBox56.Text.ToString() <> "" And TextBox57.Text.ToString() <> "" And TextBox58.Text.ToString() <> "" And TextBox59.Text.ToString() <> "" And TextBox60.Text.ToString() <> "" And TextBox61.Text.ToString() <> "" And TextBox62.Text.ToString() <> "" Then
mCnf = True
Else
mCnf = False
MsgBox("Please Check Field Missing something")
End If
Call irngenerate()
End Sub

Private Sub irngenerate()
'Dim request As HttpWebRequest
'Dim response As HttpWebResponse
'Dim reader As StreamReader
'Dim rawresponse As String+-
GroupBox1.Visible = True
btn_qrcode.Visible = True
Call ClearControls1()
Dim rsPrimary As New ADODB.Recordset
Dim rsPrimary1 As New ADODB.Recordset
Dim rsTmp As New ADODB.Recordset
Dim rsTmp1 As New ADODB.Recordset
Dim rsTmp2 As New ADODB.Recordset
Dim rsTmp3 As New ADODB.Recordset
Dim rsTmp4 As New ADODB.Recordset
Dim rsTmp5 As New ADODB.Recordset
Dim strsql, strsql1 As String
Dim mDoc, mVehNo, mTransMode, mVehType, mInvNo, mExpRefNo, mPoRefNo, mPoRefDate, mBusiness, mInv, mRev, mService, mGSTIn, mPos, mPinCode, mShipGstIn, mShipName, mShipAdd1, mShipAdd2, mShipCity, mShipPinCode, mShipStateCode, mBuyerCity As String
Dim mnos As Integer
Try
rsTmp = gConn.Execute("SELECT * FROM company_master CM Where Cm.CM_CODE=" & gintCompCode & "")
If Mid(txtChalNo.Text, 1, 2) = "PR" Then
rsTmp1 = gConn.Execute("SELECT * FROM challan_hdr CH left outer join customer_supplier cs ON CS.AM_CODE=CH.AM_CODE_CUST AND CS.CM_CODE=" & gintCompCode & " Where CH.CM_CODE=" & gintCompCode & " And CH.oh_no='" & txtChalNo.Text & "' And CH.ch_year = " & gintCurrYearStart & "")
rsTmp2 = gConn.Execute("SELECT * FROM customer_supplier cs1 WHERE CS1.AM_CODE= " & rsTmp1.Fields("AM_CODE_CON").Value & " AND CS1.CM_CODE=" & gintCompCode & "")
rsTmp4 = gConn.Execute("SELECT * FROM stock STK Where STK.CM_CODE=" & gintCompCode & " and STK.STK_YEAR=" & gintCurrYearStart & " AND STK.STK_TRANSNO='" & rsTmp1.Fields("OH_NO").Value & "'")
rsTmp5 = gConn.Execute("SELECT * FROM ORDER_HDR OH Where OH.CM_CODE=" & gintCompCode & " and OH.OH_YEAR=" & gintCurrYearStart & " AND OH.OH_NO='" & rsTmp1.Fields("OH_NO").Value & "'")
Else
rsTmp1 = gConn.Execute("SELECT * FROM challan_hdr CH left outer join customer_supplier cs ON CS.AM_CODE=CH.AM_CODE_CUST AND CS.CM_CODE=" & gintCompCode & " Where CH.CM_CODE=" & gintCompCode & " And CH.ch_no='" & txtChalNo.Text & "' And CH.ch_year = " & gintCurrYearStart & "")
rsTmp2 = gConn.Execute("SELECT * FROM customer_supplier cs1 WHERE CS1.AM_CODE= " & rsTmp1.Fields("AM_CODE_CON").Value & " AND CS1.CM_CODE=" & gintCompCode & "")
rsTmp3 = gConn.Execute("SELECT * FROM INVOICE_EXPORT_HDR IEH WHERE IEH.IH_NO= '" & rsTmp1.Fields("IH_NO").Value & "' AND IEH.CM_CODE=" & gintCompCode & " And IEH.IH_YEAR = " & gintCurrYearStart & "")
rsTmp4 = gConn.Execute("SELECT * FROM stock STK Where STK.CM_CODE=" & gintCompCode & " and STK.STK_YEAR=" & gintCurrYearStart & " AND STK.STK_TRANSNO='" & rsTmp1.Fields("CH_NO").Value & "'")
rsTmp5 = gConn.Execute("SELECT * FROM ORDER_HDR OH Where OH.CM_CODE=" & gintCompCode & " and OH.OH_YEAR=" & gintCurrYearStart & " AND OH.OH_NO='" & rsTmp1.Fields("OH_NO").Value & "'")
End If
If rsTmp1.RecordCount > 0 Then
'If IsDBNull(rsTmp1.Fields("BUYER_GST_NO").Value) = "" Then
'mBusiness = "B2C"

mTransMode = "1"

mVehType = "R"
mDoc = rsTmp1.Fields("ch_lrno").Value & ""
mVehNo = rsTmp1.Fields("ch_vehicleno").Value & ""
If (Mid(rsTmp1.Fields("CH_NO").Value, 1, 2) = "L0" Or (Mid(rsTmp1.Fields("CH_NO").Value, 1, 2) = "DG") And (rsTmp1.Fields("IGSTAMT").Value + rsTmp1.Fields("CGSTAMT").Value + rsTmp1.Fields("SGSTAMT").Value) > 0) Then
mBusiness = "B2B"
mBuyerCity = "UDAIPUR"
mInvNo = "WDL/" + rsTmp1.Fields("CH_NO").Value + "/20-21"
mPos = rsTmp1.Fields("state_code").Value
mGSTIn = rsTmp1.Fields("cs_gst_no").Value
mPinCode = rsTmp1.Fields("cs_pin_code").Value
If rsTmp5.RecordCount > 0 Then
If Mid(rsTmp5.Fields("oh_no").Value, 1, 2) = "SP" Then
mShipGstIn = ""
mShipName = rsTmp5.Fields("ship_to").Value
mShipAdd1 = rsTmp5.Fields("ship_to_add").Value
mShipAdd2 = ""
mShipCity = "MUMBAI"
mShipPinCode = "400702"
mShipStateCode = "27"
Else
mShipGstIn = rsTmp2.Fields("cs_gst_no").Value & ""
mShipName = rsTmp2.Fields("cs_name").Value
mShipAdd1 = rsTmp2.Fields("cs_add1").Value
mShipAdd2 = rsTmp2.Fields("cs_add2").Value
mShipCity = rsTmp2.Fields("cs_city").Value
mShipPinCode = rsTmp2.Fields("cs_pin_code").Value
mShipStateCode = rsTmp2.Fields("state_code").Value
End If
Else
mShipGstIn = rsTmp2.Fields("cs_gst_no").Value & ""
mShipName = rsTmp2.Fields("cs_name").Value
mShipAdd1 = rsTmp2.Fields("cs_add1").Value
mShipAdd2 = rsTmp2.Fields("cs_add2").Value
mShipCity = rsTmp2.Fields("cs_city").Value
mShipPinCode = rsTmp2.Fields("cs_pin_code").Value
mShipStateCode = rsTmp2.Fields("state_code").Value
'End If
mExpRefNo = ""
End If
ElseIf (Mid(rsTmp1.Fields("CH_NO").Value, 1, 3) = "CNG" Or Mid(rsTmp1.Fields("CH_NO").Value, 1, 3) = "CNG") And (rsTmp1.Fields("IGSTAMT").Value + rsTmp1.Fields("CGSTAMT").Value + rsTmp1.Fields("SGSTAMT").Value) > 0 Then
mBusiness = "B2B"
mBuyerCity = "UDAIPUR"
mInvNo = rsTmp1.Fields("CH_NO").Value
mPos = rsTmp1.Fields("state_code").Value
mGSTIn = rsTmp1.Fields("cs_gst_no").Value
mPinCode = rsTmp1.Fields("cs_pin_code").Value
mShipGstIn = rsTmp1.Fields("cs_gst_no").Value
mShipName = rsTmp1.Fields("cs_name").Value
mShipAdd1 = rsTmp1.Fields("cs_add1").Value
mShipAdd2 = rsTmp1.Fields("cs_add2").Value
mShipCity = rsTmp1.Fields("cs_city").Value
mShipPinCode = rsTmp1.Fields("cs_pin_code").Value
mShipStateCode = rsTmp1.Fields("state_code").Value
mExpRefNo = ""
ElseIf Mid(rsTmp1.Fields("CH_NO").Value, 1, 2) = "OS" And (rsTmp1.Fields("IGSTAMT").Value + rsTmp1.Fields("CGSTAMT").Value + rsTmp1.Fields("SGSTAMT").Value) = 0 Then
mTransMode = ""
mVehType = ""
mDoc = ""
mVehNo = ""
mBusiness = "B2B"
mBuyerCity = rsTmp.Fields("CM_CITY").Value + "INDIA"
mInvNo = "WDL/" + rsTmp1.Fields("CH_NO").Value + "/20-21"
mPos = rsTmp1.Fields("state_code").Value
If rsTmp1.Fields("cs_gst_no").Value = "" Then
mGSTIn = "NRP"
Else
mGSTIn = rsTmp1.Fields("cs_gst_no").Value
End If
mPinCode = rsTmp1.Fields("cs_pin_code").Value
If rsTmp1.Fields("cs_gst_no").Value = "" Then
mShipGstIn = "NRP"
Else
mShipGstIn = rsTmp2.Fields("cs_gst_no").Value
End If
mShipName = rsTmp2.Fields("cs_namee").Value
mShipAdd1 = rsTmp2.Fields("cs_name").Value
mShipAdd2 = rsTmp2.Fields("cs_add1").Value
mShipCity = rsTmp2.Fields("cs_city").Value
mShipPinCode = rsTmp2.Fields("cs_pin_code").Value
mShipStateCode = rsTmp2.Fields("state_code").Value
mExpRefNo = ""
ElseIf Mid(rsTmp1.Fields("CH_NO").Value, 1, 2) = "E0" And rsTmp1.Fields("IGSTAMT").Value = 0 Then
mBusiness = "EXPWOP"
mBuyerCity = "INDIA"
mInvNo = "WD/E/" + Mid(rsTmp1.Fields("CH_NO").Value, 4, 3) + "/20-21"
mPos = 96
mGSTIn = "URP"
mPinCode = "999999"
mShipGstIn = "URP"
mShipName = rsTmp3.Fields("IeH_LOADPORT").Value
If Mid(rsTmp3.Fields("IEH_LOADPORT").Value, 1, 6) = "MUNDRA" Then
mShipAdd1 = "MUNDRA, INDIAN SEA PORT"
mShipAdd2 = ""
mShipCity = "KUTCH"
mShipPinCode = "370201"
mShipStateCode = "24"
ElseIf Mid(rsTmp3.Fields("IEH_LOADPORT").Value, 1, 6) = "MUMBAI" Then
mShipAdd1 = "MUMBAI INDIAN AIRPORT"
mShipAdd2 = ""
mShipCity = "MUMBAI"
mShipPinCode = "400099"
mShipStateCode = "27"
ElseIf Mid(rsTmp3.Fields("IEH_LOADPORT").Value, 1, 5) = "NAHVA" Or Mid(rsTmp3.Fields("IEH_LOADPORT").Value, 1, 5) = "NHAVA" Then
mShipAdd1 = "NHAVA SHEVA  INDIAN SEAPORT"
mShipAdd2 = ""
mShipCity = "MUMBAI"
mShipPinCode = "400707"
mShipStateCode = "27"
ElseIf Mid(rsTmp3.Fields("IEH_LOADPORT").Value, 1, 5) = "DELHI" Then
mShipAdd1 = "DELHI AIRPORT"
mShipAdd2 = ""
mShipCity = "DELHI"
'mShipPinCode = "400707"
'mShipStateCode = "27"
ElseIf Mid(rsTmp3.Fields("IEH_LOADPORT").Value, 1, 7) = "UDAIPUR" Then
mShipAdd1 = "UDAIPUR RAJASTHAN"
mShipAdd2 = ""
mShipCity = "UDAIPUR"
mShipPinCode = "313003"
mShipStateCode = "08"
End If
ElseIf Mid(rsTmp1.Fields("CH_NO").Value, 1, 2) = "E0" And rsTmp1.Fields("IGSTAMT").Value > 0 Then
mBusiness = "EXPWP"
mBuyerCity = "INDIA"
mInvNo = "WD/E/" + Mid(rsTmp1.Fields("CH_NO").Value, 4, 3) + "/20-21"
mPos = 96
mGSTIn = "URP"
mPinCode = "999999"
mShipGstIn = "URP"
mShipName = rsTmp3.Fields("IeH_LOADPORT").Value
mExpRefNo = "IEC NO. :1389004066"
If Mid(rsTmp3.Fields("IEH_LOADPORT").Value, 1, 6) = "MUNDRA" Then
mShipAdd1 = "MUNDRA, INDIAN SEA PORT"
mShipAdd2 = ""
mShipCity = "KUTCH"
mShipPinCode = "370201"
mShipStateCode = "24"
ElseIf Mid(rsTmp3.Fields("IEH_LOADPORT").Value, 1, 6) = "MUMBAI" Then
mShipAdd1 = "MUMBAI INDIAN AIRPORT"
mShipAdd2 = ""
mShipCity = "MUMBAI"
mShipPinCode = "400099"
mShipStateCode = "27"
ElseIf Mid(rsTmp3.Fields("IEH_LOADPORT").Value, 1, 5) = "NHAVA" Then
mShipAdd1 = "NHAVA SHEVA  INDIAN SEAPORT"
mShipAdd2 = ""
mShipCity = "MUMBAI"
mShipPinCode = "400707"
mShipStateCode = "27"
ElseIf Mid(rsTmp3.Fields("IEH_LOADPORT").Value, 1, 5) = "DELHI" Then
mShipAdd1 = "DELHI AIRPORT"
mShipAdd2 = ""
mShipCity = "DELHI"
'mShipPinCode = "400707"
'mShipStateCode = "27"
ElseIf Mid(rsTmp3.Fields("IEH_LOADPORT").Value, 1, 7) = "UDAIPUR" Then
mShipAdd1 = "UDAIPUR RAJASTHAN"
mShipAdd2 = ""
mShipCity = "UDAIPUR"
mShipPinCode = "313003"
mShipStateCode = "08"
End If
ElseIf Mid(rsTmp1.Fields("CH_NO").Value, 1, 2) = "SD" And rsTmp1.Fields("IGSTAMT").Value = 0 Then
mBusiness = "SEZWOP"
mBuyerCity = rsTmp1.Fields("CM.CM_CITY").Value + "INDIA"
mInvNo = "WD/" + rsTmp1.Fields("CH_NO").Value + "/20-21"
mPos = rsTmp1.Fields("state_code").Value
mGSTIn = rsTmp1.Fields("cs_gst_no").Value
mPinCode = rsTmp1.Fields("cs_pin_code").Value
mShipGstIn = rsTmp2.Fields("cs_gst_no").Value
mShipName = rsTmp2.Fields("cs_namee").Value
mShipAdd1 = rsTmp2.Fields("cs_add1").Value
mShipAdd2 = rsTmp2.Fields("cs_add2").Value
mShipCity = rsTmp2.Fields("cs_city").Value
mShipPinCode = rsTmp2.Fields("cs_pin_code").Value
mShipStateCode = rsTmp2.Fields("state_code").Value
mExpRefNo = ""
ElseIf Mid(rsTmp1.Fields("CH_NO").Value, 1, 2) = "SD" And rsTmp1.Fields("IGSTAMT").Value > 0 Then
mBusiness = "SEZWP"
mBuyerCity = rsTmp1.Fields("CM.CM_CITY").Value + "INDIA"
mInvNo = "WD/" + rsTmp1.Fields("CH_NO").Value + "/20-21"
mPos = rsTmp1.Fields("state_code").Value
mGSTIn = rsTmp1.Fields("cs_gst_no").Value
mPinCode = rsTmp1.Fields("cs_pin_code").Value
mShipName = rsTmp2.Fields("cs_namee").Value
mShipAdd1 = rsTmp2.Fields("cs_add1").Value
mShipAdd2 = rsTmp2.Fields("cs_add2").Value
mShipCity = rsTmp2.Fields("cs_city").Value
mShipPinCode = rsTmp2.Fields("cs_pin_code").Value
mShipStateCode = rsTmp2.Fields("state_code").Value
mExpRefNo = ""
ElseIf Mid(rsTmp1.Fields("CH_NO").Value, 1, 2) = "SE" And rsTmp1.Fields("IGSTAMT").Value = 0 Then
mBusiness = "SEZWOP"
mBuyerCity = rsTmp.Fields("CM_CITY").Value + "INDIA"
mInvNo = "WD/SE/" + CStr(Val(Mid(rsTmp1.Fields("CH_NO").Value, 4, 3))) + "/20-21"
mPos = rsTmp1.Fields("state_code").Value
mGSTIn = rsTmp1.Fields("cs_gst_no").Value
mPinCode = rsTmp1.Fields("cs_pin_code").Value
mShipGstIn = rsTmp2.Fields("cs_gst_no").Value
mShipName = rsTmp2.Fields("cs_name").Value
mShipAdd1 = rsTmp2.Fields("cs_add1").Value
mShipAdd2 = rsTmp2.Fields("cs_add2").Value
mShipCity = rsTmp2.Fields("cs_city").Value
mExpRefNo = "IEC NO. :1389004066"
mShipPinCode = rsTmp2.Fields("cs_pin_code").Value
mShipStateCode = rsTmp2.Fields("state_code").Value
ElseIf Mid(rsTmp1.Fields("CH_NO").Value, 1, 2) = "SE" And rsTmp1.Fields("IGSTAMT").Value > 0 Then
mBusiness = "SEZWP"
mBuyerCity = rsTmp1.Fields("CM.CM_CITY").Value + "INDIA"
mInvNo = "WD/SE/" + CStr(Val(Mid(rsTmp1.Fields("CH_NO").Value, 4, 3))) + "/20-21"
mPos = rsTmp1.Fields("state_code").Value
mGSTIn = rsTmp1.Fields("cs_gst_no").Value
mPinCode = rsTmp1.Fields("cs_pin_code").Value
mShipGstIn = rsTmp2.Fields("cs_gst_no").Value
mShipName = rsTmp2.Fields("cs_name").Value
mShipAdd1 = rsTmp2.Fields("cs_add1").Value
mShipAdd2 = rsTmp2.Fields("cs_add2").Value
mShipCity = rsTmp2.Fields("cs_city").Value
mExpRefNo = "IEC NO. :1389004066"
mShipPinCode = rsTmp2.Fields("cs_pin_code").Value
mShipStateCode = rsTmp2.Fields("state_code").Value
'ElseIf Mid(rsTmp1.Fields("CH_NO").Value, 1, 2) = "E0" And rsTmp1.Fields("IGSTAMT").Value = 0 Then
'mBusiness = "DEXP"
End If

If Mid(rsTmp1.Fields("CH_NO").Value, 1, 2) = "DG" Or Mid(rsTmp1.Fields("CH_NO").Value, 1, 2) = "L0" Or Mid(rsTmp1.Fields("CH_NO").Value, 1, 2) = "E0" Or Mid(rsTmp1.Fields("CH_NO").Value, 1, 2) = "SD" Or Mid(rsTmp1.Fields("CH_NO").Value, 1, 2) = "SE" Then
mInv = "INV"
mRev = "N"
If rsTmp4.Fields("HSN_SAC").Value = "G" Then
mService = "N"
Else
mService = "Y"
End If
ElseIf Mid(rsTmp1.Fields("CH_NO").Value, 1, 3) = "CNG" Then
mInv = "CRN"
mRev = "N"
If rsTmp4.Fields("HSN_SAC").Value = "G" Then
mService = "N"
Else
mService = "Y"
End If
ElseIf Mid(rsTmp1.Fields("CH_NO").Value, 1, 3) = "DNG" Then
mInv = "DBN"
mRev = "N"
If rsTmp4.Fields("HSN_SAC").Value = "G" Then
mService = "N"
Else
mService = "Y"
End If

ElseIf Mid(rsTmp1.Fields("CH_NO").Value, 1, 2) = "OS" Then
mInv = "INV"
mRev = "N"
If rsTmp4.Fields("HSN_SAC").Value = "G" Then
mService = "N"
Else
mService = "Y"
End If
Else
mInv = "DBN"
mRev = "Y"
If rsTmp4.Fields("HSN_SAC").Value = "G" Then
mService = "N"
Else
mService = "Y"
End If
End If

If Mid(txtChalNo.Text, 1, 2) = "PR" Then
strsql = ("SELECT JSON_ARRAY(JSON_OBJECT('transaction' VALUE JSON_OBJECT('Version' VALUE '1.1','TranDtls' VALUE JSON_OBJECT('TaxSch' VALUE 'GST','SupTyp' VALUE '" & mBusiness & "','RegRev' value 'N','EcmGstIn' Value null,'IgstOnIntra' VALUE '" & mRev & "'), " _
& "'DocDtls' VALUE JSON_OBJECT('Typ' VALUE '" & mInv & "','No' VALUE '" & mInvNo & "','Dt' value to_char(CH.CH_DATE,'dd/MM/yyyy')), " _
& "'SellerDtls' VALUE JSON_OBJECT('Gstin' VALUE  '08AAACW2424P1Z1','LglNm' VALUE trim(CM.CM_NAME) ,'TrdNm' value trim(CM.CM_NAME),'Addr1' VALUE CASE WHEN CM.CM_ADD1=' ' THEN NULL ELSE CM.CM_ADD1 END,'Addr2' VALUE CASE WHEN CM.CM_ADD2=' ' THEN NULL ELSE CM.CM_ADD2 END,'Loc' VALUE '" & mBuyerCity & "',   " _
& "'Pin' VALUE 313003,'Stcd' value '08','Ph' VALUE CM.CM_PH1,'Em' VALUE CM.CM_EMAILID), " _
& "'BuyerDtls' VALUE JSON_OBJECT('Gstin' VALUE '" & mGSTIn & "','LglNm' VALUE trim(CS.CS_NAME),'TrdNm' value trim(CS.CS_NAME),'Pos' VALUE '" & mPos & "','Addr1' VALUE CASE WHEN CS.CS_ADD1=' ' THEN NULL ELSE CS.CS_ADD1 END,'Addr2' VALUE CASE WHEN CS.CS_ADD2=' ' THEN NULL ELSE CS.CS_ADD2 END, " _
& "'Loc' VALUE CASE WHEN CS.CS_CITY=' ' THEN NULL ELSE CS.CS_CITY END,'Pin' VALUE '" & mPinCode & "','Stcd' value '" & mPos & "','Ph' VALUE CASE WHEN length(CS.CS_PH1)<=6 THEN CS.CS_MOBILE ELSE CS.CS_PH1 END,'Em' VALUE TRIM(CS.CS_EMAIL)), " _
& "'DispDtls' VALUE JSON_OBJECT('Nm' VALUE CM.CM_NAME,'Addr1' VALUE CASE WHEN CM.CM_ADD1=' ' THEN NULL ELSE CM.CM_ADD1 END,'Addr2' VALUE CASE WHEN CM.CM_ADD2=' ' THEN NULL ELSE CM.CM_ADD2 END,'Loc' VALUE CM.CM_CITY,'Pin' VALUE CM.CM_PIN,'Stcd' value '08'), " _
& "'ShipDtls' VALUE JSON_OBJECT('Gstin' VALUE '" & mShipGstIn & "','LglNm' VALUE '" & mShipName & "','TrdNm' value '" & mShipName & "','Addr1' VALUE CASE WHEN '" & mShipAdd1 & "'=' ' THEN NULL ELSE '" & mShipAdd1 & "' END,'Addr2' VALUE CASE WHEN '" & mShipAdd2 & "'=' ' THEN NULL ELSE '" & mShipAdd2 & "' END,'Loc' VALUE '" & mShipCity & "', " _
& "'Pin' VALUE'" & mShipPinCode & "','Stcd' value '" & mShipStateCode & "'), " _
& "'ItemList' VALUE (SELECT JSON_ARRAYAGG(JSON_OBJECT('SlNo' VALUE to_char(STK.STK_SNO), 'PrdDesc' VALUE STK.STK_PRNAME,'IsServc' VALUE '" & mService & "','HsnCd' value STK.EH_CODE ,'BarCde' VALUE '','Qty' VALUE -1*STK.STK_QTY,'FreeQty' VALUE 0, " _
& "'Unit' VALUE STK.UNIT_CODE, 'UnitPrice' VALUE STK.STK_RATE,'TotAmt' VALUE (-1*STK.STK_NET_AMT+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.CH_FREIGHTAMT,0) ELSE 0 END+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.CH_INSAMT,0) ELSE 0 END),'Discount' value COALESCE(-1*STK.STK_DISC_AMT,0),'PreTaxVal' VALUE COALESCE((-1*STK.STK_NET_AMT+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.CH_FREIGHTAMT,0) ELSE 0 END+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.CH_INSAMT,0) ELSE 0 END-STK.STK_DISC_AMT),0),'AssAmt' VALUE COALESCE((-1*STK.STK_NET_AMT+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.CH_FREIGHTAMT,0) ELSE 0 END+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.CH_INSAMT,0) ELSE 0 END -STK.STK_DISC_AMT),0),'GstRt' VALUE COALESCE(STK.CGSTRATE+STK.SGSTRATE+STK.IGSTRATE,0),'IgstAmt' vALUE COALESCE((STK.IGSTAMT+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.FRE_IGSTAMT,0) ELSE 0 END+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.INS_IGSTAMT,0) ELSE 0 END),0), " _
& "'CgstAmt' VALUE COALESCE((STK.CGSTAMT+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.FRE_CGSTAMT,0) ELSE 0 END+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.INS_CGSTAMT,0) ELSE 0 END),0), 'SgstAmt' VALUE COALESCE((STK.SGSTAMT+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.FRE_SGSTAMT,0) ELSE 0 END+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.INS_SGSTAMT,0) ELSE 0 END),0),'CesRt' VALUE COALESCE(STK.CESSRATE,0),'CesAmt' value COALESCE(STK.CESSAMT,0),'CesNonAdvLAmt' VALUE 0,'StateCesRt' VALUE 0,'StateCesAmt' VALUE 0,'StateCesNonAdvLAmt' VALUE 0, " _
& "'OthChrg' VALUE 0, 'TotItemVal' VALUE -1*STK.STK_NET_AMT+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.CH_FREIGHTAMT,0) ELSE 0 END+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.CH_INSAMT,0) ELSE 0 END-STK.STK_DISC_AMT+STK.IGSTAMT+STK.CGSTAMT+STK.SGSTAMT+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.FRE_CGSTAMT,0) ELSE 0 END+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.INS_CGSTAMT,0) ELSE 0 END+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.FRE_SGSTAMT,0) ELSE 0 END+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.INS_SGSTAMT,0) ELSE 0 END+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.FRE_IGSTAMT,0) ELSE 0 END+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.INS_IGSTAMT,0) ELSE 0 END ,'OrdLineRef' VALUE COALESCE('',''),'OrgCnTry' value COALESCE('',''),'PrdSlNo' VALUE COALESCE('',''), " _
& "'BchDtls' VALUE (SELECT JSON_OBJECT('Nm' VALUE 'NOT AVAILABLE','ExpDt' VALUE null,'WrDt' VALUE null)  FROM DUAL), " _
& "'AttribDtls' VALUE JSON_ARRAY(JSON_OBJECT('Nm' VALUE COALESCE('',''),'Val' VALUE COALESCE('','')))))  FROM STOCK STK WHERE STK.CM_CODE='" & gintCompCode & "' AND STK.STK_YEAR= '" & gintCurrYearStart & "' AND STK.STK_TRANSNO=CH.OH_NO and rownum<=3), " _
& "'ValDtls' VALUE JSON_OBJECT ('AssVal' VALUE COALESCE((CH.CH_GROSSAMT+NVL(CH.CH_FREIGHTAMT,0)+NVL(CH.CH_INSAMT,0)),0),'CgstVal' VALUE COALESCE(CH.CGSTAMT,0),'SgstVal' value COALESCE(CH.SGSTAMT,0),'IgstVal' VALUE COALESCE(CH.IGSTAMT,0),'CesVal' VALUE COALESCE(CH.CESSAMT,0),'StCesVal' VALUE 0, " _
& "'Discount' VALUE COALESCE(CH.CH_TOTALDISCOUNT,0),'OthChrg' value COALESCE(CH.CH_TCS_AMT,0),'RndOffAmt' value COALESCE(CH.CH_RO_AMT,0),'TotInvVal' value COALESCE(CH.CH_NETAMOUNT,0),'TotInvValFc' value COALESCE(CH.CH_NETAMOUNT,0)), " _
& "'PayDtls' VALUE JSON_OBJECT('Nm' VALUE CS.CS_NAME,'AccDet' VALUE CS.CS_ACCOUNT_NO,'Mode' value 'Cash','FinInsBr' VALUE COALESCE('',''),'PayTerm' VALUE COALESCE('',''),'PayInsTr' VALUE COALESCE('',''), " _
& "'CrTrn' VALUE COALESCE('',''),'DirDr' value COALESCE('',''),'CrDay' value COALESCE('',''),'PaidAmt' value 0,'PaymtDue' value COALESCE(CH.CH_DUE_AMOUNT,0)), " _
& "'RefDtls' VALUE JSON_OBJECT('InvRm' VALUE '','DocPerdDtls' Value JSON_OBJECT('InvStDt' VALUE to_char(CH.CH_DATE,'dd/mm/yyyy'),'InvEndDt' value to_char(CH.CH_DATE,'dd/mm/yyyy')), " _
& "'PrecDocDtl' VALUE JSON_ARRAY(JSON_OBJECT('InvNo' VALUE '" & mInvNo & "' ,'InvDt' value to_char(CH.CH_DATE,'dd/mm/yyyy'),'OthRefNo' VALUE CH.CH_NO)), " _
& "'ContrDtls' VALUE JSON_ARRAY(JSON_OBJECT('RecAdvRefr' VALUE COALESCE('',''),'RecAdvDt' value COALESCE('',''),'TendRefr' value COALESCE('',''),'ContrRefr' value COALESCE('',''),'ExtRefr' value COALESCE('',''),'ProjRefr' value COALESCE('',''),'PoRefr' value CH.CH_BUYERSREF,'PORefDt' value to_char(CH.CH_BUYERSREFDATE,'dd/mm/yyyy')))), " _
& "'AddLDocDtls' VALUE JSON_ARRAY(JSON_OBJECT('url' VALUE '','Docs' value '','Info' value '')), " _
& "'ExpDtls' VALUE JSON_OBJECT('ShipBNo' VALUE COALESCE('',''), 'ShipBDt' VALUE COALESCE('',''),'Port' VALUE COALESCE('',''),'RefClm' value 'N','ForCur' VALUE COALESCE('',''),'CntCode' VALUE COALESCE('','')), " _
& "'EwbDtls' VALUE JSON_OBJECT('TransId' VALUE  CASE WHEN TM.TR_ID=' ' THEN NULL ELSE TM.TR_ID END, 'TransName' VALUE TM.TM_NAME,'Distance' VALUE 0,'TransDocNo' value '" & mDoc & "','TransDocDt' VALUE CASE WHEN '" & mTransMode & "'=' ' THEN ' ' ELSE to_char(CH.CH_DATE,'dd/mm/yyyy') END,'VehNo' VALUE '" & mVehNo & "','VehType' VALUE '" & mVehType & "','TransMode' VALUE '" & mTransMode & "'),'Custom_fieldss' VALUE json_object('CustomFieldLabel1' VALUE 'CustomFieldValue1','CustomFieldLabel2' VALUE 'CustomFieldValue2','CustomFieldLabel3' VALUE 'CustomFieldValue3')))) as mysql FROM CHALLAN_HDR CH " _
& " LEFT OUTER JOIN COMPANY_MASTER CM ON CM.CM_CODE=CH.CM_CODE " _
& " LEFT OUTER JOIN CUSTOMER_SUPPLIER CS ON CS.AM_CODE=CH.AM_CODE_CUST AND CS.CM_CODE=" & gintCompCode & " " _
& " LEFT OUTER JOIN CUSTOMER_SUPPLIER CS1 ON CS1.AM_CODE=CH.AM_CODE_CON AND CS1.CM_CODE=" & gintCompCode & "" _
& " LEFT OUTER JOIN TRANSPORT_MAPPING TM ON TM.TM_CODE=CH.TM_CODE " _
& " LEFT OUTER JOIN CUSTOMER_SUPPLIER TCS ON TCS.AM_CODE=TM.AM_CODE AND tCS.CM_CODE=" & gintCompCode & " " _
& " LEFT OUTER JOIN INVOICE_EXPORT_HDR IEH ON IEH.CM_CODE=1 AND IEH.IH_YEAR=" & gintCurrYearStart & " AND IEH.IH_NO=CH.IH_NO AND IEH.IH_YEAR=" & gintCurrYearStart & " AND IEH.CM_CODE=" & gintCompCode & "" _
& " WHERE CH.CM_CODE=" & gintCompCode & " AND CH.CH_YEAR=" & gintCurrYearStart & " AND CH.OH_NO='" & txtChalNo.Text.Trim.ToString & "'")
Else
strsql = ("SELECT JSON_ARRAY(JSON_OBJECT('transaction' VALUE JSON_OBJECT('Version' VALUE '1.1','TranDtls' VALUE JSON_OBJECT('TaxSch' VALUE 'GST','SupTyp' VALUE '" & mBusiness & "','RegRev' value 'N','EcmGstIn' Value null,'IgstOnIntra' VALUE '" & mRev & "'), " _
& "'DocDtls' VALUE JSON_OBJECT('Typ' VALUE '" & mInv & "','No' VALUE '" & mInvNo & "','Dt' value to_char(CH.CH_DATE,'dd/MM/yyyy')), " _
& "'SellerDtls' VALUE JSON_OBJECT('Gstin' VALUE  '08AAACW2424P1Z1','LglNm' VALUE trim(CM.CM_NAME) ,'TrdNm' value trim(CM.CM_NAME),'Addr1' VALUE CASE WHEN CM.CM_ADD1=' ' THEN NULL ELSE CM.CM_ADD1 END,'Addr2' VALUE CASE WHEN CM.CM_ADD2=' ' THEN NULL ELSE CM.CM_ADD2 END,'Loc' VALUE '" & mBuyerCity & "',   " _
& "'Pin' VALUE 313003,'Stcd' value '08','Ph' VALUE CM.CM_PH1,'Em' VALUE CM.CM_EMAILID), " _
& "'BuyerDtls' VALUE JSON_OBJECT('Gstin' VALUE '" & mGSTIn & "','LglNm' VALUE trim(CS.CS_NAME),'TrdNm' value trim(CS.CS_NAME),'Pos' VALUE '" & mPos & "','Addr1' VALUE CASE WHEN CS.CS_ADD1=' ' THEN NULL ELSE CS.CS_ADD1 END,'Addr2' VALUE CASE WHEN CS.CS_ADD2=' ' THEN NULL ELSE CS.CS_ADD2 END, " _
& "'Loc' VALUE CASE WHEN CS.CS_CITY=' ' THEN NULL ELSE CS.CS_CITY END,'Pin' VALUE '" & mPinCode & "','Stcd' value '" & mPos & "','Ph' VALUE CASE WHEN length(CS.CS_PH1)<=6 THEN CS.CS_MOBILE ELSE CS.CS_PH1 END,'Em' VALUE TRIM(CS.CS_EMAIL)), " _
& "'DispDtls' VALUE JSON_OBJECT('Nm' VALUE CM.CM_NAME,'Addr1' VALUE CASE WHEN CM.CM_ADD1=' ' THEN NULL ELSE CM.CM_ADD1 END,'Addr2' VALUE CASE WHEN CM.CM_ADD2=' ' THEN NULL ELSE CM.CM_ADD2 END,'Loc' VALUE CM.CM_CITY,'Pin' VALUE CM.CM_PIN,'Stcd' value '08'), " _
& "'ShipDtls' VALUE JSON_OBJECT('Gstin' VALUE '" & mShipGstIn & "','LglNm' VALUE '" & mShipName & "','TrdNm' value '" & mShipName & "','Addr1' VALUE CASE WHEN '" & mShipAdd1 & "'=' ' THEN NULL ELSE '" & mShipAdd1 & "' END,'Addr2' VALUE CASE WHEN '" & mShipAdd2 & "'=' ' THEN NULL ELSE '" & mShipAdd2 & "' END,'Loc' VALUE '" & mShipCity & "', " _
& "'Pin' VALUE'" & mShipPinCode & "','Stcd' value '" & mShipStateCode & "'), " _
& "'ItemList' VALUE (SELECT JSON_ARRAYAGG(JSON_OBJECT('SlNo' VALUE to_char(STK.STK_SNO), 'PrdDesc' VALUE STK.STK_PRNAME,'IsServc' VALUE '" & mService & "','HsnCd' value STK.EH_CODE ,'BarCde' VALUE '','Qty' VALUE STK.STK_QTY,'FreeQty' VALUE 0, " _
& "'Unit' VALUE STK.UNIT_CODE, 'UnitPrice' VALUE STK.STK_RATE,'TotAmt' VALUE (STK.STK_NET_AMT+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.CH_FREIGHTAMT,0) ELSE 0 END+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.CH_INSAMT,0) ELSE 0 END),'Discount' value COALESCE(STK.STK_DISC_AMT,0),'PreTaxVal' VALUE COALESCE((STK.STK_NET_AMT+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.CH_FREIGHTAMT,0) ELSE 0 END+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.CH_INSAMT,0) ELSE 0 END-STK.STK_DISC_AMT),0),'AssAmt' VALUE COALESCE((STK.STK_NET_AMT+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.CH_FREIGHTAMT,0) ELSE 0 END+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.CH_INSAMT,0) ELSE 0 END-STK.STK_DISC_AMT),0),'GstRt' VALUE COALESCE(STK.CGSTRATE+STK.SGSTRATE+STK.IGSTRATE,0),'IgstAmt' vALUE COALESCE((STK.IGSTAMT+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.FRE_IGSTAMT,0) ELSE 0 END+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.INS_IGSTAMT,0) ELSE 0 END),0), " _
& "'CgstAmt' VALUE COALESCE((STK.CGSTAMT+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.FRE_CGSTAMT,0) ELSE 0 END+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.INS_CGSTAMT,0) ELSE 0 END),0), 'SgstAmt' VALUE COALESCE((STK.SGSTAMT+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.FRE_SGSTAMT,0) ELSE 0 END+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.INS_SGSTAMT,0) ELSE 0 END),0),'CesRt' VALUE COALESCE(STK.CESSRATE,0),'CesAmt' value COALESCE(STK.CESSAMT,0),'CesNonAdvLAmt' VALUE 0,'StateCesRt' VALUE 0,'StateCesAmt' VALUE 0,'StateCesNonAdvLAmt' VALUE 0, " _
& "'OthChrg' VALUE 0, 'TotItemVal' VALUE STK.STK_NET_AMT+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.CH_FREIGHTAMT,0) ELSE 0 END+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.CH_INSAMT,0) ELSE 0 END-STK.STK_DISC_AMT+STK.IGSTAMT+STK.CGSTAMT+STK.SGSTAMT+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.FRE_CGSTAMT,0) ELSE 0 END+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.INS_CGSTAMT,0) ELSE 0 END+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.FRE_SGSTAMT,0) ELSE 0 END+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.INS_SGSTAMT,0) ELSE 0 END+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.FRE_IGSTAMT,0) ELSE 0 END+CASE WHEN STK.STK_SNO=1 THEN NVL(CH.INS_IGSTAMT,0) ELSE 0 END ,'OrdLineRef' VALUE COALESCE('',''),'OrgCnTry' value COALESCE('',''),'PrdSlNo' VALUE COALESCE('',''), " _
& "'BchDtls' VALUE (SELECT JSON_OBJECT('Nm' VALUE 'NOT AVAILABLE','ExpDt' VALUE null,'WrDt' VALUE null)  FROM DUAL), " _
& "'AttribDtls' VALUE JSON_ARRAY(JSON_OBJECT('Nm' VALUE COALESCE('',''),'Val' VALUE COALESCE('','')))))  FROM STOCK STK WHERE STK.CM_CODE='" & gintCompCode & "' AND STK.STK_YEAR= '" & gintCurrYearStart & "' AND STK.STK_TRANSNO=CH.CH_NO and rownum<=3), " _
& "'ValDtls' VALUE JSON_OBJECT ('AssVal' VALUE COALESCE((CH.CH_GROSSAMT+NVL(CH.CH_FREIGHTAMT,0)+NVL(CH.CH_INSAMT,0)),0),'CgstVal' VALUE COALESCE(CH.CGSTAMT,0),'SgstVal' value COALESCE(CH.SGSTAMT,0),'IgstVal' VALUE COALESCE(CH.IGSTAMT,0),'CesVal' VALUE COALESCE(CH.CESSAMT,0),'StCesVal' VALUE 0, " _
& "'Discount' VALUE COALESCE(CH.CH_TOTALDISCOUNT,0),'OthChrg' value COALESCE(CH.CH_TCS_AMT,0),'RndOffAmt' value COALESCE(CH.CH_RO_AMT,0),'TotInvVal' value COALESCE(CH.CH_NETAMOUNT,0),'TotInvValFc' value COALESCE(CH.CH_NETAMOUNT,0)), " _
& "'PayDtls' VALUE JSON_OBJECT('Nm' VALUE CS.CS_NAME,'AccDet' VALUE CS.CS_ACCOUNT_NO,'Mode' value 'Cash','FinInsBr' VALUE COALESCE('',''),'PayTerm' VALUE COALESCE('',''),'PayInsTr' VALUE COALESCE('',''), " _
& "'CrTrn' VALUE COALESCE('',''),'DirDr' value COALESCE('',''),'CrDay' value COALESCE('',''),'PaidAmt' value 0,'PaymtDue' value COALESCE(CH.CH_DUE_AMOUNT,0)), " _
& "'RefDtls' VALUE JSON_OBJECT('InvRm' VALUE '','DocPerdDtls' Value JSON_OBJECT('InvStDt' VALUE to_char(CH.CH_DATE,'dd/mm/yyyy'),'InvEndDt' value to_char(CH.CH_DATE,'dd/mm/yyyy')), " _
& "'PrecDocDtl' VALUE JSON_ARRAY(JSON_OBJECT('InvNo' VALUE '" & mInvNo & "' ,'InvDt' value to_char(CH.CH_DATE,'dd/mm/yyyy'),'OthRefNo' VALUE CH.CH_NO)), " _
& "'ContrDtls' VALUE JSON_ARRAY(JSON_OBJECT('RecAdvRefr' VALUE COALESCE('',''),'RecAdvDt' value COALESCE('',''),'TendRefr' value COALESCE('',''),'ContrRefr' value COALESCE('',''),'ExtRefr' value COALESCE('',''),'ProjRefr' value COALESCE('',''),'PoRefr' value CH.CH_BUYERSREF,'PORefDt' value to_char(CH.CH_BUYERSREFDATE,'dd/mm/yyyy')))), " _
& "'AddLDocDtls' VALUE JSON_ARRAY(JSON_OBJECT('url' VALUE '','Docs' value '','Info' value '')), " _
& "'ExpDtls' VALUE JSON_OBJECT('ShipBNo' VALUE COALESCE('',''), 'ShipBDt' VALUE COALESCE('',''),'Port' VALUE COALESCE('',''),'RefClm' value 'N','ForCur' VALUE COALESCE('',''),'CntCode' VALUE COALESCE('','')), " _
& "'EwbDtls' VALUE JSON_OBJECT('TransId' VALUE  CASE WHEN TM.TR_ID=' ' THEN NULL ELSE TM.TR_ID END, 'TransName' VALUE TM.TM_NAME,'Distance' VALUE 0,'TransDocNo' value '" & mDoc & "','TransDocDt' VALUE CASE WHEN '" & mTransMode & "'=' ' THEN ' ' ELSE to_char(CH.CH_DATE,'dd/mm/yyyy') END,'VehNo' VALUE '" & mVehNo & "','VehType' VALUE '" & mVehType & "','TransMode' VALUE '" & mTransMode & "'),'Custom_fieldss' VALUE json_object('CustomFieldLabel1' VALUE 'CustomFieldValue1','CustomFieldLabel2' VALUE 'CustomFieldValue2','CustomFieldLabel3' VALUE 'CustomFieldValue3')))) as mysql FROM CHALLAN_HDR CH " _
& " LEFT OUTER JOIN COMPANY_MASTER CM ON CM.CM_CODE=CH.CM_CODE " _
& " LEFT OUTER JOIN CUSTOMER_SUPPLIER CS ON CS.AM_CODE=CH.AM_CODE_CUST AND CS.CM_CODE=" & gintCompCode & " " _
& " LEFT OUTER JOIN CUSTOMER_SUPPLIER CS1 ON CS1.AM_CODE=CH.AM_CODE_CON AND CS1.CM_CODE=" & gintCompCode & "" _
& " LEFT OUTER JOIN TRANSPORT_MAPPING TM ON TM.TM_CODE=CH.TM_CODE " _
& " LEFT OUTER JOIN CUSTOMER_SUPPLIER TCS ON TCS.AM_CODE=TM.AM_CODE AND tCS.CM_CODE=" & gintCompCode & " " _
& " LEFT OUTER JOIN INVOICE_EXPORT_HDR IEH ON IEH.CM_CODE=1 AND IEH.IH_YEAR=" & gintCurrYearStart & " AND IEH.IH_NO=CH.IH_NO AND IEH.IH_YEAR=" & gintCurrYearStart & " AND IEH.CM_CODE=" & gintCompCode & "" _
& " WHERE CH.CM_CODE=" & gintCompCode & " AND CH.CH_YEAR=" & gintCurrYearStart & " AND CH.CH_NO='" & txtChalNo.Text.Trim.ToString & "'")
End If
rsPrimary.Open(strsql, gConn, ADODB.CursorTypeEnum.adOpenDynamic)
json = rsPrimary.Fields("mysql")

TextBox12.Text = "GST"
TextBox13.Text = mBusiness
TextBox14.Text = mInv
TextBox15.Text = mInvNo
TextBox16.Text = rsTmp1.Fields("CH_DATE").Value
TextBox18.Text = "08AAACW2424P1Z1"
TextBox19.Text = rsTmp.Fields("CM_NAME").Value
TextBox20.Text = rsTmp.Fields("CM_ADD1").Value
TextBox21.Text = rsTmp.Fields("Cm_CITY").Value
TextBox22.Text = "313003"
TextBox24.Text = "08"
TextBox25.Text = mGSTIn
TextBox26.Text = rsTmp1.Fields("CS_NAME").Value
TextBox28.Text = mPos
TextBox30.Text = rsTmp1.Fields("CS_ADD1").Value
TextBox31.Text = rsTmp1.Fields("CS_CITY").Value
TextBox32.Text = mPinCode
TextBox33.Text = mPos
TextBox34.Text = rsTmp.Fields("CM_NAME").Value
TextBox36.Text = rsTmp.Fields("CM_ADD1").Value
TextBox37.Text = rsTmp.Fields("CM_CITY").Value
TextBox38.Text = "313003"
TextBox39.Text = mPos
TextBox40.Text = mShipName
TextBox42.Text = mShipAdd1
TextBox43.Text = mShipCity
TextBox44.Text = mShipPinCode
TextBox45.Text = mShipStateCode
TextBox46.Text = rsTmp4.Fields("stk_sno").Value
TextBox48.Text = mService
TextBox49.Text = rsTmp4.Fields("eh_code").Value
TextBox50.Text = rsTmp4.Fields("stk_rate").Value
If rsTmp4.Fields("STK_NET_AMT").Value < 0 Then
TextBox51.Text = -1 * rsTmp4.Fields("STK_NET_AMT").Value
Else
TextBox51.Text = rsTmp4.Fields("STK_NET_AMT").Value
End If
If rsTmp4.Fields("STK_NET_AMT").Value < 0 Then
TextBox52.Text = -1 * rsTmp4.Fields("STK_NET_AMT").Value
Else
TextBox52.Text = rsTmp4.Fields("STK_NET_AMT").Value
End If
TextBox54.Text = rsTmp4.Fields("CGSTRATE").Value + rsTmp4.Fields("SGSTRATE").Value + rsTmp4.Fields("IGSTRATE").Value
TextBox55.Text = "NOT APPLICABLE"
TextBox56.Text = rsTmp1.Fields("CH_GROSSAMT").Value '+ rsTmp1.Fields("CH_FREIGHTAMT").Value '+ rsTmp1.Fields("CH_INSAMT").Value
TextBox57.Text = rsTmp1.Fields("CH_NETAMOUNT").Value
TextBox58.Text = rsTmp1.Fields("CH_DATE").Value
TextBox59.Text = rsTmp1.Fields("CH_DATE").Value
TextBox60.Text = mInvNo
TextBox61.Text = rsTmp1.Fields("CH_DATE").Value
TextBox62.Text = 0

If mCnf = True Then
'Dim myUri As New Uri("https://api-einv.cleartax.in")
'Dim host As String = myUri.Host
request = CType(WebRequest.Create("https://api-einv.cleartax.in/v2/eInvoice/generate"), HttpWebRequest)
request.Headers.Add("X-Cleartax-Auth-Token", "1.3cfe12cf-e80b-4b62-a306-30f144d6f19e_638122dbce7f7e7500a5640f2dca412fc3ecf7f1f207b0aa79d6d4ff68488e15")
request.Headers.Add("x-cleartax-product", "EInvoice")
request.Headers.Add("ContentType", "application/json")
request.Headers.Add("owner_id", "0b7b1937-6481-4dcd-8344-6dbb52bbaaa4")
request.Headers.Add("gstin", "08AAACW2424P1Z1")
postdata = json.value.ToString.Trim

request.Method = "PUT"
CookieContainercookie = request.CookieContainer
request.ContentType = "application/json"
request.ContentLength = postdata.Length
Dim requestWriter As StreamWriter = New StreamWriter(request.GetRequestStream())
requestWriter.Write(postdata)
requestWriter.Close()
response = DirectCast(request.GetResponse(), HttpWebResponse)
reader = New StreamReader(response.GetResponseStream())
rawresponse = reader.ReadToEnd()
TextBox2.Text = rawresponse

'Dim json1 As String = File.ReadAllText(rawresponse)
Dim values As String() = rawresponse.Replace("""[{", "").Replace("}]""", "").Replace("""", "").Split(","c)
Dim dic As Dictionary(Of String, String) = New Dictionary(Of String, String)()
For Each item In values
If dic.Count <= 5 Then
dic.Add(item.Split(":"c)(0), item.Split(":"c)(1))
Else
If dic("document_status") = "IRN_GENERATED" Then
If dic.Count <= 16 Then
dic.Add(item.Split(":"c)(0), item.Split(":"c)(1))
End If
End If
End If
Next

If dic("document_status") = "IRN_GENERATED" Then
TextBox1.Text = dic("SignedInvoice")
TextBox2.Text = dic("AckNo")
TextBox3.Text = dic("govt_response")
TextBox4.Text = dic("document_status")
TextBox5.Text = dic("Irn")
TextBox6.Text = dic("AckNo")
TextBox7.Text = dic("AckDt")
TextBox8.Text = dic("SignedQRCode")
TextBox9.Text = dic("EwbNo")
TextBox10.Text = dic("EwbDt")
TextBox11.Text = dic("EwbValidTill")
If Mid(txtChalNo.Text, 1, 2) = "PR" Then
gConn.Execute("Update challan_hdr set irn='" & dic("Irn") & "',qrcode='" & dic("SignedQRCode") & "',ackno='" & dic("AckNo") & "',ackdt='" & dic("AckDt") & "' Where oh_no='" & Trim(txtChalNo.Text) & "'  And ch_year=" & gintCurrYearStart & " and cm_code=" & gintCompCode & "")
Else
gConn.Execute("Update challan_hdr set irn='" & dic("Irn") & "',qrcode='" & dic("SignedQRCode") & "',ackno='" & dic("AckNo") & "',ackdt='" & dic("AckDt") & "' Where ch_no='" & Trim(txtChalNo.Text) & "'  And ch_year=" & gintCurrYearStart & " and cm_code=" & gintCompCode & "")
End If
btn_qrcode.Enabled = True
txtEwayBill.Text = TextBox9.Text
End If
rsPrimary.Close()
'postdata.close()
'Else
'MsgBox("Check Data not completed")
End If
Else
MsgBox("No Invoice/GST No Available")
End If
Catch ex As Net.WebException
If ex.Response IsNot Nothing Then
response = ex.Response
End If
End Try
End Sub
End Class
