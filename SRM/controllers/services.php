<?php
session_start();
$ntype = (int)$_SESSION['ntype'];
$showDivInCaseCustomer=false;
if($ntype==3){
    $showDiv=true;
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

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

</head>
<body style="background-color: rgb(238, 238, 238)">
<button    class="tablink" onclick="openPage('myComplains', this, 'green')" id="defaultOpen">My Complains</button>
<button class="tablink" onclick="openPage('complain', this, 'green')">Complain</button>
<button class="tablink" onclick="openPage('action', this, 'green')">Action</button>
<button class="tablink" onclick="openPage('result', this, 'green')">Result</button>
<button class="tablink" onclick="openPage('remarks', this, 'green')">Remarks</button>
<div style="display: none" id="getUserType" value="<?php echo "$showDiv"?>"></div>
<form method="post" action="saveServiceData.php">
    <div id="myComplains" class="container-large">
        <?php
        include('../db_connection.php');
        $conn = OpenCon();

        $sql = "Select * from tbl_service ";


        $result = mysqli_query($conn, $sql);
        echo "<table id='serviceTable'  name='serviceTable' >
            <thead> 
            <tr>
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
            <th>Snapshot</th>
            </tr>
            </thead>
            <tbody>
            ";
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "<tr>";
            echo "<td >" . $row['nserviceId'] . "</td>";
            echo "<td >" . $row['nuserId'] . "</td>";
            echo "<td >" . $row['nticketNo'] . "</td>";
            echo "<td>" . $row['ccompanyName'] . "</td>";
            echo "<td>" . $row['cconcernPerson'] . "</td>";
            echo "<td>" . $row['ccontactNo'] . "</td>";
            echo "<td>" . $row['cmailId'] . "</td>";
            echo "<td>" . $row['cremark2'] . "</td>";
            echo "<td>" . $row['cproductName'] . "</td>";
            echo "<td>" . $row['nqty'] . "</td>";
            echo "<td>" . $row['nserviceType1'] . "</td>";
            echo "<td>" . $row['nwarrantyType1'] . "</td>";
            echo "<td>" . $row['csnapshot'] . "</td>";

            echo "</tr>";
        }
        echo "</tbody></table>";
        CloseCon($conn);

        ?>
    </div>


    <div id='complain' class="container-large"
    >
        <div class="grid">
            <label>Service Id</label> <input type="text" name="serviceId" class="form-control">
        </div>
        <div class="grid">
            <label>User Id</label> <input type="text" name="userId" class="form-control">
        </div>
        <div class="grid">
            <label>Ticket Number</label> <input type="text" name="ticketNo" class="form-control">
        </div>
        <div class="grid">
            <label>Company Name</label> <input type="text" name="companyName" class="form-control">
        </div>
        <div class="grid">
            <label>Concern Person</label><input type="text" name="concernPerson" class="form-control">
        </div>
        <div class="grid">
            <label>Contact Number</label><input type="text" name="contactNumber" class="form-control">
        </div>
        <div class="grid">
            <label>Address</label> <textarea name="address" class="form-control"></textarea>

        </div>
        <div class="grid">
            <label>PO Number</label> <input type="text" name="ponumber" class="form-control">
        </div>
        <div class="grid">
            <label>Entry Date</label> <input type="date" id="entryDate" name="entryDate" class="form-control">
        </div>
        <div class="grid">
            <label>E-mailId</label> <input type="text" name="emailId" class="form-control">
        </div>
        <div class="grid">
            <label>Remark</label> <input type="text" name="remark" class="form-control">
        </div>
        <div class="grid">
            <label>Snapshot</label> <input type="file" id="snapshot" name="snapshot">
            <div id='filesizealert' style="color: red;display: none">File size must be under 500 kb</div>

        </div>
        <div class="grid">
            <label>Is Available</label> <input type="text" name="isAvailable" class="form-control">
        </div>
        <div class="grid">
            <label>Product Name</label> <input type="text" name="productName" class="form-control">
        </div>
        <div class="grid">
            <label>Quantity</label> <input type="text" name="quantity" class="form-control">
        </div>
        <div class="grid">
            <label>Service Type</label> <input type="text" name="serviceType" class="form-control">
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
            <label>Employee Id</label> <input type="text" class="form-control">
        </div>
        <div class="grid">
            <label>Ticket Number</label> <input type="text" class="form-control">
        </div>
        <div class="grid">
            <label>Record Manager</label><input type="text" class="form-control">
        </div>
        <div class="grid">
            <label>Service Type 2</label><input type="text" class="form-control">
        </div>
        <div class="grid">
            <label>Expiry Date</label> <input type="date" class="form-control">
        </div>
        <div class="grid">
            <label>Payment Mode</label> <input type="text" class="form-control">
        </div>
        <div class="grid">
            <label>Remark 2</label> <input type="text" class="form-control">
        </div>
        <div class="grid">
            <label>Exp Price</label> <input type="text" class="form-control">
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
            <label>Material Rec Date</label><input type="date" class="form-control">
        </div>
        <div class="grid">
            <label>Attendant By</label> <input type="text" class="form-control">
        </div>
        <div class="grid">
            <label>Site Attend Date</label> <input type="date" class="form-control">
        </div>
        <div class="grid">
            <label>Complain Status</label> <input type="text" class="form-control">
        </div>
    </div>
    <div id="result" class="container-large" >
        <div class="grid">
            <label>Employee Id</label> <input type="text" class="form-control">
        </div>
        <div class="grid">
            <label>Ticket Number</label> <input type="text" class="form-control">
        </div>
        <div class="grid">
            <label>Material Received</label><input type="text" class="form-control">
        </div>
        <div class="grid">
            <label>Recieve Quantity</label> <input type="text" class="form-control">
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
            <label>Fault Description</label><input type="text" class="form-control">
        </div>
        <div class="grid">
            <label>Completion Date</label> <input type="date" class="form-control">
        </div>
        <div class="grid">
            <label>Remark 3</label> <input type="text" class="form-control">
        </div>
        <div class="grid">
            <label>Billing Amount</label> <input type="text" class="form-control">
        </div>


    </div>
    <div id="remarks" class="container-large" >
        <div class="grid">
            <label>Rating</label><input type="text" class="form-control">
        </div>
        <div class="grid">
            <label>Remark By Customer</label><input type="text" class="form-control">
        </div>
    </div>

    <input type="submit" name="submit" value="Submit">


