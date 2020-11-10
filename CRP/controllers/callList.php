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
<h1>Call List</h1>
<div class="container">
    <a style="float:right;margin-left: 15px;" href="../dashboard.php"><i class="fa fa-home fa-2x"></i></a>
    <a style="float:right" href="#organisation_modal" data-toggle="modal" id='add' data-id="1"><i class="fa fa-plus fa-2x"
                                                                                                  aria-hidden="true"></i></a>
</div>

<?php
include '../db_connection.php';

$conn = OpenCon();
$sql = "SELECT * from tbl_callList where isAvailable=1;";
$retval = mysqli_query($conn, $sql);
echo "<table id='callListTable'  name='callListTable' >
            <thead> 
            <tr>
            <th style='display:none;'>ID</th>
            <th>Update</th>
            <th>Date</th>
            <th>Phone Number</th>
            <th>Organisation Name</th>
            <th>Purpose</th>
            <th>Brief Talk</th>
            <th>Next Date</th>
            <th>Delete</th>
            </tr>
            </thead>
                   <tbody>
            ";
while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
    echo "<tr>";
    echo "<td style='display:none;'>" . $row['ncall_list_id'] . "</td>";
    echo "<td ><a  href='#call_list_modal' data-toggle='modal' class='updateClass' data-id='2'><i class='fa fa-edit fa-2x'></i></a></td>";
    echo "<td>" . $row['ddate'] . "</td>";
    echo "<td>" . $row['cphone_number'] . "</td>";
    echo "<td>" . $row['corg_name'] . "</td>";
    echo "<td>" . $row['cpurpose'] . "</td>";
    echo "<td>" . $row['cbriefTalk'] . "</td>";
    echo "<td>" . $row['dnext_date'] . "</td>";


    echo "<td class='action-delete'><i class='fa fa-trash fa-2x' style='color:#4caf50;'</i></td>";
    echo "</tr>";
}
echo "</tbody></table>";
CloseCon($conn);
?>
<script>

    $(document).ready(function () {

        $(document).on('click', '#add', function () {
            document.getElementById("callListForm").reset();

            var saveOrUpdate = $(this).data('id');
            $(".modal-body #saveOrUpdate").val(saveOrUpdate);
        });
        // Setup - add a text input to each footer cell
        $('#callListTable thead tr').clone(true).appendTo('#callListTable thead');
        $('#callListTable thead tr:eq(1) th').each(function (i) {
            var title = $(this).text();
            if (i != 10 && i != 1) {
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

        var table = $('#callListTable').DataTable({
                orderCellsTop: true,
                "dom": 'lrtip',
            }
        );


        $('#callListTable tbody').on('click', '.updateClass', function () {
            var saveOrUpdate = $(this).data('id');
            var id_toUpdate = table.row($(this).parents('tr').first()).data()[0];
            $(".modal-body #saveOrUpdate").val(saveOrUpdate);

            $.ajax({
                url: "../utils/saveOrganisationData.php",
                type: "POST",
                data: {
                    id_toUpdate: id_toUpdate,
                    saveOrUpdate: saveOrUpdate
                },
                cache: false,
                success: function (row_datas) {
                    $.each(JSON.parse(row_datas), function (idx, row_data) {
                    });
                }
            });

        });

        $('#callListTable').on('click', '.action-delete', function () {
            var id_toDelete = table.row($(this).parents('tr').first()).data()[0];
            alert(id_toDelete);
            $.ajax({
                async: true,
                url: "../utils/saveOrganisationData.php",
                type: "POST",

                data: {
                    id_toDelete: id_toDelete
                },
                cache: false,
                success: function (result) {
                    window.location.reload();
                }
            });
        });

        $('.modal').on('hidden.bs.modal', function(e)
        {
              $(this).find('organisationForm').trigger('reset');
        }) ;

    });

</script>
<form id="callListForm" method="post" action="../utils/saveCallListData.php" >
    <div class="modal fade" id="call_list_modal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
        <div class="modal-dialog" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Call List Information</h4>
                </div>
                <div class="modal-body">
                    <table>

                        <input type="hidden" name="saveOrUpdate" id="saveOrUpdate" class="form-control"
                               maxlength="50" required/>

                        <tr>
                            <td>Call List Code</td>
                            <td>
                                <input type="text" name="callListId" id="callListId" class="form-control"
                                       maxlength="50" required/>
                            </td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td>
                                <input type="date" name="date" id="date" class="form-control" maxlength="50"
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

INSERT INTO `tbl_calllist`(`nid`, `ncall_list_id`, `ddate`, `cphone_number`, `cperson_name`, `corg_name`, `cpurpose`,
`cbriefTalk`, `dnext_date`, `isActive`, `isAvailable`, `dcreated_date`, `dupdated_date`)
VALUES (1,1,now(),'1234','Peter','A','Purpose','BriefTalk',
now(),1,1,now(),now())