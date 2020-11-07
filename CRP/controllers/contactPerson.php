
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
<h1>Contact Person</h1>
<div class="container">
    <a style="float:right;margin-left: 15px;" href="../dashboard.php"><i class="fa fa-home fa-2x"></i></a>
    <a style="float:right" href="#contactPerson_modal" data-toggle="modal" id='add' data-id="1"><i class="fa fa-plus fa-2x"
                                                                                                  aria-hidden="true"></i></a>
</div>

<?php
include '../db_connection.php';

$conn = OpenCon();
$sql = "SELECT * FROM tbl_contactperson where isAvailable=1";
$retval = mysqli_query($conn, $sql);
echo "<table id='contactPersonTable'  name='contactPersonTable' >
            <thead> 
            <tr>
            <th style='display:none;'>ID</th>
            <th>Update</th>
            <th>Person Name</th>
            <th>Department</th>
            <th>Mobile Number</th>
            <th>Phone Number</th>
            <th>Email Id</th>
            <th>Organisation Name</th>
            <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            ";
while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
    echo "<tr>";
    echo "<td style='display:none;'>" . $row['norg_id'] . "</td>";
    echo "<td ><a  href='#contactPerson_modal' data-toggle='modal' class='updateClass' data-id='2'><i class='fa fa-edit fa-2x'></i></a></td>";
    echo "<td>" . $row['cperson_name'] . "</td>";
    echo "<td>" . $row['cdepartment'] . "</td>";
    echo "<td>" . $row['cmobileNumber'] . "</td>";
    echo "<td>" . $row['cphoneNumber'] . "</td>";
    echo "<td>" . $row['cemailId'] . "</td>";
    echo "<td>" . $row['corg_name'] . "</td>";
       echo "<td class='action-delete'><i class='fa fa-trash fa-2x' style='color:#4caf50;'</i></td>";
    echo "</tr>";
}
echo "</tbody></table>";
CloseCon($conn);
?>
<script>

    $(document).ready(function () {

        $(document).on('click', '#add', function () {
            document.getElementById("contactPersonForm").reset();

            var saveOrUpdate = $(this).data('id');
            $(".modal-body #saveOrUpdate").val(saveOrUpdate);
        });
        // Setup - add a text input to each footer cell
        $('#contactPersonTable thead tr').clone(true).appendTo('#contactPersonTable thead');
        $('#contactPersonTable thead tr:eq(1) th').each(function (i) {
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

        var table = $('#contactPersonTable').DataTable({
                orderCellsTop: true,
                "dom": 'lrtip',
            }
        );


        $('#contactPersonTable tbody').on('click', '.updateClass', function () {
            var saveOrUpdate = $(this).data('id');
            var id_toUpdate = table.row($(this).parents('tr').first()).data()[0];
            $(".modal-body #saveOrUpdate").val(saveOrUpdate);

            $.ajax({
                url: "../utils/saveContactPersonData.php",
                type: "POST",
                data: {
                    id_toUpdate: id_toUpdate,
                    saveOrUpdate: saveOrUpdate
                },
                cache: false,
                success: function (row_datas) {
                    $.each(JSON.parse(row_datas), function (idx, row_data) {
                        $(".modal-body #organisationId").val(row_data.nid);
                        $(".modal-body #name").val(row_data.corg_name);
                        $(".modal-body #address").val(row_data.corg_address);
                        $(".modal-body #city-dropdown").val(row_data.corg_city);
                        $(".modal-body #segment-dropdown").val(row_data.norg_segment_id);
                        $(".modal-body #mobileNumber").val(row_data.corg_mobileNumber);
                        $(".modal-body #emailId").val(row_data.corg_emailId);
                        $(".modal-body #saveOrUpdate").val(row_data.saveOrUpdate);
                        $('#state-dropdown').append(`<option value="${row_data.corg_state}" selected>${row_data.corg_state}</option>`);
                        $('#country-dropdown').append(`<option value="${row_data.corg_country}" selected>${row_data.corg_country}</option>`);
                    });
                }
            });

        });

        $('#contactPersonTable').on('click', '.action-delete', function () {
            var id_toDelete = table.row($(this).parents('tr').first()).data()[0];
            alert(id_toDelete);
            $.ajax({
                async: true,
                url: "../utils/saveContactPersonData.php",
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
<form id="contactPersonForm" method="post" action="../utils/saveContactPersonData.php" >
    <div class="modal fade" id="contactPerson_modal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
        <div class="modal-dialog" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Contact Person</h4>
                </div>
                <div class="modal-body">
                    <table>
                        <input type="hidden" name="contactPersonId" id="contactPersonId" class="form-control"
                               maxlength="50" required/>
                        <input type="hidden" name="saveOrUpdate" id="saveOrUpdate" class="form-control"
                               maxlength="50" required/>


                        <tr>
                            <td>Person Name</td>
                            <td>
                                <input type="text" name="name" id="name" class="form-control" maxlength="50"
                                       required/>
                            </td>
                        </tr>

                        <tr>
                            <td>Department</td>
                            <td>
                                <input type="text" name="address" id="address" class="form-control" maxlength="50"
                                       required/>
                            </td>
                        </tr> <tr>
                            <td>Mobile Number</td>
                            <td>
                                <input type="text" name="mobileNumber" id="mobileNumber" class="form-control" maxlength="50"
                                       required/>
                            </td>
                        </tr> <tr>
                            <td>Email Id</td>
                            <td>
                                <input type="text" name="emailId" id="emailId" class="form-control" maxlength="50"
                                       required/>
                            </td>
                        </tr>
                        </tr> <tr>
                            <td>Organisation</td>
                            <td>
                                <select class="form-control" name="segment" id="segment-dropdown" required>
                                    <option value="">Select Organisation</option>
                                    <?php
                                    require_once "../db_connection.php";
                                    $conn = OpenCon();

                                    $result = mysqli_query($conn, "SELECT * FROM tbl_organisation");
                                    while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                        <option value="<?php echo $row['norg_id']; ?>"><?php echo $row["norg_id"]; ?></option>
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

