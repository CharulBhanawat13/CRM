<html>
<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/theme.css">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/theme.css">
    <link rel="stylesheet" href="../css/sidebar.css">

</head>
<body style="background-color: #eeeeee">

<div style="position:fixed;background-color: white;width: 100%">
<img style="margin-left: 8%" src="../assests/pepl.jpg" width="100px" height="50px"" >
    <span style="float: right" class="label label-default" id="servertime">Servertime: <?php echo date('d-m-Y H:i:s'); ?></span>

</div>

<div class="sidebar">
    <a href="../dashboard.php"><i class="fa fa-home fa-lg" aria-hidden="true"></i></a>
    <a href="productList.php"><i class="fa fa-list fa-lg" aria-hidden="true"></i></a>
</div>
<h1>Product List</h1>
<div  class="container">
   <a style="float: right;margin-right: 2%" href="../logout.php"><i class="fa fa-sign-out" ></i>Logout</a>

</div>

<script>

</script>
<?php

session_start();
    if ($_SESSION['username'] == '') {
        header("location: index.php");
    }else{
        $username = $_SESSION['username'];
        $bloodBankId=$_SESSION['bloodBankId'];
        $isAdmin=Convert2Bool($_SESSION['isAdmin']);
    }

include '../db_connection.php';

$conn = OpenCon();
if($isAdmin){
    $sql = "SELECT ProductID,BloodBankId,Blood_bank,Product_name,MAX(date) as date,SET_high_temp,SET_low_temp,Temperature_status,
Compressor,Door,Chamber_light,Blower,defrost_status,Alarm,SMS
 FROM bbr_data GROUP BY ProductID;";
}else{
    $sql = "SELECT ProductID,BloodBankId,Blood_bank,Product_name,MAX(date) as date,SET_high_temp,SET_low_temp,Temperature_status,
Compressor,Door,Chamber_light,Blower,defrost_status,Alarm,SMS
 FROM bbr_data where BloodBankID=$bloodBankId
 GROUP BY ProductID;";
}

$count=1;
$retval = mysqli_query($conn, $sql);
echo "<table  style='background-color: white;width: 80%;' id='bbrTable'  name='bbrTable' >
            <thead> 
            <tr>
            <th style='display: none'>PRODUCT ID</th>
            <th>VIEW</th>
            <th>SN</th>
            <th>BB ID</th>  
            <th>Blood Bank</th>
            <th>Prod ID</th>  
            <th>Product Name</th>
            <th>Time</th>
            <th>Max Temp</th>
            <th>Min Temp</th>
            <th>Temp st</th>
            <th>Comp st </th>
            <th>Door st</th>
            <th>Chamber st</th>
            <th>Blower st</th>
            <th>Defrost st</th>
            <th>Alarm</th>
            <th>SMS</th>
            </tr>
            </thead>
                   <tbody>
            ";
while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
    echo "<tr>";
    echo "<td style='display: none'>".$row['ProductID']."</td>";
    echo "<td ><a class='opendetails'><i class='fa fa-eye fa-2x'></i></a></td>";
    echo "<td>" . $count++ . "</td>";
    echo "<td>" . $row['BloodBankId'] . "</td>";

    echo "<td>" . $row['Blood_bank'] . "</td>";
    echo "<td>" . $row['ProductID'] . "</td>";

    echo "<td>" . $row['Product_name'] . "</td>";

    echo "<td>" . date('Y-m-d',strtotime($row['date'])) . "</td>";
    echo "<td>" . $row['SET_high_temp'] . "</td>";
    echo "<td>" . $row['SET_low_temp'] . "</td>";
    echo "<td>" .Convert2Bool($row['Temperature_status']) . "</td>";
    echo "<td>" .Convert2Bool($row['Compressor']) . "</td>";
    echo "<td>" . Convert2Bool($row['Door']) . "</td>";
    echo "<td>" . Convert2Bool($row['Chamber_light']) . "</td>";
    echo "<td>" . Convert2Bool($row['Blower']) . "</td>";
    echo "<td>" . Convert2Bool($row['defrost_status']) . "</td>";
    echo "<td>" . Convert2Bool($row['Alarm']) . "</td>";
    echo "<td>" . Convert2Bool($row['SMS']) . "</td>";
    echo "</tr>";
}
echo "</tbody></table>";
CloseCon($conn);

function Convert2Bool($value){
    if($value==1)
        return 'True';
    else
        return 'False';
}
?>
<script>

    $(document).ready(function () {
        var table = $('#bbrTable').DataTable({
                "dom": 'lrtip',
                "ordering": false

            }
        );
        $('#bbrTable tbody').on('click', '.opendetails', function () {
            var data = table.row($(this).parents('tr').first()).data()[0];
            var product_id=data;
            window.open('../bbrdata.php?product_id='+product_id);

            // $('.modal-body').load('../bbrdata.php?product_id='+product_id,function(){
            //     $('#productDetails_modal').modal({show:true});
            // });
        } );
    });

</script>
<div class="modal fade" id="productDetails_modal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
    <div class="modal-dialog" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>