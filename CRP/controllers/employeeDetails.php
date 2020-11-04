<html>
<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../css/theme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>
<h1>Employee Details Page
    <h1>
        <div class="container">
            <a style="float:right;margin-left: 15px;" href="../dashboard.php"><i class="fa fa-home"></i></a>
            <a style="float:right" href="#my_modal" data-toggle="modal" id='add' data-id="1"><i class="fa fa-plus"
                                                                                                aria-hidden="true"></i></a>

        </div>

        <?php
        include '../db_connection.php';
        session_start();
        if (isset($_SESSION['userType']) && ($_SESSION['username'])) {
            $userType = $_SESSION['userType'];
            $username = $_SESSION['username'];
            $user_id = (int)$_SESSION['user_id'];
        }
        if (isset($_SESSION['name_error'])) {

            $name_error = $_SESSION['name_error'];
            echo "<script>alert('$name_error');</script>";
            unset($_SESSION['name_error']);
        }
        $conn = OpenCon();
        $isAvailable = 1;
        $sql = "(select e.nid,e.cengineer_name,e.caddress,e.ccity,e.cstate,e.ccountry,e.cmobile_number,e.cemail_id,e.ckey_ac_manager,e.isAvailable
from tbl_employeemaster AS e where e.nid=$user_id AND e.isAvailable=$isAvailable) 
union (select e.nid,e.cengineer_name,e.caddress,ccity,e.cstate,e.ccountry,e.cmobile_number,e.cemail_id,e.ckey_ac_manager,e.isAvailable
from tbl_employeemaster AS e where e.nkey_ac_manager_id=$user_id AND e.isAvailable=$isAvailable) 
union 
(select e2.nid,e2.cengineer_name,e2.caddress,e2.ccity,e2.cstate,e2.ccountry,e2.cmobile_number,e2.cemail_id,e2.ckey_ac_manager,e2.isAvailable
from tbl_employeemaster AS e1 
JOIN tbl_employeemaster AS e2 
ON e2.nkey_ac_manager_id=e1.nid 
where e1.nkey_ac_manager_id=$user_id AND e2.isAvailable=$isAvailable) 
union 
(select e3.nid,e3.cengineer_name,e3.caddress,e3.ccity,e3.cstate,e3.ccountry,e3.cmobile_number,e3.cemail_id,e3.ckey_ac_manager,e3.isAvailable
from tbl_employeemaster AS e1 
JOIN tbl_employeemaster AS e2 
ON e2.nkey_ac_manager_id=e1.nid 
JOIN tbl_employeemaster AS e3 
ON e3.nkey_ac_manager_id=e2.nid 
where e1.nkey_ac_manager_id=$user_id AND e3.isAvailable=$isAvailable)
";

        $retval = mysqli_query($conn, $sql);
        echo "<table id='employeeTable'  name='employeeTable' >
<thead> 
<tr>
<th style='display:none;'>ID</th>
<th>Engineer's Name</th>
<th>Engineer's Name</th>	
<th>Address</th>
<th>City</th>
<th>State</th>
<th>Country</th>
<th>Mobile Number</th>
<th>Email Id</th>
<th>Key A/C Manager</th>
<th>Delete</th>
</tr>
</thead>
	   <tbody>
