<?php
session_start();

?>
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
<h5>
    <div style="background-color: #f2f2f2;width: 100%;height: 40px;font-size: large;padding-top:0.5%">
        <b style="margin-left: 40%;color:#5bc0de ">ORGANISATION </b>
        <a style="float:right;margin-left: 10px" href="../logout.php"><i class="fa fa-sign-out" ></i>Logout</a>
        <div style="float: right"> <?php echo "Welcome " .$_SESSION['username'] ; ?></div>
    </div>
</h5><div class="container">
    <a style="float:right;margin-left: 15px;" href="../dashboard.php"><i class="fa fa-home fa-2x"></i></a>
    <a style="float:right" href="#organisation_modal" data-toggle="modal" id='add' data-id="1"><i class="fa fa-plus fa-2x"
                                                                                        aria-hidden="true"></i></a>
</div>

        <?php
        include '../db_connection.php';

        $conn = OpenCon();
        $sql = "SELECT o.ninternal_id,o.norg_id,o.corg_name,o.corg_address,o.corg_city,o.corg_state,o.corg_country,o.corg_mobileNumber,o.corg_emailId,o.norg_group_id,o.isActive,o.isAvailable,og.corg_group_name
                    FROM tbl_organisation AS o 
                    INNER JOIN tbl_organisation_group AS og
                    ON o.norg_group_id = og.ninternal_id 
                    WHERE o.isAvailable=1;";
        $retval = mysqli_query($conn, $sql);
        echo "<table id='organisationTable'  name='organisationTable' >
            <thead> 
            <tr>
            <th style='display:none;'>INTERNAL ID</th>
            <th style='display:none;'>ORG ID</th>
            <th>Update</th>
            <th>Organisation Name</th>
            <th>Address</th>
            <th>City</th>
            <th>State</th>
            <th>Country</th>
            <th>Mobile Number</th>
            <th>Email Id</th>
            <th>Organisation Group</th>
             <th>Delete</th>
            </tr>
            </thead>
                   <tbody>
            ";
        while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
            echo "<tr>";
            echo "<td style='display:none;'>" . $row['ninternal_id'] . "</td>";
            echo "<td style='display:none;'>" . $row['norg_id'] . "</td>";
            echo "<td ><a  href='#organisation_modal' data-toggle='modal' class='updateClass' data-id='2'><i class='fa fa-edit fa-2x'></i></a></td>";
            echo "<td>" . $row['corg_name'] . "</td>";
            echo "<td>" . $row['corg_address'] . "</td>";
            echo "<td>" . $row['corg_city'] . "</td>";
            echo "<td>" . $row['corg_state'] . "</td>";
            echo "<td>" . $row['corg_country'] . "</td>";
            echo "<td>" . $row['corg_mobileNumber'] . "</td>";
            echo "<td>" . $row['corg_emailId'] . "</td>";
            echo "<td>" . $row['corg_group_name'] . "</td>";

            echo "<td class='action-delete'><i class='fa fa-trash fa-2x' style='color:#4caf50;'</i></td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
        CloseCon($conn);
        ?>
        <script>
            function reset() {
                document.getElementById("organisationForm").reset();
                $("#state-dropdown option:selected").remove();
                $("#country-dropdown option:selected").remove();

            }
            $(document).ready(function () {

                $(document).on('click', '#add', function () {
                    document.getElementById("organisationForm").reset();
                    $("#state-dropdown option:selected").remove();
                    $("#country-dropdown option:selected").remove();

                    var saveOrUpdate = $(this).data('id');
                    $(".modal-body #saveOrUpdate").val(saveOrUpdate);
                });
                // Setup - add a text input to each footer cell
                $('#organisationTable thead tr').clone(true).appendTo('#organisationTable thead');
                $('#organisationTable thead tr:eq(1) th').each(function (i) {
                    var title = $(this).text();
                    if (i != 11 && i != 2) {
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

                var table = $('#organisationTable').DataTable({
                        orderCellsTop: true,
                        "dom": 'lrtip',
                    }
                );
                $('#city-dropdown').on('change', function () {
                    var city_name = this.value;
                    $.ajax({
                        async: true,
                        url: "../employee/states-by-cities.php",
                        type: "POST",
                        data: {
                            city_name: city_name
                        },
                        cache: false,
                        success: function (result) {
                            $("#state-dropdown").html(result);


                        }
                    });
                });
                $('#city-dropdown').on('change', function () {
                    var city_name = this.value;
                    $.ajax({
                        async: true,
                        url: "../employee/country-by-state.php",
                        type: "POST",
                        data: {
                            city_name: city_name
                        },
                        cache: false,
                        success: function (result) {
                            $("#country-dropdown").html(result);
                        }
                    });
                });
                $('#organisationTable tbody').on('click', '.updateClass', function () {
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
                                $(".modal-body #internal_id").val(row_data.ninternal_id);

                                $(".modal-body #organisationId").val(row_data.norg_id);
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

                $('#organisationTable').on('click', '.action-delete', function () {
                    var result = confirm("Are you sure you want to delete?");
                    if (result){
                        var id_toDelete = table.row($(this).parents('tr').first()).data()[0];
                       // alert(id_toDelete);
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
                    }

                });

                $('.modal').on('hidden.bs.modal', function(e)
                {
                    $('#state-dropdown option').remove();
                    $('#country-dropdown option').remove()
                    $(this).find('organisationForm').trigger('reset');
                }) ;

            });

        </script>
        <form id="organisationForm" method="post" action="../utils/saveOrganisationData.php" >
            <div class="modal fade" id="organisation_modal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
                <div class="modal-dialog" role="dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">ORGANISATION INFORMATION</h4>
                        </div>
                        <div class="modal-body">
                            <table>

                                <input type="hidden" name="saveOrUpdate" id="saveOrUpdate" class="form-control"
                                       maxlength="50" required/>

                                        <input type="hidden" name="internal_id" id="internal_id" class="form-control"
                                               maxlength="50" required/>

                                <tr>
                                    <td>Organisation Code</td>
                                    <td>
                                        <input type="text" name="organisationId" id="organisationId" class="form-control"
                                               maxlength="50" required/>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Organisation Name</td>
                                    <td>
                                        <input type="text" name="name" id="name" class="form-control" maxlength="50"
                                               required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td>
                                        <select class="form-control" name="city" id="city-dropdown" required>
                                            <option value="">Select City</option>
                                            <?php
                                            require_once "../db_connection.php";
                                            $conn = OpenCon();

                                            $result = mysqli_query($conn, "SELECT * FROM tbl_city_state_country");
                                            while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                                <option value="<?php echo $row['ccity']; ?>"><?php echo $row["ccity"]; ?></option>
                                                <?php
                                            }
                                            CloseCon($conn);
                                            ?>
                                        </select>

                                    </td>
                                </tr>
                                <tr>
                                    <td>State</td>
                                    <td>
                                        <select class="form-control" name="state" id="state-dropdown" required>

                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td>
                                        <select class="form-control" name="country" id="country-dropdown" required>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Organisation Address</td>
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
                                </tr>
                                <tr>
                                    <td>Organisation Group</td>
                                    <td>
                                        <select class="form-control" name="organisationGroup" id="organisationGroup-dropdown" required>
                                            <option value="">Select Organisation Group</option>
                                            <?php
                                            require_once "../db_connection.php";
                                            $conn = OpenCon();

                                            $result = mysqli_query($conn, "SELECT * FROM tbl_organisation_group");
                                            while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                                <option value="<?php echo $row['ninternal_id']; ?>"><?php echo $row["corg_group_name"]; ?></option>
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

