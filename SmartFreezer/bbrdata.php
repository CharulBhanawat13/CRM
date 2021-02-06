<?php
session_start();
?>
<html>

<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/theme.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/theme.css">
    <link rel="stylesheet" href="../css/sidebar.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

</head>
<body>
<form id='dateForm' method='post'>
    <div style="margin-top: 2%;margin-left: 2%;margin-right: 2%">
    <table>
        <tr>
            <td><div class='input-daterange'>
                    <div  style="width: fit-content" class='col-md-4'>
                        <b>Start Date</b><input type='datetime-local' name='start_date' id='start_date' class='form-control' />
                    </div>
                    <div style="width: fit-content"  class='col-md-4'>
                        <b>End Date</b><input type='datetime-local' name='end_date' id='end_date' class='form-control' />
                    </div>
                </div></td>
            <td>   <div class='col-md-4'>
                    <input type='submit' name='search' id='search' value='Search' class='btn btn-info' />
                </div></td>
            <td> <div class='col-md-4'>
                    <input type='reset' name='reset' onclick='resetDateForm()' value='Reset' class='btn btn-info' />
                </div></td>
            <td><div style="float: right;font-size: x-large">
                    <b><?php   echo "Welcome " .$_SESSION['username']?></b>

                </div></td>
        <tr><td><br></td></tr>

        </tr>
    </table>

</form>

<?php

if(!empty($_GET['serial_no']) || !(is_null($_GET['serial_no']))){
 require ('db_connection.php');
$serial_no=$_GET['serial_no'];

 $conn = OpenCon();
$sql = "SELECT *
FROM bbr_data
WHERE Serial_no='$serial_no'";
    if (isset($_POST['search'])){
        require_once('utils/DateFilter.php');
            $sql=DateFilter::prepareQuery('date',$sql);
    }
    $sql .= " ORDER BY date DESC";


$retval = mysqli_query($conn, $sql);
echo "<table  id='productTable'  name='productTable' >
     <thead style='background-color: #967adc;color: white'> 
            <tr>
                <th style='display: none'>PRODUCT ID</th>
                <th>SN</th>
                <th>BB ID</th>  
                <th>Blood Bank</th>
                <th>Prod ID</th>  
                <th>Product Name</th>
                <th>Time</th>
                <th>Serial No.</th>
                <th>Max Tem(deg C)</th>
                <th>Min Temp(deg C)</th>
                <th>Temparature</th>
                <th>Temp status</th>
                <th>Compressor</th>
                <th>Door</th>
                <th>Chamber light</th>
                <th>Blower</th>
                <th>Defrost status</th>
                <th>Alarm</th>
                <th>SMS</th>
                <th>User No.</th>
                <th>User Id</th>
                
                </tr>
            </thead>
    <tbody>
    ";
$count=1;
    while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
        echo "<tr>";
        echo "<td style='display: none'>".$row['ProductID']."</td>";
        echo "<td>" . $count++ . "</td>";
        echo "<td>" . $row['BloodBankID'] . "</td>";
        echo "<td>" . $row['Blood_bank'] . "</td>";
        echo "<td>" . $row['ProductID'] . "</td>";
        echo "<td>" . $row['Product_name'] . "</td>";
        echo "<td style='text-align: center'>" . $row['date']. "</td>";
        echo "<td style='text-align: center'>" . $row['Serial_no']. "</td>";
        echo "<td style='text-align: center'>" . $row['SET_high_temp'] . "</td>";
        echo "<td style='text-align: center'>" . $row['SET_low_temp'] . "</td>";
        echo "<td style='text-align: center'>" . $row['Temperature'] . "</td>";
        echo "<td style='text-align: center'>" . $row['Temperature_status'] . "</td>";
        echo "<td style='text-align: center'>" . $row['Compressor'] . "</td>";
        echo "<td style='text-align: center'>" . $row['Door'] . "</td>";
        echo "<td style='text-align: center'>" . $row['Chamber_light'] . "</td>";
        echo "<td style='text-align: center'>" . $row['Blower'] . "</td>";
        echo "<td style='text-align: center'>" . $row['defrost_status']. "</td>";
        echo "<td style='text-align: center'>" . $row['Alarm'] . "</td>";
        echo "<td style='text-align: center'>" . $row['SMS'] . "</td>";
        echo "<td style='text-align: center'>" . $row['user_no'] . "</td>";
        echo "<td style='text-align: center'>" . $row['userid'] . "</td>";

        echo "</tr>";
    }
    echo "</tbody></table>";
CloseCon($conn);
}
?>


<script>
    $(document).ready(function () {
        var table = $('#productTable').DataTable({
            dom: 'Bfrtip',
            "scrollX": true,
            buttons: [{
                extend: 'pdf',
                title: 'ProductDetails',
                filename: 'ProductDetails',
                orientation: 'landscape',
                customize: function(doc) {
                    doc.styles.tableHeader.fontSize = 8
                    doc.defaultStyle.fontSize = 8;
                }
            },  {
                extend: 'csv',
                title: 'ProductDetails',
                filename: 'ProductDetails'
            }, {
                extend: 'copy'
            } ,{
                extend: 'print',
                filename: 'ProductDetails'
            }
            ],
                "ordering": true
            }
        );


         });
</script>
</div>
</body>
</html>