";
        while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
            echo "<tr>";
            echo "<td style='display:none;'>" . $row['nid'] . "</td>";
            echo "<td ><a  href='#my_modal' data-toggle='modal' class='identifyingClass' data-id='2'><i class='fa fa-edit'></i></a></td>";
            echo "<td>" . $row['cengineer_name'] . "</td>";
            echo "<td>" . $row['caddress'] . "</td>";
            echo "<td>" . $row['ccity'] . "</td>";
            echo "<td>" . $row['cstate'] . "</td>";
            echo "<td>" . $row['ccountry'] . "</td>";
            echo "<td>" . $row['cmobile_number'] . "</td>";
            echo "<td>" . $row['cemail_id'] . "</td>";
            echo "<td>" . $row['ckey_ac_manager'] . "</td>";
            echo "<td class='action-view'><i class='fa fa-trash fa-2x' style='color:#4caf50;'</i></td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
        CloseCon($conn);
        ?>
        <script>

            $(document).ready(function () {

                $(document).on('click', '#add', function () {
                    var saveOrUpdate = $(this).data('id');
                    $(".modal-body #saveOrUpdate").val(saveOrUpdate);

                })

                // Setup - add a text input to each footer cell
                $('#employeeTable thead tr').clone(true).appendTo('#employeeTable thead');
                $('#employeeTable thead tr:eq(1) th').each(function (i) {
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

                $('#userType-dropdown').on('change', function () {
                    var user_id = this.value;
                    $.ajax({
                        async: true,
                        url: "../employee/keyacmanager-by-userType.php",
                        type: "POST",
                        data: {
                            user_id: user_id
                        },
                        cache: false,
                        success: function (result) {
                            $("#keyAcManager-dropdown").html(result);
                        }
                    });
                });


                $('#employeeTable tbody').on('click', '.identifyingClass', function () {
                    var saveOrUpdate = $(this).data('id');
                    var id_toUpdate = table.row($(this).parents('tr').first()).data()[0];
                    $(".modal-body #saveOrUpdate").val(saveOrUpdate);


                    $.ajax({
                        url: "../employee/saveEmployeeData.php",
                        type: "POST",
                        data: {
                            id_toUpdate: id_toUpdate,
                            saveOrUpdate: saveOrUpdate
                        },
                        cache: false,
                        success: function (row_datas) {
                            $.each(JSON.parse(row_datas), function (idx, row_data) {
                                $(".modal-body #employeeId").val(row_data.nid);
                                $(".modal-body #name").val(row_data.cengineer_name);
                                $(".modal-body #address").val(row_data.caddress);
                                $(".modal-body #city-dropdown").val(row_data.ccity);
                                $(".modal-body #state-dropdown").val(row_data.cstate);
                                $(".modal-body #country-dropdown").val(row_data.ccountry);
                                $(".modal-body #mobileNumber").val(row_data.cmobile_number);
                                $(".modal-body #altMobileNumber").val(row_data.calt_mobile_number);
                                $(".modal-body #email").val(row_data.cemail_id);
                                $(".modal-body #userType-dropdown").val(row_data.cuser_type);
                                $(".modal-body #keyAcManager-dropdown").val(row_data.ckeyAcManager);
                                $(".modal-body #username").val(row_data.cuser_name);
                                $(".modal-body #password").val(row_data.cpassword);
                                $(".modal-body #saveOrUpdate").val(row_data.saveOrUpdate);


                            });
                        }
                    });

                });

                var table = $('#employeeTable').DataTable({
                        orderCellsTop: true,
                        "dom": 'lrtip',
                    }
                );

                $('#employeeTable').on('click', '.action-view', function () {
                    var id_toDelete = table.row($(this).parents('tr').first()).data()[0];
                    alert(id_toDelete);
                    $.ajax({
                        async: true,
                        url: "../employee/saveEmployeeData.php",
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

            });


        </script>
        <form id="employeeForm" method="post" action="../employee/saveEmployeeData.php">
            <div class="modal fade" id="my_modal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
                <div class="modal-dialog" role="dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">EMPLOYEE INFORMATION</h4>
                        </div>
                        <div class="modal-body">
                            <table>
                                <input type="hidden" name="saveOrUpdate" id="saveOrUpdate" class="form-control"
                                       maxlength="50" required/>
                                <input type="hidden" name="employeeId" id="employeeId" class="form-control"
                                       maxlength="50" required/>

                                <tr>
                                    <td>Engineer&#39;s Name</td>
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
                                    <td>Address</td>
                                    <td>
                                        <input type="text" name="address" id="address" class="form-control" required/>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Mobile Number</td>
                                    <td>
                                        <input type="text" name="mobilenumber" id="mobileNumber" maxlength="10"
                                               class="form-control" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Alternative Mobile Number</td>
                                    <td>
                                        <input type="text" name="altmobilenumber" id="altMobileNumber" maxlength="10"
                                               class="form-control" required/>
                                    </td>
                                </tr>

                                <tr>
                                    <td>User Type</td>
                                    <td>
                                        <select class="form-control" name="userType" id="userType-dropdown" required>
                                            <option value="">Choose one</option>
                                            <?php
                                            // A sample user type array
                                            $type = array('4' => 'Admin', '3' => 'Management', '2' => 'Manager', '1' => 'User');
                                            // Iterating through the product array
                                            foreach ($type as $item => $value) {
                                                echo "<option value='$item'>$value</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>

                                    <td>Email id</td>
                                    <td>
                                        <input type="text" name="emailId" id="email" class="form-control" maxlength="50"
                                               required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Key A/C Manager</td>
                                    <td>
                                        <select class="form-control" name="keyAcManagerId" id="keyAcManager-dropdown"
                                                required>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Username</td>
                                    <td>
                                        <div <?php if (isset($name_error)): ?> class="form_error" <?php endif ?> >
                                            <input type="text" name="username" id="username" class="form-control"
                                                   maxlength="50" required/>
                                            <?php if (isset($name_error)): ?>
                                                <span><?php echo $name_error; ?></span>
                                            <?php endif ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td>
                                        <input type="password" name="password" id="password" class="form-control"
                                               maxlength="50" required/>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                            <button type="submit" id="submitData" name="submitData" class="btn btn-primary">Yes</button>
                        </div>
                    </div>
                </div>
            </div>

</body>
</html>
