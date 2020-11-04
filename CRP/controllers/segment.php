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
<h1>Segment<htm>
<?php
include '../db_connection.php';

$conn = OpenCon();
$sql = "SELECT * FROM tbl_segment where isAvailable=1";
$retval = mysqli_query($conn, $sql);
echo "<table id='segmentTable'  name='segmentTable' >
<thead> 
<tr>
<th style='display:none;'>ID</th>
<th>Update</th>
<th>Segment's Name</th>
<th>Delete</th>
</tr>
</thead>
	   <tbody>
";
while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
    echo "<tr>";
    echo "<td style='display:none;'>" . $row['nid'] . "</td>";
    echo "<td ><a  href='#segment_modal' data-toggle='modal' class='updateClass' data-id='2'><i class='fa fa-edit'></i></a></td>";

    echo "<td>" . $row['csegment_name'] . "</td>";
    echo "<td class='action-view'><i class='fa fa-trash fa-2x' style='color:#4caf50;'</i></td>";
    echo "</tr>";
}
echo "</tbody></table>";
CloseCon($conn);
?>
        <script>

            $(document).ready(function () {
                // Setup - add a text input to each footer cell
                $('#segmentTable thead tr').clone(true).appendTo('#segmentTable thead');
                $('#segmentTable thead tr:eq(1) th').each(function (i) {
                    var title = $(this).text();
                    if (i != 3 && i != 1) {
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

                var table = $('#segmentTable').DataTable({
                        orderCellsTop: true,
                        "dom": 'lrtip',
                    }
                );


            });

            </script>
        <form id="segmentForm" method="post" >
            <div class="modal fade" id="segment_modal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
                <div class="modal-dialog" role="dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">SEGMENT INFORMATION</h4>
                        </div>
                        <div class="modal-body">
                            <table>
                                <input type="hidden" name="saveOrUpdate" id="saveOrUpdate" class="form-control"
                                       maxlength="50" required/>
                                <input type="hidden" name="segmentId" id="segmentId" class="form-control"
                                       maxlength="50" required/>

                                <tr>
                                    <td>Segment&#39;s Name</td>
                                    <td>
                                        <input type="text" name="name" id="name" class="form-control" maxlength="50"
                                               required/>
                                    </td>
                                </tr>

                                </table>
                        </div>
                        <div class="modal-footer">
                            <i class="fa fa-refresh fa-spin"  id="reset" onclick="reset()" style="font-size:24px"></i>
                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                            <button type="submit" id="submitData" name="submitData" class="btn btn-primary">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
</html>

