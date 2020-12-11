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

</head>
<h1>Stock List</h1>
<a style="float:right;margin-left: 15px;" href="../dashboard.php"><i class="fa fa-home fa-2x"></i></a>

<?php
include('../mssql_connection.php');
$conn = OpenCon();
$sql="Select nItemCode,nDivisionID,cAlternateCode,cItemDesc,cItemName,nFacQty,im.cSession 
from tbl_ItemMaster as im
LEFT OUTER JOIN tbl_Item_Qty_Balance as iqb
on im.nUniqueID=iqb.nItemMasterUniqueID AND iqb.Is_Available=1 AND iqb.cSession='2021'
where (im.Is_Available=1 AND im.cSession='2021' )";

$result=sqlsrv_query($conn,$sql);

echo "<table id='stockTable'  name='stockTable' >
<thead> 
<tr>
<th style='display:none;'>ITEM CODE</th>
<th>DIVISION</th>	
<th>Item name </th>
<th>Item Description </th>

<th>Factory Quantity</th>
<th>Alternate Code</th>

</tr>
</thead> 
<tbody> 
";
while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td style='display:none;'>" . $row['nItemCode'] . "</td>";
    echo "<td>" . $row['nDivisionID'] . "</td>";
    echo "<td>" . $row['cItemName'] . "</td>";
    echo "<td>" . $row['cItemDesc'] . "</td>";
    echo "<td>" . $row['nFacQty'] . "</td>";
    echo "<td>" . $row['cAlternateCode'] . "</td>";
    echo "</tr>";
}
echo "</tbody></table>";
CloseCon($conn);
?>
<script>
    $(document).ready(function () {
        $('#stockTable thead tr').clone(true).appendTo('#stockTable thead');
        $('#stockTable thead tr:eq(1) th').each(function (i) {
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
        var table = $('#stockTable').DataTable({
                orderCellsTop: true,
                "dom": 'lrtip',
            }
        );


    });

</script>

</html>
