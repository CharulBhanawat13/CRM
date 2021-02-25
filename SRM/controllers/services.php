<?php
session_start();
$ntype = (int)$_SESSION['ntype'];
$userId=(int)$_SESSION['user_id'];

function generateRandomString($length = 12) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function  getCustomerAddress($user_id){
    $conn = OpenCon();
    $sql = "Select ccustAddress from tbl_customer where ninternal_id=$user_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);
    $custAddress = $row[0];
    CloseCon($conn);
    return $custAddress;

}
?>

<html>
<head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/theme.css">
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

</head>
<body style="background-color: rgb(238, 238, 238)">
<button    class="tablink" onclick="openPage1('myComplains',null)" id="defaultOpen">My Complains</button>
<button class="tablink" onclick="openPage1('complain',null)" id="complainButton">Complain</button>
<button class="tablink" onclick="openPage1('action',null)" id="actionButton">Action</button>
<button class="tablink" onclick="openPage1('result',null)" id="resultButton">Result</button>
<button class="tablink" onclick="openPage1('remarks',globalServiceId)" id="remarksButton">Remarks</button>

<form method="post" id="serviceForm" action="saveServiceData.php" enctype="multipart/form-data">
    <div>
        <label id="service">No service selected</label>
    </div>

    <a style="float:right;margin-right: 8%;" href="../dashboard.php"><i class="fa fa-home fa-2x"></i></a>

    <a style="float:right;margin-right: 15px;font-size: large; href="../logout.php"><i class="fa fa-sign-out" ></i>Logout</a>

    <div id="myComplains" class="container-large">
        <?php
        include('../db_connection.php');
        $conn = OpenCon();
        if ($ntype==3){ // in case customer
            $sql = "Select * from tbl_service where nuserId=$userId ";

        }
        else { // in case employe and admin
            $sql = "Select * from tbl_service";

        }


        $result = mysqli_query($conn, $sql);

        echo "<table id='serviceTable'  name='serviceTable'>
            <thead> 
            <tr>
            <th>VIEW</th>
            <th >SERVICE ID</th>
            <th >User Id</th>
            <th>Ticket Number</th>
            <th>Company Name</th>
            <th>Concern Person</th>
            <th>Contact Number</th>
            <th>Email Id</th>
            <th>Remark</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Service Type</th>
            <th>Warranty Type</th>
            </tr>
            </thead>
            <tbody>
            ";
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "<tr>";
            echo "<td class='opendetails'><i  class='fa fa-eye fa-2x' style='color:#4caf50;'</i></td>";
            echo "<td >" . $row['nserviceId'] . "</td>";
            echo "<td >" . $row['nuserId'] . "</td>";
            echo "<td >" . $row['cticketNo'] . "</td>";
            echo "<td>" . $row['ccompanyName'] . "</td>";
            echo "<td>" . $row['cconcernPerson'] . "</td>";
            echo "<td>" . $row['ccontactNo'] . "</td>";
            echo "<td>" . $row['cmailId'] . "</td>";
            echo "<td>" . $row['cremark2'] . "</td>";
            echo "<td>" . $row['cproductName'] . "</td>";
            echo "<td>" . $row['nqty'] . "</td>";
            echo "<td>" . $row['cserviceType1'] . "</td>";
            echo "<td>" . $row['nwarrantyType1'] . "</td>";

            echo "</tr>";
        }
        echo "</tbody></table>";
        CloseCon($conn);

        ?>
        <div><i class="fa fa-plus-large"><input type="button" onclick="addAComplain()" id="addComplain" class="btn btn-primary"  value="Add new Complain" ></div>

    </div>

    <div id='complain' class="container-large">
        <div class="grid">
            <label>Service Id</label> <input type="text" name="serviceId" id="serviceId" class="form-control">
        </div>
        <div  style="display: none" class="grid">
            <label>User Id</label> <input type="text" name="userId" id="userId" value="<?php echo $userId ?>" class="form-control">
        </div>
        <div class="grid">
            <label>Ticket Number</label> <input type="text" name="ticketNo" id="ticketNo" value="<?php echo generateRandomString($lenght=12)?>" class="form-control">
        </div>
        <div class="grid">
            <label>Company Name</label> <input type="text" name="companyName" id="companyName" class="form-control">
        </div>
        <div class="grid">
            <label>Concern Person</label><input type="text" name="concernPerson" id="concernPerson" class="form-control">
        </div>
        <div class="grid">
            <label>Contact Number</label><input type="text" name="contactNumber" id="contactNumber" class="form-control">
        </div>
        <div class="grid">


            <label>Address</label> <input title="<?php echo getCustomerAddress($userId=$userId)?>" type="text" name="address"  id="address" value="<?php echo getCustomerAddress($userId=$userId)?>" class="form-control">

        </div>

        <div class="grid">
            <label>PO Number</label> <input type="text" name="ponumber" id="ponumber" class="form-control">
        </div>
        <div class="grid">
            <label>Entry Date</label> <input type="date" id="entryDate" name="entryDate" class="form-control">
        </div>
        <div class="grid">
            <label>E-mailId</label> <input type="text" name="emailId" id="emailId" class="form-control">
        </div>
        <div class="grid">
            <label>Remark</label> <input type="text" name="remark1" id="remark1" class="form-control">
        </div>
        <div class="grid">
            <label>Snapshot</label> <input type="file" id="snapshot"  name="snapshot">
            <div id='filesizealert' style="color: red;display: none">File size must be under 500 kb</div>

        </div>
               <div class="grid">
            <label>Product Name</label> <input type="text" name="productName" id="productName" class="form-control">
        </div>
        <div class="grid">
            <label>Quantity</label> <input type="text" name="quantity" id="quantity" class="form-control">
        </div>
        <div class="grid">
            <label>Service Type</label> <input type="text" name="serviceType" id="serviceType" class="form-control">
        </div>
        <div class="grid">
            <label>Warranty Type</label> <select class="form-control" name="warranty1" id="warranty1">
                <option value="1">1 year warranty</option>
                <option value="2">2 year warranty</option>
                <option value="3">3 year warranty</option>
                <option value="4">4 year warranty</option>
                <option value="5">5 year warranty</option>

            </select>
        </div>

    </div>
    <div id='action' class="container-large">
        <div class="grid">
            <label>Employee Id</label> <input id="empId" name="empId" type="text" class="form-control">
        </div>
        <div class="grid">
            <label>Record Manager</label><input type="text" id="recordManager" name="recordManager" class="form-control">
        </div>
        <div class="grid">
            <label>Service Type 2</label><input type="text" id="serviceType2" name="serviceType2" class="form-control">
        </div>
        <div class="grid">
            <label>Expiry Date</label> <input type="date" id="expiryDate"  name="expiryDate" class="form-control">
        </div>
        <div class="grid">
            <label>Payment Mode</label> <input type="text" id="paymentMode" name="paymentMode" class="form-control">
        </div>
        <div class="grid">
            <label>Remark 2</label> <input type="text"  id="remark2" name="remark2" class="form-control">
        </div>
        <div class="grid">
            <label>Exp Price</label> <input type="text" id="expPrice" name="expPrice" class="form-control">
        </div>
        <div class="grid">
            <label>Warranty Type 2</label> <select class="form-control" name="warranty2" id="warranty2">
                <option value="1">1 year warranty</option>
                <option value="2">2 year warranty</option>
                <option value="3">3 year warranty</option>
                <option value="4">4 year warranty</option>
                <option value="5">5 year warranty</option>

            </select>
        </div>
        <div class="grid">
            <label>Material Rec Date</label><input type="date" id="materialRecDate" name="materialRecDate" class="form-control">
        </div>
        <div class="grid">
            <label>Attendant By</label> <input type="text" id="attendantBy" name="attendantBy" class="form-control">
        </div>
        <div class="grid">
            <label>Site Attend Date</label> <input type="date"  id="siteAttendDate" name="siteAttendDate" class="form-control">
        </div>
        <div class="grid">
            <label>Complain Status</label> <input type="text" id="complainStatus" name="complainStatus" class="form-control">
        </div>
    </div>
    <div id="result" class="container-large" >
        <div class="grid">
            <label>Employee Id</label> <input id="empId2" name="empId2" type="text" class="form-control">
        </div>
        <div class="grid">
            <label>Material Received</label><input type="text" id="materialReceived" name="materialReceived" class="form-control">
        </div>
        <div class="grid">
            <label>Recieve Quantity</label> <input type="text" id="receiveQuantity" name="receiveQuantity" class="form-control">
        </div>
        <div class="grid">
            <label>Warranty Type 3</label> <select class="form-control" name="warranty3" id="warranty3">
                <option value="1">1 year warranty</option>
                <option value="2">2 year warranty</option>
                <option value="3">3 year warranty</option>
                <option value="4">4 year warranty</option>
                <option value="5">5 year warranty</option>

            </select>
        </div>
        <div class="grid">
            <label>Fault Description</label><input type="text" id="faultDescription" name="faultDescription" class="form-control">
        </div>
        <div class="grid">
            <label>Completion Date</label> <input type="date" id="completionDate" name="completionDate" class="form-control">
        </div>
        <div class="grid">
            <label>Remark 3</label> <input type="text" id="remark3" name="remark3" class="form-control">
        </div>
        <div class="grid">
            <label>Billing Amount</label> <input type="text" id="billingAmount" name="billingAmount" class="form-control">
        </div>


    </div>
    <div id="remarks" class="container-large" >
        <div class="grid">
            <label>Rating</label><input type="text" id="rating" name="rating" class="form-control">
        </div>
        <div class="grid">
            <label>Remark By Customer</label><input type="text" id="remarkByCustomer" name="remarkByCustomer" class="form-control">
        </div>
    </div>

    <input type="submit" class="btn btn-primary" name="submit" id="submit" value="Save">


