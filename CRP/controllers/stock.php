<html xmlns="http://www.w3.org/1999/html">
<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/theme.css">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>
<form id="showButton" method="post" action="../utils/fetchStock.php" onsubmit="$('#loading').show();">
    <input class="btn btn-primary" name="fetchStockData" type="submit" value="Fetch Data">
    <a style="float:right;margin-left: 15px;" href="../dashboard.php"><i class="fa fa-home fa-2x"></i></a>

    <div id="loading" style="display:none">
    <div class="spinner-grow text-muted"></div>
    <div class="spinner-grow text-primary"></div>
    <div class="spinner-grow text-success"></div>
    <div class="spinner-grow text-info"></div>
    <div class="spinner-grow text-warning"></div>
    <div class="spinner-grow text-danger"></div>
    <div class="spinner-grow text-secondary"></div>
    <div class="spinner-grow text-dark"></div>
    <div class="spinner-grow text-light"></div>
      </div>
</form>
<form id="stockForm">
    <?php
    include '../mssql_connection.php';
    include '../db_connection.php';
    session_start();
    $division_of_logged_in_user=$_SESSION['divison_id'];
    $conn=OpenCon();
    $sql="Select nitem_id,s.ndivision_id,cdivision_name,calternate_code,citem_name,nfactory_quantity,s.dupdated_date
    from tbl_stock  AS s
    JOIN tbl_division As d 
    ON s.ndivision_id=d.ndivision_id
    where s.isAvailable=1 AND s.ndivision_id=$division_of_logged_in_user";
    $result=mysqli_query($conn,$sql);

echo "<table id='stockTable'  name='stockTable' >
<thead> 
<tr>
<th style='display:none;'>ITEM CODE</th>
<th>VIEW</th>
<th>DIVISION</th>	
<th>Alternate Code</th>
<th>Item name</th>
<th>Factory Quantity</th>
<th>Updated Date</th>
</tr>
</thead> 
<tbody> ";
    while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
        echo "<tr>";
        echo "<td style='display:none;'>" . $row['nitem_id'] . "</td>";
        echo "<td ><a  href='#my_modal' data-toggle='modal' class='identifyingClass'><i class='fa fa-eye fa-2x'></i></a></td>";

        echo "<td>" . $row['cdivision_name'] . "</td>";
        echo "<td>" . $row['calternate_code'] . "</td>";
        echo "<td>" . $row['citem_name'] . "</td>";
        echo "<td>" . $row['nfactory_quantity'] . "</td>";
        echo "<td>" . $row['dupdated_date'] . "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";

    CloseCon($conn);
    ?>
</form>
<script>

    $(document).ready(function () {

        $('#stockTable thead tr').clone(true).appendTo('#stockTable thead');
        $('#stockTable thead tr:eq(1) th').each(function (i) {
        var title = $(this).text();
        if (i != 1) {
            $(this).html('<input class="form-control" type="text" placeholder="Search ' + title + '" />');
        }
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

    $('#stockTable tbody').on('click', '.identifyingClass', function () {
        var id_toUpdate = table.row($(this).parents('tr').first()).data()[0];

        $.ajax({
            url: "../utils/fetchStock.php",
            type: "POST",
            data: {
                id_toUpdate: id_toUpdate,

            },
            cache: false,
            success: function (row_datas) {
                $.each(JSON.parse(row_datas), function (idx, row_data) {
                    document.getElementById("itemId").innerHTML = row_data.nitem_id;
                    document.getElementById("divisionId").innerHTML = row_data.ndivision_id;
                    document.getElementById("alternateCode").innerHTML = row_data.calternate_code;
                    document.getElementById("itemName").innerHTML = row_data.citem_name;
                    document.getElementById("itemDesc").innerHTML = row_data.titem_description;
                    document.getElementById("updatedDate").innerHTML = row_data.dupdated_date;

                });
            }
        });
    });
    });
</script>
<div class="modal fade" id="my_modal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
    <div class="modal-dialog" role="dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">STOCK INFORMATION</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
               <table>
                   <b><tr><td>ITEM ID</td><td><p name="itemId" id="itemId"/></td></tr></b>
                   <tr><td>DIVISION</td><td><p id="divisionId"></td></tr>
                   <tr><td>ALTERNATE CODE</td><td><p id="alternateCode"></td></tr>
                   <tr><td>ITEM NAME</td><td><p id="itemName"></td></tr>
                   <tr><td>FACTORY QUANTITY</td><td><p id="factoryQty"></td></tr>
                   <tr><td>ITEM DESCRIPTION</td><td><p id="itemDesc"></td></tr>
                   <tr><td>UPDATED DATE</td><td><p id="updatedDate"></td></tr>

               </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