</form>
<!--<button id="Add" class="btn btn-primary">Add Product</button>-->
<!--<button id="Remove" class="btn btn-primary">Remove Product</button>-->
<!--<div id="textboxDiv"></div>-->
</body>
<script>
    var $showDivInCaseCustomer = <?php echo json_encode($showDivInCaseCustomer); ?>;
    function openPage(pageName, elmnt, color,ntype) {
        var ntype=<?php echo json_encode($ntype); ?>;

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



        if ((pageName=='complain' && ntype=='3') || (pageName=='remarks' && ntype=='3' ) || pageName=='myComplains'){
            document.getElementById(pageName).style.display = "block";
            document.getElementById('action').style.pointerEvents='none';
            document.getElementById('result').style.pointerEvents='none';
            document.getElementById('complain').style.pointerEvents='auto';
            document.getElementById('remarks').style.pointerEvents='auto';
        }
        else if((pageName=='complain' && ntype=='2') || (pageName=='remarks' && ntype=='2') ){
            document.getElementById(pageName).style.display = "block";
            document.getElementById('complain').style.pointerEvents='none';
            document.getElementById('remarks').style.pointerEvents='none';
            document.getElementById('action').style.pointerEvents='auto';
            document.getElementById('result').style.pointerEvents='auto';
        }
        else if((pageName=='action' && ntype=='3') || (pageName=='result' && ntype=='3')){
            document.getElementById(pageName).style.display = "block";
            document.getElementById('action').style.pointerEvents='none';
            document.getElementById('result').style.pointerEvents='none';
            document.getElementById('complain').style.pointerEvents='auto';
            document.getElementById('remarks').style.pointerEvents='auto';
        }else if((pageName=='action' && ntype=='2') || (pageName=='result' && ntype=='2')){
            document.getElementById(pageName).style.display = "block";
            document.getElementById('complain').style.pointerEvents='none';
            document.getElementById('remarks').style.pointerEvents='none';
            document.getElementById('action').style.pointerEvents='auto';
            document.getElementById('result').style.pointerEvents='auto';
        }
        elmnt.style.backgroundColor = color;
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


        $("#Add").on("click", function () {
            $("#textboxDiv").append("<div><br><input type='text' /><br></div>");
        });
        $("#Remove").on("click", function () {
            $("#textboxDiv").children().last().remove();
        });
    });
</script>
</html>