</form>
<!--<button id="Add" class="btn btn-primary">Add Product</button>-->
<!--<button id="Remove" class="btn btn-primary">Remove Product</button>-->
<!--<div id="textboxDiv"></div>-->
</body>
<script>
    var globalServiceId;

    function hideSaveButton(pageName){
        if (pageName=='myComplains'){
            document.getElementById('submit').style.display = "none";
            document.getElementById('complainButton').style.display = "none";
            document.getElementById('actionButton').style.display = "none";
            document.getElementById('resultButton').style.display = "none";
            document.getElementById('remarksButton').style.display = "none";

        }else {
            document.getElementById('submit').style.display = "block";
            document.getElementById('complainButton').style.display = "block";
            document.getElementById('actionButton').style.display = "block";
            document.getElementById('resultButton').style.display = "block";
            document.getElementById('remarksButton').style.display = "block";
        }
    }

    var ntype=<?php echo json_encode($ntype); ?>;
    if(ntype=='3'){
        document.getElementById('addComplain').style.display='block';
    }else if (ntype=='2'){
        document.getElementById('addComplain').style.display='none';

    }else if(ntype=='1'){
        document.getElementById('addComplain').style.display='block';

    }


    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
    Date.prototype.yyyymmdd = function () {
        var yyyy = this.getFullYear().toString();
        var mm = (this.getMonth() + 1).toString(); // getMonth() is zero-based
        var dd = this.getDate().toString();
        return yyyy + "-" + (mm[1] ? mm : "0" + mm[0]) + "-" + (dd[1] ? dd : "0" + dd[0]); // padding
    };
    var date = new Date();
    document.getElementById('entryDate').value = date.yyyymmdd();
    document.getElementById("entryDate").readOnly = true;
    document.getElementById("ticketNo").readOnly = true;

    document.getElementById("address").readOnly = true;




    var uploadField = document.getElementById("snapshot");

    uploadField.onchange = function () {
        if (this.files[0].size > 500000) {
            alert("File is too big!");
            this.value = "";
            document.getElementById("filesizealert").style.display = "block";
        } else {
            document.getElementById("filesizealert").style.display = "none";

        }

    };

    function addAComplain(){
       document.getElementById("serviceForm").reset();
        openPage1('complain','');
        document.getElementById('actionButton').style.display = "none";
        document.getElementById('resultButton').style.display = "none";
        document.getElementById('remarksButton').style.display = "none";

    }


    function openPage1(pageName,serviceId){
        var ntype=<?php echo json_encode($ntype); ?>;
        hideSaveButton(pageName);

        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("container-large");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].style.backgroundColor = "";
        }
        document.getElementById(pageName).style.display = "block";


        if (ntype=='2'){      // For Employee
            openPageForEmp(pageName,serviceId);
        }else if (ntype=='3'){ // For Customer
            openPageForCust(pageName,serviceId);
        }

    }

    function openPageForCust(pageName,service_id){
        if (pageName=='complain' || pageName=='remarks'  || pageName=='myComplains'){
            document.getElementById(pageName).style.display = "block";
            document.getElementById('action').style.pointerEvents='none';
            document.getElementById('result').style.pointerEvents='none';
            document.getElementById('complain').style.pointerEvents='auto';
            document.getElementById('remarks').style.pointerEvents='auto';
            globalServiceId=service_id;


        }
        if((pageName=='action' || pageName=='result' )  ) {
            document.getElementById(pageName).style.display = "block";
            document.getElementById('action').style.pointerEvents = 'none';
            document.getElementById('result').style.pointerEvents = 'none';
            document.getElementById('complain').style.pointerEvents = 'auto';
            document.getElementById('remarks').style.pointerEvents = 'auto';
        }

        if(pageName=='remarks'){
            isResultTaken(globalServiceId);
        }
    }



    function openPageForEmp(pageName,service_id) {
        if (pageName == 'complain' || pageName == 'remarks') {
            document.getElementById(pageName).style.display = "block";
            document.getElementById('complain').style.pointerEvents = 'none';
            document.getElementById('remarks').style.pointerEvents = 'none';
            document.getElementById('action').style.pointerEvents = 'auto';
            document.getElementById('result').style.pointerEvents = 'auto';
        }
        if((pageName=='action' && ntype=='2') || (pageName=='result' && ntype=='2')){
            document.getElementById(pageName).style.display = "block";
            document.getElementById('complain').style.pointerEvents='none';
            document.getElementById('remarks').style.pointerEvents='none';
            document.getElementById('action').style.pointerEvents='auto';
            document.getElementById('result').style.pointerEvents='auto';
        }

    }
    function isResultTaken(service_id){
        var result_taken_service_id=service_id;
        $.ajax({
            url:"../controllers/saveServiceData.php",    //the page containing php script
            type: "post",    //request type,
            dataType: 'json',
            data: {result_taken_service_id: result_taken_service_id},
            success:function(result){
                if (result==false){
                    alert('Result not taken');
                    document.getElementById('remarks').style.pointerEvents='none';

                }else {
                    document.getElementById('remarks').style.pointerEvents='block';

                }
            }
        });

    }

    $(document).ready(function () {
    var table = $('#serviceTable').DataTable({
                orderCellsTop: true,
                "dom": 'lrtip'
            }
        );

        $('#serviceTable thead tr').clone(true).appendTo('#serviceTable thead');
        $('#serviceTable thead tr:eq(1) th').each(function (i) {
            var title = $(this).text();
            $(this).html('<input class="form-control" type="text" placeholder="Search ' + title + '" />');
            $('input', this).on('keyup change', function () {
                if (table.column(i).search() !== this.value) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
        });

        $('#serviceTable tbody').on('click', '.opendetails', function () {
            var data = table.row($(this).parents('tr').first()).data()[1];
            var service_id=data;
            openPage1('complain',service_id);
            document.getElementById('service').value=service_id;

            $.ajax({
                url:'../controllers/saveServiceData.php',    //the page containing php script
                type: "post",    //request type,
                dataType: 'json',
                data: {service_id: service_id},
                success:function(row_datas){
                    fillInputFields(row_datas);

                }
            });


        } );



        function fillInputFields(row_datas){

            //COMPLAIN pAGE
            document.getElementById("serviceId").value = row_datas[0].nserviceId;
            document.getElementById("ticketNo").value = row_datas[0].cticketNo;
            document.getElementById("companyName").value = row_datas[0].ccompanyName;
            document.getElementById("concernPerson").value = row_datas[0].cconcernPerson;
            document.getElementById("contactNumber").value = row_datas[0].ccontactNo;
            document.getElementById("address").value = row_datas[0].caddress;
            document.getElementById("ponumber").value = row_datas[0].cPONo;
            document.getElementById("entryDate").value = row_datas[0].dentryDate;
            document.getElementById("emailId").value = row_datas[0].cmailId;
            document.getElementById("remark1").value = row_datas[0].cremark1;
            //     document.getElementById("snapshot").value = row_datas[0].csnapshot;
            document.getElementById("productName").value = row_datas[0].cproductName;
            document.getElementById("quantity").value = row_datas[0].nqty;
            document.getElementById("serviceType").value = row_datas[0].cserviceType1;
            document.getElementById("warranty1").value = row_datas[0].nwarrantyType1;

            //For Action

            document.getElementById("empId").value = row_datas[0].nempId;
            document.getElementById("recordManager").value = row_datas[0].crecordManager;
            document.getElementById("serviceType2").value = row_datas[0].nserviceType2;
            document.getElementById("expiryDate").value = row_datas[0].dexpDate;
            document.getElementById("paymentMode").value = row_datas[0].npaymentMode;
            document.getElementById("remark2").value = row_datas[0].cremark2;
            document.getElementById("expPrice").value = row_datas[0].nexpPrice;
            document.getElementById("warranty2").value = row_datas[0].nwarrantyType2;
            document.getElementById("materialRecDate").value = row_datas[0].dmaterialRecDate;
            document.getElementById("attendantBy").value = row_datas[0].cattendBy;
            document.getElementById("siteAttendDate").value = row_datas[0].dsiteAttendDate;
            document.getElementById("complainStatus").value = row_datas[0].nComplainStatus;
//For result
            document.getElementById("empId2").value=row_datas[0].nempId2;
            document.getElementById("materialReceived").value = row_datas[0].cmaterialReceived;
            document.getElementById("receiveQuantity").value = row_datas[0].nrecieveQty;
            document.getElementById("warranty3").value = row_datas[0].nwarrantyType3;
            document.getElementById("faultDescription").value = row_datas[0].cfaultDesc;
            document.getElementById("completionDate").value = row_datas[0].dcompletionDate;
            document.getElementById("remark3").value = row_datas[0].cremark3;
            document.getElementById("billingAmount").value = row_datas[0].nbillingAmount;

            //For remarks
            document.getElementById("rating").value = row_datas[0].nrating;
            document.getElementById("remarkByCustomer").value = row_datas[0].cremarkByCust;

        }


    });
</script>
</html>



