<?php
session_start();

?>
<html>
<head>
    <link rel="dbstylesheet" href="../css/styles.css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<h5>
    <div style="background-color: #f2f2f2;width: 100%;height: 40px;font-size: large;padding-top:0.5%">
        <b style="margin-left: 40%;color:#5bc0de ">FACILITY</b>
        <a style="float:right;margin-left: 10px" href="../logout.php"><i class="fa fa-sign-out" ></i>Logout</a>
        <div style="float: right"> <?php echo "Welcome " . $_SESSION['username'] ; ?></div>
    </div>
</h5>
<body>
<table id="facilityFiltersTable">
    <tr>

        <td><label>Choose Option</label> </td>
        <td><select class="form-control" name="dp1" id="dd1-dropdown" required>
                <option value="">Choose one</option>
                <?php
                // A sample user type array
                $type = array('Segment' => 'Segment', 'OrganisationGroups' => 'Organisation Groups', 'Organisation' => 'Organisation','RE' => 'RE');
                // Iterating through the product array
                foreach ($type as $item => $value) {
                    echo "<option value='$item'>$value</option>";
                }
                ?>
            </select>
        </td>
<form>

            <td>Start Date</td>
            <td><input class="form-control" style="width: fit-content" type="date" name="start_date" id="start_date"></td>
            <td>End Date</td>
            <td><input class="form-control" style="width: fit-content" type="date" name="end_date" id="end_date"></td>
            <td><input class='btn btn-info' type="reset" value="Reset">
            <td><a style="float:right;margin-left: 15px;" href="../dashboard.php"><i class="fa fa-home fa-2x"></i></a></td>
        </tr>
    </table>
</form>
<div class="container">
    <div class="Segment">
       <select class="form-control" name="segment" id="segment-dropdown" required>
            <option value="">Select Segment</option>
            <?php
            require_once "../db_connection.php";
            $conn = OpenCon();
            $result = mysqli_query($conn, "SELECT * FROM tbl_segment");
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <option value="<?php echo $row['ninternal_id']; ?>"><?php echo $row["csegment_name"]; ?></option>
                <?php
            }
            CloseCon($conn);
            ?>
        </select>
    </div>

    <div class="OrganisationGroups">
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
    </div>
    <div class="Organisation">
        <select class="form-control" name="organisation" id="organisation-dropdown" required>
            <option value="">Select Organisation</option>
            <?php
            require_once "../db_connection.php";
            $conn = OpenCon();

            $result = mysqli_query($conn, "SELECT * FROM tbl_organisation");
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <option value="<?php echo $row['ninternal_id']; ?>"><?php echo $row["corg_name"]; ?></option>
                <?php
            }
            CloseCon($conn);
            ?>
        </select>
    </div>

    <div class="RE">
        <select class="form-control" name="RE" id="RE-dropdown" required>
            <option value="">Select RE</option>
            <?php
            require_once "../db_connection.php";
            $conn = OpenCon();

            $result = mysqli_query($conn, "SELECT * FROM tbl_employeemaster");
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <option value="<?php echo $row['ninternal_id']; ?>"><?php echo $row["cengineer_name"]; ?></option>
                <?php
            }
            CloseCon($conn);
            ?>
        </select>
    </div>

</div>

<div>
    <table id="facilityTable"></table>
</div>

<script>
    $(document).ready(function() {
        $('#dd1-dropdown').bind('change', function() {
            var elements = $('div.container').children().hide(); // hide all the elements
            var value = $(this).val();
            if (value.length) { // if somethings' selected
                elements.filter('.' + value).show(); // show the ones we want
            }
        }).trigger('change');

        $('#start_date').bind('change', function() {
            $('#segment-dropdown').val('');
            $('#organisationGroup-dropdown').val('');
            $('#organisation-dropdown').val('');
            $('#RE-dropdown').val('');

        }).trigger('change');

        $('#segment-dropdown').bind('change', function() {
            var segmentId = $(this).val();
            var start_date=$("#start_date").val();
            var end_date=$("#end_date").val()

            $.ajax({
                async: true,
                url: "../utils/saveFacilitiesData.php",
                type: "POST",
                data: {
                    start_date:start_date,
                    end_date:end_date,
                    segmentId: segmentId
                },
                cache: false,
                success: function (result) {
                     $("#facilityTable").html(result);

                }
            });
        }).trigger('change');

        $('#organisationGroup-dropdown').bind('change', function() {
            var org_group_id = $(this).val();
            var start_date=$("#start_date").val();
            var end_date=$("#end_date").val()
            $.ajax({
                async: true,
                url: "../utils/saveFacilitiesData.php",
                type: "POST",
                data: {
                    org_group_id: org_group_id,
                    start_date:start_date,
                    end_date:end_date,
                },
                cache: false,
                success: function (result) {
                    $("#facilityTable").html(result);

                }
            });
        }).trigger('change');

        $('#organisation-dropdown').bind('change', function() {
            var organisationId = $(this).val();
            var start_date=$("#start_date").val();
            var end_date=$("#end_date").val()
            $.ajax({
                async: true,
                url: "../utils/saveFacilitiesData.php",
                type: "POST",
                data: {
                    organisationId: organisationId,
                    start_date:start_date,
                    end_date:end_date,
                },
                cache: false,
                success: function (result) {
                    $("#facilityTable").html(result);

                }
            });
        }).trigger('change');

        $('#RE-dropdown').bind('change', function() {
            var employee_id = $(this).val();
            var start_date=$("#start_date").val();
            var end_date=$("#end_date").val()
            $.ajax({
                async: true,
                url: "../utils/saveFacilitiesData.php",
                type: "POST",
                data: {
                    employee_id: employee_id,
                    start_date:start_date,
                    end_date:end_date,
                },
                cache: false,
                success: function (result) {
                    $("#facilityTable").html(result);

                }
            });
        }).trigger('change');

    });
</script>
</body>

</html>
