<html>
<body>
<form id='dateForm' method='post'>
    <table>
        <tr>
            <td><div class='input-daterange'>
                    <div  style="width: fit-content" class='col-md-4'>
                        <b>Start Date</b><input type='date' name='start_date' id='start_date' class='form-control' />
                    </div>
                    <div style="width: fit-content"  class='col-md-4'>
                        <b>End Date</b><input type='date' name='end_date' id='end_date' class='form-control' />
                    </div>
                </div></td>
            <td>   <div class='col-md-4'>
                    <input type='submit' name='search' id='search' value='Search' class='btn btn-info' />
                </div></td>
            <td> <div class='col-md-4'>
                    <input type='reset' name='reset' onclick='resetDateForm()' value='Reset' class='btn btn-info' />
                </div></td>

        </tr>
    </table>
</form>

<?php
if(!empty($_GET['product_id'])){
include('db_connection.php');
$product_id=(int)$_GET['product_id'];

    function Convert2Bool($value){
        if($value==1)
            return 'True';
        else
            return 'False';
    }

$conn = OpenCon();
$sql = "SELECT *
FROM bbr_data
WHERE ProductID=$product_id";
    if (isset($_POST['search'])){
        require_once('utils/DateFilter.php');
            $sql=DateFilter::prepareQuery('date',$sql);
    }


$retval = mysqli_query($conn, $sql);
echo "<table  id='productTable'  name='productTable' >
     <thead> 
            <tr>
            <th style='display: none'>PRODUCT ID</th>
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
$count=1;
    while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
        echo "<tr>";
        echo "<td style='display: none'>".$row['ProductID']."</td>";
        echo "<td>" . $count++ . "</td>";
        echo "<td>" . $row['BloodBankID'] . "</td>";
        echo "<td>" . $row['Blood_bank'] . "</td>";
        echo "<td>" . $row['ProductID'] . "</td>";
        echo "<td>" . $row['Product_name'] . "</td>";
        echo "<td>" . date('Y-m-d',strtotime($row['date'])) . "</td>";
        echo "<td>" . $row['SET_high_temp'] . "</td>";
        echo "<td>" . $row['SET_low_temp'] . "</td>";
        echo "<td>" . Convert2Bool($row['Temperature_status']) . "</td>";
        echo "<td>" . Convert2Bool($row['Compressor']) . "</td>";
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
}
?>


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
<script>
    $(document).ready(function () {
        var table = $('#productTable').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                extend: 'pdf',
                title: 'ProductDetails',
                filename: 'ProductDetails',
                orientation: 'landscape'
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
                "ordering": false
            }
        );

        $('#productTable thead tr').clone(true).appendTo('#productTable thead');
        $('#productTable thead tr:eq(1) th').each(function (i) {
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
         });
</script>
</body>
</html>
