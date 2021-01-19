<?php
include ('../db_connection.php');
session_start();
$user_id=$_SESSION['user_id'];

$tbl_visitCount="CREATE TEMPORARY TABLE tbl_visitCount".$user_id."
SELECT COUNT( DISTINCT norg_id) as nofVisit,norg_id FROM tbl_visitplan WHERE 1";

$tbl_callListCount="CREATE TEMPORARY TABLE tbl_callListCount".$user_id."
SELECT COUNT( DISTINCT norg_id) as noofCallList,norg_id FROM tbl_calllist WHERE 1";

$tbl_tourCount="CREATE TEMPORARY TABLE tbl_tourCount".$user_id."
SELECT COUNT( DISTINCT norg_id) as noofTour,norg_id FROM tbl_tour WHERE 1";
$final_sql="";
$sql="select f.csegment_name ,f.corg_group_name ,f.corg_name,IFNULL(`nofVisit`,0) AS nofVisit,IFNULL(`noofCallList`,0) AS noofCallList,IFNULL(`noofTour`,0) AS noofTour
 from tbl_facility".$user_id." AS f
LEFT JOIN tbl_visitCount".$user_id." AS vc
ON vc.norg_id=f.norg_id
LEFT JOIN tbl_callListCount".$user_id." AS cc
ON cc.norg_id=f.norg_id
LEFT JOIN tbl_tourCount".$user_id." AS tc
ON tc.norg_id=f.norg_id;

DROP TABLE IF EXISTS tbl_visitCount".$user_id.";
DROP TABLE IF EXISTS tbl_callListCount".$user_id.";
DROP TABLE IF EXISTS tbl_tourCount".$user_id.";
DROP TABLE IF EXISTS tbl_facility".$user_id.";
";

if (isset($_POST['start_date']) && !(empty($_POST['start_date'])) && isset($_POST['end_date']) && !(empty($_POST['end_date']))  ){
    require_once('../utils/DateFilter.php');
    $tbl_visitCount=DateFilter::prepareQuery('date',$tbl_visitCount);
    $tbl_callListCount=DateFilter::prepareQuery('date',$tbl_callListCount);
    $tbl_tourCount=DateFilter::prepareQuery('date',$tbl_tourCount);
    $sql=$tbl_visitCount.";".$tbl_callListCount.";".$tbl_tourCount.";".$sql;
}else{
    $sql=$tbl_visitCount.";".$tbl_callListCount.";".$tbl_tourCount.";".$sql;
}
$conn = OpenCon();

if (isset($_POST['segmentId']) && !(empty($_POST['segmentId']))) {
    $segmentId = (int)$_POST['segmentId'];
    $final_sql = "CREATE TEMPORARY TABLE tbl_facility".$user_id."
Select s.csegment_name,og.corg_group_name,o.corg_name,o.norg_id from tbl_segment AS s
JOIN tbl_organisation_group AS og
ON og.nsegment_id=s.ninternal_id
JOIN tbl_organisation AS o
ON o.norg_group_id=og.ninternal_id
where s.ninternal_id=$segmentId;" . $sql;

    printTable($conn,$final_sql);
}

else if(isset($_POST['org_group_id']) && !(empty($_POST['org_group_id']))){
    $org_group_id = (int)$_POST['org_group_id'];
    $final_sql="CREATE TEMPORARY TABLE tbl_facility".$user_id."
Select s.csegment_name,og.corg_group_name,o.corg_name,o.norg_id from tbl_organisation_group AS og
JOIN tbl_segment AS s
ON og.nsegment_id=s.ninternal_id
JOIN tbl_organisation AS o
ON o.norg_group_id=og.ninternal_id
where og.ninternal_id=$org_group_id;" . $sql;
    printTable($conn,$final_sql);
}

else if(isset($_POST['organisationId']) && !(empty($_POST['organisationId']))){
    $organisationId = (int)$_POST['organisationId'];
    $final_sql="CREATE TEMPORARY TABLE tbl_facility".$user_id."
Select s.csegment_name,og.corg_group_name,o.corg_name,o.norg_id from tbl_organisation AS o
JOIN tbl_organisation_group AS og
ON o.norg_group_id=og.ninternal_id
JOIN tbl_segment AS s
ON og.nsegment_id=s.ninternal_id 
where o.ninternal_id=$organisationId;" . $sql;
    printTable($conn,$final_sql);

}

else if(isset($_POST['employee_id']) && !(empty($_POST['employee_id']))){
    $employeeId = (int)$_POST['employee_id'];
    $final_sql="CREATE TEMPORARY TABLE tbl_visitCount".$user_id."
SELECT COUNT( DISTINCT norg_id) as nofVisit,norg_id FROM tbl_visitplan where nlogged_in_user_id=$employeeId;

CREATE TEMPORARY TABLE tbl_callListCount".$user_id."
SELECT COUNT( DISTINCT norg_id) as noofCallList,norg_id FROM tbl_calllist where nlogged_in_user_id=$employeeId;

CREATE TEMPORARY TABLE tbl_tourCount".$user_id."
SELECT COUNT( DISTINCT norg_id) as noofTour,norg_id FROM tbl_tour where nlogged_in_user_id=$employeeId;

CREATE TEMPORARY TABLE tbl_facility".$user_id."
select s.csegment_name,og.corg_group_name,o.corg_name,o.norg_id from tbl_organisation AS o
JOIN tbl_organisation_group AS og 
ON o.norg_group_id=og.ninternal_id 
JOIN tbl_segment as s 
ON og.nsegment_id=s.ninternal_id;

select f.csegment_name ,f.corg_group_name ,f.corg_name,IFNULL(`nofVisit`,0) AS nofVisit,IFNULL(`noofCallList`,0) AS noofCallList,IFNULL(`noofTour`,0) AS noofTour
 from tbl_facility".$user_id." AS f
LEFT JOIN tbl_visitCount".$user_id." AS vc
ON vc.norg_id=f.norg_id
LEFT JOIN tbl_callListCount".$user_id." AS cc
ON cc.norg_id=f.norg_id
LEFT JOIN tbl_tourCount".$user_id." AS tc
ON tc.norg_id=f.norg_id;

DROP TABLE IF EXISTS tbl_visitCount".$user_id.";
DROP TABLE IF EXISTS tbl_callListCount".$user_id.";
DROP TABLE IF EXISTS tbl_tourCount".$user_id.";
DROP TABLE IF EXISTS tbl_facility".$user_id.";    ";
    printTable($conn,$final_sql);
}

function printTable($conn,$final_sql){
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

    if (mysqli_multi_query($conn,$final_sql)){
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