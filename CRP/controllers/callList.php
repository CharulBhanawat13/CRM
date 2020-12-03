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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<h1>Call List</h1>
<div class="container">
    <a style="float:right;margin-left: 15px;" href="../dashboard.php"><i class="fa fa-home fa-2x"></i></a>
    <a style="float:right" href="#call_list_modal" data-toggle="modal" id='add' data-id="1"><i class="fa fa-plus fa-2x"
                                                                                                  aria-hidden="true"></i></a>
</div>

<?php
include '../db_connection.php';
require_once('../utils/ServiceLayer.php');


$conn = OpenCon();
$permissionRoleQuery=ServiceLayer::preparePermissionRoleQuery();

$sql = "SELECT c.ninternal_id,c.ncall_list_id,c.ddate,c.cphoneNumber,c.norg_id,c.npurpose_id,c.tbriefTalk,c.dnext_date,c.isAvailable,o.corg_name,p.cpurpose_name
 from tbl_callList As c
JOIN tbl_organisation AS o
ON c.norg_id=o.norg_id
JOIN tbl_purpose AS p
ON c.npurpose_id=p.npurpose_id 
where c.isAvailable=1 AND c.nlogged_in_user_id IN (".$permissionRoleQuery.")";
if (isset($_POST['search'])){
    require_once('../utils/DateFilter.php');
   if(isset($_POST['nextDateCheckbox'])){
        $sql=DateFilter::prepareQuery('c.dnext_date',$sql);

    }else{
        $sql=DateFilter::prepareQuery('c.ddate',$sql);
    }
}

$retval = mysqli_query($conn, $sql);


echo "
<form id='dateForm' method='post'>
<table>
<tr>
        <td><input type='checkbox' id='nextDateCheckbox' name='nextDateCheckbox' unchecked> <b>Next Date</b></td>
        <td><div class='input-daterange'>
            <div class='col-md-4'>
                <b>Start Date</b><input type='date' name='start_date' id='start_date' class='form-control' />
            </div>
            <div class='col-md-4'>
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
    </form>";

