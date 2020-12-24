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
<h1>Organisation Group</h1>
<div class="container">
    <a style="float:right;margin-left: 15px;" href="../dashboard.php"><i class="fa fa-home fa-2x"></i></a>
    <a style="float:right" href="#organisation_group_modal" data-toggle="modal" id='add' data-id="1"><i class="fa fa-plus fa-2x"
                                                                                                  aria-hidden="true"></i></a>
</div>

<?php
include '../db_connection.php';

$conn = OpenCon();
$sql = "SELECT og.ninternal_id,og.norg_group_id,og.corg_group_name,s.csegment_name,og.isAvailable 
        FROM tbl_organisation_group As og
        Join tbl_segment AS s
        ON og.nsegment_id=s.nsegment_id
        WHERE og.isAvailable=1;";
$retval = mysqli_query($conn, $sql);
echo "<table id='organisationGroupTable'  name='organisationGroupTable' >
            <thead> 
            <tr>
            <th style='display:none;'>INTERNAL ID</th>
            <th style='display:none;'>ORG GROUP ID</th>
            <th>Update</th>
            <th>Organisation Group Name</th>
            <th>Segment Name</th>
             <th>Delete</th>
            </tr>
            </thead>
                   <tbody>
            ";
while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
    echo "<tr>";
    echo "<td style='display:none;'>" . $row['ninternal_id'] . "</td>";
    echo "<td style='display:none;'>" . $row['norg_group_id'] . "</td>";
    echo "<td ><a  href='#organisation_group_modal' data-toggle='modal' class='updateClass' data-id='2'><i class='fa fa-edit fa-2x'></i></a></td>";
    echo "<td>" . $row['corg_group_name'] . "</td>";
    echo "<td>" . $row['csegment_name'] . "</td>";
    echo "<td class='action-delete'><i class='fa fa-trash fa-2x' style='color:#4caf50;'</i></td>";
    echo "</tr>";
}
echo "</tbody></table>";
CloseCon($conn);
?>
<script>
    function reset() {
        document.getElementById("organisationGroupForm").reset();

    }
    $(document).ready(function () {

        $(document).on('click', '#add', function () {
            document.getElementById("organisationGroupForm").reset();

            var saveOrUpdate = $(this).data('id');
            $(".modal-body #saveOrUpdate").val(saveOrUpdate);
        });
        // Setup - add a text input to each footer cell
        $('#organisationGroupTable thead tr').clone(true).appendTo('#organisationGroupTable thead');
        $('#organisationGroupTable thead tr:eq(1) th').each(function (i) {
            var title = $(this).text();
            if (i != 5 && i != 2) {

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

        var table = $('#organisationGroupTable').DataTable({
                orderCellsTop: true,
                "dom": 'lrtip',
            }
        );


        $('#organisationGroupTable tbody').on('click', '.updateClass', function () {
            var saveOrUpdate = $(this).data('id');
            var id_toUpdate = table.row($(this).parents('tr').first()).data()[0];
            $(".modal-body #saveOrUpdate").val(saveOrUpdate);

            $.ajax({
                url: "../utils/saveOrganisationGroupData.php",
                type: "POST",
                data: {
                    id_toUpdate: id_toUpdate,
                    saveOrUpdate: saveOrUpdate
                },
                cache: false,
                success: function (row_datas) {
                    $.each(JSON.parse(row_datas), function (idx, row_data) {
                        $(".modal-body #internal_id").val(row_data.ninternal_id);
                        $(".modal-body #organisationGroupId").val(row_data.norg_group_id);
                        $(".modal-body #organisationGroupName").val(row_data.corg_group_name);
                        $(".modal-body #segment-dropdown").val(row_data.nsegment_id);
                        $(".modal-body #saveOrUpdate").val(row_data.saveOrUpdate);
                    });
                }
            });

        });

        $('#organisationGroupTable').on('click', '.action-delete', function () {
            var result = confirm("Are you sure you want to delete?");
            if (result){
                var id_toDelete = table.row($(this).parents('tr').first()).data()[0];
                // alert(id_toDelete);
                $.ajax({
                    async: true,
                    url: "../utils/saveOrganisationGroupData.php",
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

        $('.modal').on('hidden.bs.modal', function(e)
        {
            $(this).find('organisationGroupForm').trigger('reset');
        }) ;

    });

</script>
<form id="organisationGroupForm" method="post" action="../utils/saveOrganisationGroupData.php" >
    <div class="modal fade" id="organisation_group_modal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
        <div class="modal-dialog" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">ORGANISATION GROUP INFORMATION</h4>
                </div>
                <div class="modal-body">
                    <table>

                        <input type="hidden" name="saveOrUpdate" id="saveOrUpdate" class="form-control"
                               maxlength="50" required/>

                        <input type="hidden" name="internal_id" id="internal_id" class="form-control"
                               maxlength="50" required/>

                        <tr>
                            <td>Organisation Group Code</td>
                            <td>
                                <input type="text" name="organisationGroupId" id="organisationGroupId" class="form-control"
                                       maxlength="50" required/>
                            </td>
                        </tr>
                        <tr>
                            <td>Organisation Group Name</td>
                            <td>
                                <input type="text" name="organisationGroupName" id="organisationGroupName" class="form-control"
                                       maxlength="50" required/>
                            </td>
                        </tr>
                        <tr>
                            <td>Segment</td>
                            <td>
                                <select class="form-control" name="segment" id="segment-dropdown" required>
                                    <option value="">Select Segment</option>
                                    <?php
                                    require_once "../db_connection.php";
                                    $conn = OpenCon();

                                    $result = mysqli_query($conn, "SELECT * FROM tbl_segment");
                                    while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                        <option value="<?php echo $row['nsegment_id']; ?>"><?php echo $row["csegment_name"]; ?></option>
                                        <?php
                                    }
                                    CloseCon($conn);
                                    ?>
                                </select>
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

