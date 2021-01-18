<?php
include ('../db_connection.php');

$sql="CREATE TEMPORARY TABLE tbl_visitCount
SELECT COUNT( DISTINCT norg_id) as nofVisit,norg_id FROM tbl_visitplan;

CREATE TEMPORARY TABLE tbl_callListCount
SELECT COUNT( DISTINCT norg_id) as noofCallList,norg_id FROM tbl_calllist;

CREATE TEMPORARY TABLE tbl_tourCount
SELECT COUNT( DISTINCT norg_id) as noofTour,norg_id FROM tbl_tour;

select f.csegment_name ,f.corg_group_name ,f.corg_name,IFNULL(`nofVisit`,0) AS nofVisit,IFNULL(`noofCallList`,0) AS noofCallList,IFNULL(`noofTour`,0) AS noofTour
 from tbl_facility AS f
LEFT JOIN tbl_visitCount AS vc
ON vc.norg_id=f.norg_id
LEFT JOIN tbl_callListCount AS cc
ON cc.norg_id=f.norg_id
LEFT JOIN tbl_tourCount AS tc
ON tc.norg_id=f.norg_id;

DROP TABLE IF EXISTS tbl_visitCount;
DROP TABLE IF EXISTS tbl_callListCount;
DROP TABLE IF EXISTS tbl_tourCount;
DROP TABLE IF EXISTS tbl_facility;
";
$conn = OpenCon();


if (isset($_POST['segmentId']) && !(empty($_POST['segmentId']))) {
    $segmentId = (int)$_POST['segmentId'];

    $sql = "CREATE TEMPORARY TABLE tbl_facility
Select s.csegment_name,og.corg_group_name,o.corg_name,o.norg_id from tbl_segment AS s
JOIN tbl_organisation_group AS og
ON og.nsegment_id=s.ninternal_id
JOIN tbl_organisation AS o
ON o.norg_group_id=og.ninternal_id
where s.ninternal_id=$segmentId;" . $sql;
    printTable($conn,$sql);
}
else if(isset($_POST['org_group_id']) && !(empty($_POST['org_group_id']))){
    $segmentId = (int)$_POST['org_group_id'];
    $sql="CREATE TEMPORARY TABLE tbl_facility
Select s.csegment_name,og.corg_group_name,o.corg_name,o.norg_id from tbl_organisation_group AS og
JOIN tbl_segment AS s
ON og.nsegment_id=s.ninternal_id
JOIN tbl_organisation AS o
ON o.norg_group_id=og.ninternal_id
where og.ninternal_id=$segmentId;" . $sql;
    printTable($conn,$sql);

}
else if(isset($_POST['organisationId']) && !(empty($_POST['organisationId']))){
    $organisationId = (int)$_POST['organisationId'];
    $sql="CREATE TEMPORARY TABLE tbl_facility
Select s.csegment_name,og.corg_group_name,o.corg_name,o.norg_id from tbl_organisation AS o
JOIN tbl_organisation_group AS og
ON o.norg_group_id=og.ninternal_id
JOIN tbl_segment AS s
ON og.nsegment_id=s.ninternal_id 
where o.ninternal_id=$organisationId;" . $sql;
    printTable($conn,$sql);

}


function printTable($conn,$sql){
    echo "<table id='facilityTable'  name='facilityTable'>
<thead> 
    <tr>
    <th>Segment</th>
    <th>Organisation Group</th>
    <th>Organisation</th>
    <th>No. of visit</th>
    <th>No. of Calls</th>
    <th>No of tours</th>

    </tr>
</thead>
<tbody>
";

    if (mysqli_multi_query($conn,$sql)){
        do{
            if ($result=mysqli_store_result($conn)){
                while ($row=mysqli_fetch_row($result)){

                    echo "<tr>";
                    echo "<td>".$row[0]."</td>";
                    echo "<td>".$row[1]."</td>";
                    echo "<td>".$row[2]."</td>";
                    echo "<td>".$row[3]."</td>";
                    echo "<td>".$row[4]."</td>";
                    echo "<td>".$row[5]."</td>";

                    echo "</tr>";
                }
                //    mysqli_free_result($conn);
            }
        }while (mysqli_next_result($conn));
    }
    echo "</tbody></table>";
}

CloseCon($conn);





?>