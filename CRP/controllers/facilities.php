<html>

<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

</head>
<body>


<select class="form-control" name="dp1" id="dd1-dropdown" required>
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
<form>
<input type="date" name="start_date" id="start_date">
<input type="date" name="end_date" id="end_date">
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
