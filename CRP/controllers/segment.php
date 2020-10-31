<html>
<head>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../css/theme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<h1>Segment<h1>
</html>
<?php
include '../db_connection.php';

$conn = OpenCon();
$sql="SELECT * FROM tbl_segment where isAvailable=1";
$retval = mysqli_query( $conn, $sql );
echo "<table id='segmentTable'  name='segmentTable' >
<thead> 
<tr>
<th style='display:none;'>ID</th>
<th>Update</th>
<th>Segment's Name</th>
<th>Delete</th>
</tr>
</thead>
	   <tbody>
";
while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
    echo "<tr>";
    echo "<td style='display:none;'>" . $row['nid'] . "</td>";
    echo "<td class='action-view'><i class='fa fa-edit fa-2x' style='color:#4caf50;'</i></td>";
    echo "<td>" . $row['csegment_name'] . "</td>";
    echo "<td class='action-view'><i class='fa fa-trash fa-2x' style='color:#4caf50;'</i></td>";
    echo "</tr>";
}
echo "</tbody></table>";
CloseCon($conn);
?>

