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
<h1>Segment</h1>
<div class="container">
    <a style="float:right;margin-left: 15px;" href="../dashboard.php"><i class="fa fa-home fa-2x"></i></a>
    <a style="float:right" href="#segment_modal" data-toggle="modal" id='add' data-id="1"><i class="fa fa-plus fa-2x"
                                                                                                        aria-hidden="true"></i></a>
</div>

<?php
session_start();
include '../db_connection.php';

$conn = OpenCon();
$sql = "SELECT *
        FROM tbl_segment 
        WHERE isAvailable=1;";
$retval = mysqli_query($conn, $sql);
echo "<table id='segmentTable'  name='segmentTable' >
            <thead> 
            <tr>
            <th style='display:none;'>INTERNAL ID</th>
            <th style='display:none;'>SEGMENT ID</th>
            <th>VIEW</th>
            <th>Update</th>
            <th>Segment Name</th>
             <th>Delete</th>
            </tr>
            </thead>
                   <tbody>
            ";
while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
    echo "<tr>";
    echo "<td style='display:none;'>" . $row['ninternal_id'] . "</td>";
    echo "<td style='display:none;'>" . $row['nsegment_id'] . "</td>";
    echo "<td ><a class='opendetails'><i class='fa fa-eye fa-2x'></i></a></td>";
    echo "<td ><a  href='#segment_modal' data-toggle='modal' class='updateClass' data-id='2'><i class='fa fa-edit fa-2x'></i></a></td>";
    echo "<td class='opendetails'>" . $row['csegment_name'] . "</td>";
    echo "<td class='action-delete'><i class='fa fa-trash fa-2x' style='color:#4caf50;'</i></td>";
    echo "</tr>";
}
echo "</tbody></table>";
CloseCon($conn);
?>
<script>
    function reset() {
        document.getElementById("segmentForm").reset();

    }
    $(document).ready(function () {

        $(document).on('click', '#add', function () {
            document.getElementById("segmentForm").reset();

            var saveOrUpdate = $(this).data('id');
            $(".modal-body #saveOrUpdate").val(saveOrUpdate);
        });
        // Setup - add a text input to each footer cell
        $('#segmentTable thead tr').clone(true).appendTo('#segmentTable thead');
        $('#segmentTable thead tr:eq(1) th').each(function (i) {
            var title = $(this).text();
            if (i != 5 && i != 2 && i!=3) {

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


        $('#segmentTable tbody').on('click', '.updateClass', function () {

            var saveOrUpdate = $(this).data('id');
            var id_toUpdate = table.row($(this).parents('tr').first()).data()[0];
            $(".modal-body #saveOrUpdate").val(saveOrUpdate);

            $.ajax({
                url: "../utils/saveSegmentData.php",
                type: "POST",
                data: {
                    id_toUpdate: id_toUpdate,
                    saveOrUpdate: saveOrUpdate
                },
                cache: false,
                success: function (row_datas) {
                    $.each(JSON.parse(row_datas), function (idx, row_data) {
                        $(".modal-body #internal_id").val(row_data.ninternal_id);
                        $(".modal-body #segmentId").val(row_data.nsegment_id);
                        $(".modal-body #segmentName").val(row_data.csegment_name);
                        $(".modal-body #saveOrUpdate").val(row_data.saveOrUpdate);
                    });
                }
            });

        });

        $('#segmentTable').on('click', '.action-delete', function () {
            var result = confirm("Are you sure you want to delete?");
            if (result){
                var id_toDelete = table.row($(this).parents('tr').first()).data()[0];
                // alert(id_toDelete);
                $.ajax({
                    async: true,
                    url: "../utils/saveSegmentData.php",
                    type: "POST",

                    data: {
                        id_toDelete: id_toDelete
                    },
                    cache: false,
                    success: function (result) {
                        window.location.reload();
                    }
                });
            }

        });

        $('#segmentTable tbody').on('click', '.opendetails', function () {
            var data = table.row($(this).parents('tr').first()).data()[0];
            var segment_id_forOrgGroup=data;

            $('.modal-body').load('../utils/segment_org_group.php?id='+segment_id_forOrgGroup,function(){
                $('#segment_organisation_group_modal').modal({show:true});
            });
        } );


        $('.modal').on('hidden.bs.modal', function(e)
        {
            $(this).find('segmentForm').trigger('reset');
        }) ;
        $('#segment_organisation_group_modal').on('hidden.bs.modal', function () {
            location.reload();
        })

    });

</script>

    <div class="modal fade" id="segment_organisation_group_modal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
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



<form id="segmentForm" method="post" action="../utils/saveSegmentData.php">
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

                        <input type="hidden" name="internal_id" id="internal_id" class="form-control"
                               maxlength="50" required/>

                        <tr>
                            <td>Segment Code</td>
                            <td>
                                <input type="text" name="segmentId" id="segmentId" class="form-control"
                                       maxlength="50" required/>
                            </td>
                        </tr>

                        <tr>
                            <td>Segment Name</td>
                            <td>
                                <input type="text" name="segmentName" id="segmentName" class="form-control" maxlength="50"
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