echo "<table id='callListTable'  name='callListTable' >
      
            <thead> 
            <tr>
            <th style='display:none;'>INTERNAL ID</th>
            <th style='display:none;'>CALL LIST ID</th>

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
    echo "<td style='display:none;'>" . $row['ninternal_id'] . "</td>";
    echo "<td style='display:none;'>" . $row['ncall_list_id'] . "</td>";
    echo "<td ><a  href='#call_list_modal' data-toggle='modal' class='updateClass' data-id='2'><i class='fa fa-edit fa-2x'></i></a></td>";
    echo "<td>" . date("d-m-Y", strtotime($row['ddate']) )  . "</td>";
    echo "<td>" . $row['cphoneNumber'] . "</td>";
    echo "<td>" . $row['corg_name'] . "</td>";
    echo "<td>" . $row['cpurpose_name'] . "</td>";
    echo "<td>" . $row['tbriefTalk'] . "</td>";
    echo "<td>" . date("d-m-Y", strtotime($row['dnext_date'])) . "</td>";
    echo "<td class='action-delete'><i class='fa fa-trash fa-2x' style='color:#4caf50;'</i></td>";
    echo "</tr>";
}
echo "</tbody></table>";
CloseCon($conn);
?>
<script>
    function resetDateForm(){
        location.reload();

    }
    function reset() {
        document.getElementById("callListForm").reset();
    }
    $(document).ready(function () {
        window.history.replaceState('','',window.location.href)


        $(document).on('click', '#add', function () {
            document.getElementById("callListForm").reset();

            var saveOrUpdate = $(this).data('id');
            $(".modal-body #saveOrUpdate").val(saveOrUpdate);
        });
        // Setup - add a text input to each footer cell
        $('#callListTable thead tr').clone(true).appendTo('#callListTable thead');
        $('#callListTable thead tr:eq(1) th').each(function (i) {
            var title = $(this).text();
            if (i != 9 && i != 2) {
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
        $('.input-daterange').datepicker({
            todayBtn:'linked',
            format: "yyyy-mm-dd",
            autoclose: true
        });
        $('#callListTable tbody').on('click', '.updateClass', function () {
            var saveOrUpdate = $(this).data('id');
            var id_toUpdate = table.row($(this).parents('tr').first()).data()[0];
            $(".modal-body #saveOrUpdate").val(saveOrUpdate);

            $.ajax({
                url: "../utils/saveCallListData.php",
                type: "POST",
                data: {
                    id_toUpdate: id_toUpdate,
                    saveOrUpdate: saveOrUpdate
                },
                cache: false,
                success: function (row_datas) {
                    $.each(JSON.parse(row_datas), function (idx, row_data) {
                        $(".modal-body #internal_id").val(row_data.ninternal_id);

                        $(".modal-body #callListId").val(row_data.ncall_list_id);


                        $(".modal-body #date").val(row_data.ddate);
                        $(".modal-body #phoneNumber").val(row_data.cphoneNumber);
                        $(".modal-body #person-dropdown").val(row_data.nperson_id);
                        $(".modal-body #organisation-dropdown").val(row_data.norg_id);
                        $(".modal-body #purpose-dropdown").val(row_data.npurpose_id);
                        $(".modal-body #briefTalk").val(row_data.tbriefTalk);
                        $(".modal-body #nextDate").val(row_data.dnext_date);

                    });
                }
            });
        });
        $('#callListTable').on('click', '.action-delete', function () {
            var id_toDelete = table.row($(this).parents('tr').first()).data()[0];
            alert(id_toDelete);
            $.ajax({
                async: true,
                url: "../utils/saveCallListData.php",
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
                        <input type="hidden" name="internal_id" id="internal_id" class="form-control"
                               maxlength="50" required/>
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
                        <tr>
                            <td>Phone Number</td>
                            <td>
                                <input type="text" name="phoneNumber" id="phoneNumber" class="form-control" maxlength="50"
                                       required/>
                            </td>
                        </tr>
                        <tr>
                            <td>Person Name</td>
                            <td>
                                <select class="form-control" name="personId" id="person-dropdown" required>
                                    <option value="">Select Person</option>
                                    <?php
                                    require_once "../db_connection.php";
                                    $conn = OpenCon();

                                    $result = mysqli_query($conn, "SELECT * FROM tbl_contactperson");
                                    while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                        <option value="<?php echo $row['ncontact_person_id']; ?>"><?php echo $row["cperson_name"]; ?></option>
                                        <?php
                                    }
                                    CloseCon($conn);
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Organisation Name</td>
                            <td>
                                <select class="form-control" name="organisation" id="organisation-dropdown" required>
                                    <option value="">Select Organisation</option>
                                    <?php
                                    require_once "../db_connection.php";
                                    $conn = OpenCon();

                                    $result = mysqli_query($conn, "SELECT * FROM tbl_organisation");
                                    while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                        <option value="<?php echo $row['norg_id']; ?>"><?php echo $row["corg_name"]; ?></option>
                                        <?php
                                    }
                                    CloseCon($conn);
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Purpose Name</td>
                            <td>
                                <select class="form-control" name="purpose" id="purpose-dropdown" required>
                                    <option value="">Select Purpose</option>
                                    <?php
                                    require_once "../db_connection.php";
                                    $conn = OpenCon();

                                    $result = mysqli_query($conn, "SELECT * FROM tbl_purpose");
                                    while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                        <option value="<?php echo $row['npurpose_id']; ?>"><?php echo $row["cpurpose_name"]; ?></option>
                                        <?php
                                    }
                                    CloseCon($conn);
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Brief Talk</td>
                            <td>
                                <textarea name="briefTalk" id="briefTalk" class="form-control" maxlength="50"
                                       required></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Next Date</td>
                            <td>
                                <input type="date" name="nextDate" id="nextDate" class="form-control" maxlength="50"
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
