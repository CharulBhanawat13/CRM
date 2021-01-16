<?php
include ('../db_connection.php');
if (isset($_POST['segmentId']) && !(empty($_POST['segmentId']))) {
    $conn = OpenCon();
    $segmentId = (int)$_POST['segmentId'];

    $sql="CREATE TEMPORARY TABLE tbl_facility
Select s.csegment_name,og.corg_group_name,o.corg_name,o.norg_id from tbl_segment AS s
JOIN tbl_organisation_group AS og
ON og.nsegment_id=s.ninternal_id
JOIN tbl_organisation AS o
ON o.norg_group_id=og.ninternal_id
where s.ninternal_id=$segmentId;

CREATE TEMPORARY TABLE tbl_visitCount
select norg_id ,count(*) AS nofVisit
from tbl_visitplan;

CREATE TEMPORARY TABLE tbl_callListCount
select norg_id ,count(*) AS noofCallList
from tbl_callList;

CREATE TEMPORARY TABLE tbl_tourCount
select norg_id ,count(*) AS noofTour
from tbl_tour;

select f.csegment_name ,f.corg_group_name ,f.corg_name,IFNULL(`nofVisit`,0) AS nofVisit,IFNULL(`noofCallList`,0) AS noofCallList,IFNULL(`noofTour`,0) AS noofTour
 from tbl_facility AS f
LEFT JOIN tbl_visitCount AS vc
ON vc.norg_id=f.norg_id
LEFT JOIN tbl_callListCount AS cc
ON cc.norg_id=f.norg_id
LEFT JOIN tbl_tourCount AS tc
ON tc.norg_id=f.norg_id;
";

    echo "<table id='facilityTable'  name='facilityTable' >
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
    CloseCon($conn);
}

?>
