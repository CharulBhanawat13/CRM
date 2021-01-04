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
<?php
if(!empty($_GET['id'])){
    include('../db_connection.php');
    $segment_id_forOrgGroup=(int)$_GET['id'];
    $conn = OpenCon();
    $sql = "SELECT *
        FROM tbl_organisation_group  
       WHERE isAvailable=1 AND nsegment_id=$segment_id_forOrgGroup;";
    $retval = mysqli_query($conn, $sql);
    echo "<table  id='segmentOrganisationGroupTable'  name='segmentOrganisationGroupTable' >
            <thead>
            <tr>
            <th style='display:none;'>INTERNAL ID</th>
            <th style='display:none;'>ORG GROUP ID</th>
            <th>VIEW</th>     
            <th>Organisation Group Name</th>
            </tr>
            </thead>
                   <tbody>
            ";
    while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
        echo "<tr>";
        echo "<td style='display:none;'>" . $row['ninternal_id'] . "</td>";
        echo "<td style='display:none;'>" . $row['norg_group_id'] . "</td>";
        echo "<td ><a class='openOraganaisationdetails'><i class='fa fa-eye fa-2x'></i></a></td>";
        echo "<td>" . $row['corg_group_name'] . "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
    CloseCon($conn);

}

if(!empty($_GET['org_group_id'])){
    session_start();
    $user_id=$_SESSION['user_id'];
    include('../db_connection.php');
    $org_group_id=(int)$_GET['org_group_id'];
    $conn = OpenCon();

    $sql="
CREATE TEMPORARY TABLE tbl_visitCount".$user_id."
select norg_id ,count(*) AS nofVisit
from tbl_visitplan
where norg_id IN (
SELECT norg_id FROM tbl_organisation
WHERE norg_group_id=$org_group_id)
group by norg_id;



CREATE TEMPORARY TABLE tbl_callListCount".$user_id."
select norg_id ,count(*) AS noOFCallList
from tbl_callList
where norg_id IN (
SELECT norg_id FROM tbl_organisation
WHERE norg_group_id=$org_group_id)
group by norg_id;


CREATE TEMPORARY TABLE tbl_tourCount".$user_id."
select norg_id ,count(*) AS noOfTour
from tbl_tour
where norg_id IN (
SELECT norg_id FROM tbl_organisation
WHERE norg_group_id=$org_group_id)
group by norg_id;

select o.ninternal_id,o.norg_id ,o.corg_name ,IFNULL(`nofVisit`,0) AS nofVisit,
IFNULL(`noOFCallList`,0) AS noOFCallList,IFNULL(`noOfTour`,0) AS noOfTour from tbl_organisation AS o
LEFT JOIN tbl_visitCount".$user_id." AS vc
ON vc.norg_id=o.norg_id
LEFT JOIN tbl_callListCount".$user_id." AS CL
ON CL.norg_id=o.norg_id
LEFT JOIN tbl_tourCount".$user_id." AS TC
ON TC.norg_id=o.norg_id
where o.norg_group_id=$org_group_id;

IF EXISTS DROP TABLE tbl_visitCount".$user_id.";
IF EXISTS DROP TABLE tbl_callListCount".$user_id.";
IF EXISTS DROP TABLE tbl_tourCount".$user_id.";

";

    echo "<table  id='organisationGroupOrganisationTable'  name='organisationGroupOrganisationTable' >
            <thead>
            <tr>
            <th style='display:none;'>INTERNAL ID</th>
            <th style='display:none;'>ORG  ID</th>
            <th>Organisation Name</th>
            <th> Visits</th>
            <th>Tour</th>
            <th>Calls</th>
            </tr>
            </thead>
                   <tbody>
            ";
    if (mysqli_multi_query($conn,$sql)){
        do{
            if ($result=mysqli_store_result($conn)){
                while ($row=mysqli_fetch_row($result)){

                    echo "<tr>";
                    echo "<td style='display:none;'>" . $row[0] . "</td>";
                    echo "<td style='display:none;'>" . $row[1] . "</td>";
                    echo "<td>" . $row[2] . "</td>";
                    echo "<td>" . $row[3] . "</td>";
                    echo "<td>" . $row[4] . "</td>";
                    echo "<td>" . $row[5] . "</td>";
                    echo "</tr>";
                }
            //    mysqli_free_result($conn);
            }
        }while (mysqli_next_result($conn));
    }
    CloseCon($conn);
    echo "</tbody></table>";

}

?>
<script>
    $(document).ready(function () {
        $('#segmentOrganisationGroupTable thead tr').clone(true).appendTo('#segmentOrganisationGroupTable thead');
        $('#segmentOrganisationGroupTable thead tr:eq(1) th').each(function (i) {
            var title = $(this).text();
                $(this).html('<input class="form-control" type="text" placeholder="Search ' + title + '" />');

            $('input', this).on('keyup change', function () {
                if (table.column(i).search() !== this.value) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
        });

        var table = $('#segmentOrganisationGroupTable').DataTable({
                orderCellsTop: true,
                "dom": 'lrtip',
                "scrollXInner": true
            }
        );


        $('#segmentOrganisationGroupTable tbody').on('click', '.openOraganaisationdetails', function () {
            var data = table.row($(this).parents('tr').first()).data()[0];
            var org_group_idFrorOrganisation=data;
            $('.modal-body').load('../utils/segment_org_group.php?org_group_id='+org_group_idFrorOrganisation,function(){
                $('#segment_organisation_group_modal').modal({show:true});
            });

        } );
        $('#organisationGroupOrganisationTable thead tr').clone(true).appendTo('#organisationGroupOrganisationTable thead');
        $('#organisationGroupOrganisationTable thead tr:eq(1) th').each(function (i) {
            var title = $(this).text();
            $(this).html('<input class="form-control" type="text" placeholder="Search ' + title + '" />');

            $('input', this).on('keyup change', function () {
                if (table2.column(i).search() !== this.value) {
                    table2
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
        });

        var table2 = $('#organisationGroupOrganisationTable').DataTable({
                orderCellsTop: true,
                "dom": 'lrtip',
            }
        );
    });
</script>
</html>

