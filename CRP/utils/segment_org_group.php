<?php
if(!empty($_GET['id'])){
    include('../db_connection.php');
    $segment_id_forOrgGroup=(int)$_GET['id'];
    $conn = OpenCon();
    $sql = "SELECT *
        FROM tbl_organisation_group 
       WHERE isAvailable=1 AND nsegment_id=$segment_id_forOrgGroup;";
    $retval = mysqli_query($conn, $sql);
    echo "<table id='organisationGroupTable'  name='organisationGroupTable' >
            <thead> 
            <tr>
            <th style='display:none;'>INTERNAL ID</th>
            <th style='display:none;'>ORG GROUP ID</th>
            <th>Organisation Group Name</th>
            </tr>
            </thead>
                   <tbody>
            ";
    while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
        echo "<tr>";
        echo "<td style='display:none;'>" . $row['ninternal_id'] . "</td>";
        echo "<td style='display:none;'>" . $row['norg_group_id'] . "</td>";
        echo "<td>" . $row['corg_group_name'] . "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
    CloseCon($conn);

}
?>




