
<html>
<link rel="stylesheet" href="../css/theme.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

<head>
<link rel="stylesheet" href="../css/theme.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   
   <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
 <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
</head>
<body>
<h1>Employee Details Page<h1>
<div class="container">
<a style="float:right" href="../modals/EmployeeModal.php" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i></a>
 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        
        
      </div>
      
    </div>
  </div>

</div>

<?php
include '../db_connection.php';

$conn = OpenCon();
$sql = 'SELECT cengineer_name, caddress,ccity,cstate,ccountry,cmobile_number,cemail_id,ckey_ac_manager FROM tbl_employeeMaster';
$retval = mysqli_query( $conn, $sql );
echo "<table id='employeeTable'  name='employeeTable' >
<thead> 
<tr>

<th>Engineer's Name</th>
	
<th>Adress</th>

<th>City</th>

<th>State</th>
<th>Country</th>
<th>Mobile Number</th>
<th>Email Id</th>
<th>Key A/C Manager</th>

</tr>
</thead>
<tfoot>
           <tr>
               <th>Name</th>
               <th>Adress</th>
               <th>City</th>
               <th>State</th>
               <th>Country </th>
               <th>Mobile</th>
			    <th>Email</th>
               <th>Key</th>

           </tr>
       </tfoot>
	   <tbody>

";

   while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
	echo "<tr>";  
    echo "<td>" . $row['cengineer_name'] . "</td>";
    echo "<td>" . $row['caddress'] . "</td>";
    echo "<td>" . $row['ccity'] . "</td>";
    echo "<td>" . $row['cstate'] . "</td>";
    echo "<td>" . $row['ccountry'] . "</td>";
    echo "<td>" . $row['cmobile_number'] . "</td>";
    echo "<td>" . $row['cemail_id'] . "</td>";
    echo "<td>" . $row['ckey_ac_manager'] . "</td>";

    echo "</tr>";
}
echo "</tbody></table>";

CloseCon($conn);
?>
<script>
$(document).ready(function() {
	 // Setup - add a text input to each footer cell
    $('#employeeTable thead tr').clone(true).appendTo( '#employeeTable thead' );
    $('#employeeTable thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input class="form-control" type="text" placeholder="Search '+title+'" />' );
		
		 $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
   } );	
	var table =$('#employeeTable').DataTable({
		 orderCellsTop: true,
     }
    );  

   
   
	

} );
</script>

</body>
</html>
